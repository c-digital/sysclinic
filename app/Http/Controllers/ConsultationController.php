<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomField;
use App\Models\Consultation;
use App\Models\User;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::where('created_by', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('consultation.index', compact('consultations'));
    }

    public function print($id)
    {
        $consultation = Consultation::find($id);
        return view('consultation.print', compact('consultation'));
    }

    public function create()
    {
        $customers = Customer::where('created_by', auth()->user()->id)->get();

        $users = User::get();

        $fields = CustomField::where('module', 'consultation')
            ->where('created_by', auth()->user()->id)
            ->get();

        return view('consultation.create', compact('customers', 'users', 'fields'));
    }

    public function store()
    {
        Consultation::create([
            'id_customer' => request()->id_customer,
            'id_user' => request()->id_user,
            'date' => date('Y-m-d'),
            'fields' => json_encode(request()->fields),
            'status' => 'Pendiente'
        ]);

        return redirect('/consultation');
    }

    public function edit($id)
    {
        $customers = Customer::where('created_by', auth()->user()->id)->get();

        $users = User::get();

        $fields = CustomField::where('module', 'consultation')
            ->where('created_by', auth()->user()->id)
            ->get();

        $consultation = Consultation::find($id);

        return view('consultation.edit', compact('consultation', 'customers', 'users', 'fields'));
    }

    public function update()
    {
        Consultation::find(request()->id)->([
            'id_customer' => request()->id_customer,
            'id_user' => request()->id_user,
            'date' => date('Y-m-d'),
            'fields' => json_encode(request()->fields),
            'status' => request()->status
        ]);

        return redirect('/consultation');
    }

    public function delete($id)
    {
        Consultation::find($id)->delete();
        return redirect('consultation');
    }
}
