<?php

namespace App\Http\Controllers\CalendarScheduling;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $currentMonth = $request->get('month', date('Y-m'));
        
        // Parse the current month
        $currentDate = Carbon::parse($currentMonth);
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        
        // Get approved leave requests for the current month
        $leaveRequests = LeaveRequest::with(['user', 'leaveType'])
            ->where('status', 'approved')
            ->where(function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                      ->orWhereBetween('end_date', [$startOfMonth, $endOfMonth])
                      ->orWhere(function($q) use ($startOfMonth, $endOfMonth) {
                          $q->where('start_date', '<=', $startOfMonth)
                            ->where('end_date', '>=', $endOfMonth);
                      });
            })
            ->orderBy('start_date')
            ->get();

        // Get team members (if user is department head, show their team)
        $teamMembers = $this->getTeamMembers($user);
        
        // Get monthly statistics
        $monthlyStats = $this->getMonthlyStats($startOfMonth, $endOfMonth, $teamMembers);
        
        // Get upcoming leaves (next 30 days)
        $upcomingLeaves = $this->getUpcomingLeaves($teamMembers);
        
        // Get public holidays (you can store these in a database table)
        $publicHolidays = $this->getPublicHolidays($currentDate->year);

        // Build calendar data
        $calendarData = $this->buildCalendarData($currentDate, $leaveRequests, $publicHolidays);

        return view('modules.calendar_scheduling.index', compact(
            'currentDate',
            'leaveRequests',
            'teamMembers',
            'monthlyStats',
            'upcomingLeaves',
            'publicHolidays',
            'calendarData'
        ));
    }

    private function getTeamMembers($user)
    {
        // If user is department head, get their team members
        if ($user->role_id == 2) { // Department Head role
            return User::where('department_id', $user->department_id)
                ->where('id', '!=', $user->id)
                ->get();
        }
        
        // For regular employees, just return empty or their own department
        return User::where('department_id', $user->department_id)->get();
    }

    private function getMonthlyStats($startOfMonth, $endOfMonth, $teamMembers)
    {
        $totalLeaves = LeaveRequest::where('status', 'approved')
            ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
            ->count();

        $teamLeaves = LeaveRequest::where('status', 'approved')
            ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
            ->whereIn('user_id', $teamMembers->pluck('id'))
            ->count();

        $todayLeaves = LeaveRequest::where('status', 'approved')
            ->whereDate('start_date', '<=', today())
            ->whereDate('end_date', '>=', today())
            ->count();

        $publicHolidaysCount = $this->getPublicHolidays(today()->year)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->count();

        return [
            'total_leaves' => $totalLeaves,
            'team_leaves' => $teamLeaves,
            'today_leaves' => $todayLeaves,
            'public_holidays' => $publicHolidaysCount
        ];
    }

    private function getUpcomingLeaves($teamMembers)
    {
        return LeaveRequest::with(['user', 'leaveType'])
            ->where('status', 'approved')
            ->where('start_date', '>=', today())
            ->where('start_date', '<=', today()->addDays(30))
            ->whereIn('user_id', $teamMembers->pluck('id'))
            ->orderBy('start_date')
            ->limit(5)
            ->get();
    }

    private function getPublicHolidays($year)
    {
        // You can store these in a database table
        return collect([
            ['name' => 'New Year\'s Day', 'date' => Carbon::create($year, 1, 1), 'icon' => 'glass-cheers'],
            ['name' => 'Good Friday', 'date' => Carbon::create($year, 4, 2), 'icon' => 'cross'],
            ['name' => 'Easter Monday', 'date' => Carbon::create($year, 4, 5), 'icon' => 'egg'],
            ['name' => 'Labour Day', 'date' => Carbon::create($year, 5, 1), 'icon' => 'tools'],
            ['name' => 'Independence Day', 'date' => Carbon::create($year, 12, 9), 'icon' => 'flag'],
            ['name' => 'Christmas Day', 'date' => Carbon::create($year, 12, 25), 'icon' => 'gift'],
            ['name' => 'Boxing Day', 'date' => Carbon::create($year, 12, 26), 'icon' => 'box'],
        ]);
    }

    private function buildCalendarData($currentDate, $leaveRequests, $publicHolidays)
    {
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        
        $startOfCalendar = $startOfMonth->copy()->startOfWeek();
        $endOfCalendar = $endOfMonth->copy()->endOfWeek();

        $calendarDays = [];
        $currentDay = $startOfCalendar->copy();

        while ($currentDay <= $endOfCalendar) {
            $dayLeaves = $leaveRequests->filter(function($leave) use ($currentDay) {
                return $currentDay->between($leave->start_date, $leave->end_date);
            });

            $isPublicHoliday = $publicHolidays->contains(function($holiday) use ($currentDay) {
                return $holiday['date']->format('Y-m-d') === $currentDay->format('Y-m-d');
            });

            $calendarDays[] = [
                'date' => $currentDay->copy(),
                'is_current_month' => $currentDay->month == $currentDate->month,
                'is_today' => $currentDay->isToday(),
                'leaves' => $dayLeaves,
                'is_public_holiday' => $isPublicHoliday,
                'public_holiday' => $isPublicHoliday ? $publicHolidays->firstWhere('date', $currentDay->format('Y-m-d')) : null
            ];

            $currentDay->addDay();
        }

        return $calendarDays;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}