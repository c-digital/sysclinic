<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\ProductService;

class SessionController extends Controller
{
    public function index()
    {
        $products = ProductService::where('type', 'treatment')
            ->where('created_by', auth()->user()->id)
            ->get();

        $sessions = Session::treatment(request()->treatment)
            ->Customer(request()->customer)
            ->date(request()->start, request()->end)
            ->orderByDesc('id')->get();

        return view('sessions.index', compact('sessions', 'products'));
    }

    public function realized($id)
    {
        $session = Session::find($id);

        $realized = json_decode($session->realized, true);

        $data['date'] = date('Y-m-d');
        $data['user'] = auth()->user()->id;

        $realized[] = $data;
        $realized = json_encode($realized);

        $session->update(['realized' => $realized]);

        return redirect('/sessions');
    }

    public function print($id)
    {
        $session = Session::find($id);
        return view('sessions.print', compact('session'));
    }
}
