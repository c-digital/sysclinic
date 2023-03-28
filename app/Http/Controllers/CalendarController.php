<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Calendar;
use App\Models\Customer;
use App\Models\User;
use App\Models\ProductService;

class CalendarController extends Controller
{
    public function index()
    {
        $initialDate = (new DateTime())->format('Y-m-d');

        $calendar = Calendar::user(request()->id_user)->where('id_company', auth()->user()->created_by)->get();

        $customers = Customer::where('created_by', auth()->user()->created_by)->get();

        $users = User::where('created_by', '=', auth()->user()->creatorId())->where('type', '!=', 'client')->get();

        $productsServices = ProductService::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $productsServices->prepend('-', '');

        if (auth()->user()->type = 'doctor') {
            $calendar = Calendar::user(request()->id_user)->where('id_user', auth()->user()->id)->get();
            $customers = Customer::where('created_by', auth()->user()->id)->get();
        }

        if (auth()->user()->type = 'company') {
            $calendar = Calendar::user(request()->id_user)->where('id_company', auth()->user()->id)->get();
        }

        $calendar = $this->calendar($calendar);

        return view('calendar.index', compact('customers', 'calendar', 'initialDate', 'users', 'productsServices'));
    }

    public function calendar($data)
    {
        $result = [];
        $i = 0;

        foreach ($data as $item) {
            $color = User::find($item->id_user)->color;

            $result[$i]['id'] = $item->id;
            $result[$i]['title'] = $item->title;
            $result[$i]['start'] = $item->date;
            $result[$i]['color'] = $color;
            $result[$i]['extendedProps']['datetime'] = $item->date;
            $result[$i]['extendedProps']['id_customer'] = $item->id_customer;
            $result[$i]['extendedProps']['id_user'] = $item->id_user;
            $result[$i]['extendedProps']['id'] = $item->id;

            $j = 0;

            foreach (json_decode($item->productsServices) as $item) {
                $productService = ProductService::find($item);

                $result[$i]['productsServices'][$j]['id'] = $productService->id;
                $result[$i]['productsServices'][$j]['name'] = $productService->name;

                $j++;
            }

            $i++;
        }

        return $result;
    }

    public function store()
    {
        $productsServices = json_encode(request()->productsServices);

        if (auth()->user()->type == 'company') {
            $id_company = auth()->user()->id;
        } else {
            $id_company = auth()->user()->created_by;
        }

        Calendar::create([
            'title' => request()->title,
            'productsServices' => $productsServices,
            'id_user' => request()->id_user,
            'id_customer' => request()->id_customer,
            'id_company' => $id_company,
            'date' => request()->datetime
        ]);

        return redirect('/calendar');
    }

    public function update()
    {
        if (request()->consultation) {
            return redirect('/consultation/create?id_customer=' . request()->id_customer);
        }

        if (request()->invoice) {
            return redirect('/invoice/create/' . request()->id_customer);
        }

        $productsServices = json_encode(request()->productsServices);

        if (auth()->user()->type == 'company') {
            $id_company = auth()->user()->id;
        } else {
            $id_company = auth()->user()->created_by;
        }

        Calendar::find(request()->id)->update([
            'title' => request()->title,
            'productsServices' => $productsServices,
            'id_user' => request()->id_user,
            'id_customer' => request()->id_customer,
            'id_company' => $id_company,
            'date' => request()->datetime
        ]);

        return redirect('/calendar');
    }
}

