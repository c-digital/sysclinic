<?php

namespace App\Http\Controllers;

use App\Models\ConsultationType;

class ConsultationTypeController extends Controller
{
    public function index()
    {
        $consultationType = ConsultationType::where('created_by', auth()->user()->id)->get();
        
        if (auth()->user()->type != 'company') {
            $consultationType = ConsultationType::where('created_by', auth()->user()->created_by)->get();
        }

        return view('consultationType.index', compact('consultationType'));
    }
    public function create()
    {
        return view('consultationType.create');
    }

    public function store()
    {
        $i = 0;

        foreach ($_POST['names'] as $name) {
            $fields[$i]['name'] = $name;
            $fields[$i]['type'] = $_POST['types'][$i];
            $fields[$i]['options'] = $_POST['options'][$i];

            $i++;
        }

        $fields = json_encode($fields);

        ConsultationType::create([
            'name' => request()->name,
            'fields' => $fields,
            'created_by' => auth()->user()->id,
        ]);

        return redirect('/consultationTypes');
    }

    public function edit($id)
    {
        $consultationType = ConsultationType::find($id);

        return view('consultationType.edit', compact('consultationType'));
    }

    public function update()
    {
        $i = 0;

        foreach ($_POST['names'] as $name) {
            $fields[$i]['name'] = $name;
            $fields[$i]['type'] = $_POST['types'][$i];
            $fields[$i]['options'] = $_POST['options'][$i];

            $i++;
        }

        $fields = json_encode($fields);

        ConsultationType::find(request()->id)->update([
            'name' => request()->name,
            'fields' => $fields,
            'created_by' => auth()->user()->id,
        ]);

        return redirect('/consultationTypes');
    }

    public function delete($id)
    {
        ConsultationType::find($id)->delete();
        return redirect('consultationTypes');
    }
}
