<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\RoomType;
use App\Models\Stay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShowDashboardController extends Controller
{
    public function index(){
        $today = Carbon::now();
        $booking = new Booking();
        $customer = new Customer();
        $guest = new Guest();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        // Today income
        $incomes = Payment::whereDate('created_at', $today)
                        ->where('status', 1)
                        ->sum('amount');
        // This week incomes
        $weeklyIncome = Payment::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->where('status', 1)
                    ->sum('amount');
        
        // Get Room Type By Booking
        $roomType = RoomType::withCount('bookings')->get();
        //Today Guest
        $guests = Stay::whereDate('check_in', '<=', $today)
                        ->whereDate('check_out', '>=', $today)
                        ->with('guest')
                        ->count();
        //This Week Guest
        $weeklyGuest = Stay::whereDate('check_in', '<=', $endOfWeek)
                        ->whereDate('check_out', '>=', $startOfWeek)
                        ->with('guest')
                        ->count();
        $bookings = $this->selectByToday($booking); // Today Booking
        $clients = $this->selectByToday($customer); //Today New Client
        $weeklyBooking = $this->selectByWeekly($booking);// This week booking
        $weeklyClient = $this->selectByWeekly($customer);  //This week client
        $incomePer = $this->calculatePercentage($incomes,$weeklyIncome); //Income percentage
        $bookingPer =$this->calculatePercentage($bookings,$weeklyBooking);//Booking percentage
        $guestPer =$this->calculatePercentage($guests,$weeklyGuest);//Guest percentage
        $clientPer = $this->calculatePercentage($clients,$weeklyClient); //Client percentage
        $bookingByYearly = $this->selectByYearly($booking); //get all booking by monthly
        $guestByYearly = $this->selectByYearly($guest); //get all guest by monthly

        $incomeByYealy = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();    
        $months = [];
        $totals = [];
        for($i =1; $i <=12; $i++){
            $months[]= Carbon::create()->month($i)->format('M');
            $totalBooking[]= $bookingByYearly->firstWhere('month',$i)->total ?? 0;
            $totalGuest[]= $guestByYearly->firstWhere('month',$i)->total ?? 0;
            $totalIncome[]= $incomeByYealy->firstWhere('month',$i)->total ?? 0;
        }
        return view('admin.dashboard',compact('months','totalBooking','totalGuest','totalIncome','roomType','incomes','incomePer','guests','guestPer','bookings','bookingPer','clients','clientPer'));
    }
    // calculate percentage
    public function calculatePercentage($part,$total){
        return $total > 0 ? round(($part/$total)*100) : 0;
    }

    //Select by today date
    public function selectByToday(Model $model){
        $today = Carbon::now();
        $query = $model->newQuery();

        $result = $query->whereDate('created_at', $today)
                        ->where('status', 1)
                        ->count();
        return $result;
    }
    // Select by weekly
    public function selectByWeekly(Model $model){
        $today = Carbon::now();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $query = $model->newQuery();

        $result = $query->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->where('status', 1)
                        ->count();
        return $result;
    }
    // Select by yearly
    public function selectByYearly(Model $model){
        $query = $model->newQuery();
        $result = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
        return $result;
    }
    
}
