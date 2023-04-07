<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomField;
use App\Models\Consultation;
use App\Models\ConsultationType;
use App\Models\User;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::where('id_company', auth()->user()->creatorId())
            ->status(request()->status)
            ->inicio(request()->inicio)
            ->fin(request()->fin)
            ->paciente(request()->paciente)
            ->tipo(request()->type)
            ->orderBy('id', 'DESC')
            ->get();

        if (auth()->user()->type != 'company') {
            $consultations = Consultation::where('id_company', auth()->user()->creatorId())
                ->status(request()->status)
                ->inicio(request()->inicio)
                ->fin(request()->fin)
                ->paciente(request()->paciente)
                ->tipo(request()->type)
                ->orderBy('id', 'DESC')
                ->get();
        }

        $types = ConsultationType::where('created_by', auth()->user()->id)->get();

        return view('consultation.index', compact('consultations', 'types'));
    }

    public function show($id)
    {
        $consultation = Consultation::find($id);

        $fields = ConsultationType::find($consultation->id_consultations_types);
        $fields = json_decode($fields->fields);

        return view('consultation.show', compact('consultation', 'fields'));
    }

    public function print($id)
    {
        $consultation = Consultation::find($id);

        $fields = ConsultationType::find($consultation->id_consultations_types);
        $fields = json_decode($fields->fields);

        return view('consultation.print', compact('consultation', 'fields'));
    }

    public function create()
    {
        $user = \Auth::user();
        
        $customers = Customer::where('created_by', auth()->user()->id)->get();

        $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->get();

        $fields = CustomField::where('module', 'consultation')
            ->where('created_by', auth()->user()->id)
            ->get();

        $consultationTypes = ConsultationType::where('created_by', auth()->user()->id)->get();
        
        if (auth()->user()->type != 'company') {
            $consultationTypes = ConsultationType::where('created_by', auth()->user()->created_by)->get();
        }

        $fields = [];

        if (request()->consultation_type) {
            $fields = ConsultationType::find(request()->consultation_type);
            $fields = json_decode($fields->fields);
        }

        return view('consultation.create', compact('customers', 'users', 'fields', 'consultationTypes'));
    }

    public function store()
    {
        $images = [];

        if (request()->images) {
            foreach (request()->images as $image) {
                $item = $image->store('consultations');

                $images[] = $item;
            }            
        }

        $consultation = Consultation::create([
            'id_customer' => request()->id_customer,
            'id_user' => request()->id_user,
            'id_company' => auth()->user()->creatorId(),
            'created_by' => auth()->user()->id,
            'date' => date('Y-m-d'),
            'fields' => json_encode(request()->fields),
            'status' => 'Pendiente',
            'id_consultations_types' => request()->id_consutations_types,
            'images' => json_encode($images)
        ]);

        if (request()->photo) {
            $photo = request()->photo->store('consultations');

            $consultation->update(['photo' => $photo]);
        }

        return redirect('/consultation');
    }

    public function edit($id)
    {
        $user = \Auth::user();

        $customers = Customer::where('created_by', auth()->user()->id)->get();

        $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->get();

        $fields = CustomField::where('module', 'consultation')
            ->where('created_by', auth()->user()->id)
            ->get();

        $consultation = Consultation::find($id);

        if (request()->consultation_type) {
            $fields = ConsultationType::find(request()->consultation_type);
            $fields = json_decode($fields->fields);
        }

        return view('consultation.edit', compact('consultation', 'customers', 'users', 'fields'));
    }

    public function update()
    {
        $consultation = Consultation::find(request()->id);

        $images = json_decode($consultation->images, true);

        if (request()->images) {
            foreach (request()->images as $image) {
                $item = $image->store('consultations');

                $images[] = $item;
            }            
        }


        $consultation->update([
            'id_customer' => request()->id_customer,
            'id_user' => request()->id_user,
            'created_by' => auth()->user()->id,
            'id_company' => auth()->user()->creatorId(),
            'date' => date('Y-m-d'),
            'fields' => json_encode(request()->fields),
            'status' => request()->status,
            'images' => json_encode($images)
        ]);

        return redirect('/consultation');
    }

    public function delete($id)
    {
        Consultation::find($id)->delete();
        return redirect('consultation');
    }

    public function getPhoto($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            return $customer->photo;
        }
    }
}
