<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Customer;
use DateTime;

class CalendarController extends Controller
{
    public function index()
    {
        $initialDate = (new DateTime())->format('Y-m-d');
        $calendar = Calendar::where('id_company', auth()->user()->created_by)->get();
        $customers = Customer::where('created_by', auth()->user()->created_by)->get();

        if (auth()->user()->role = 'doctor') {
            $calendar = Calendar::where('id_user', auth()->user()->id)->get();
            $customers = Customer::where('created_by', auth()->user()->id)->get();
        }

        return view('calendar.index', compact('customers', 'calendar', 'initialDate'));
    }
}
