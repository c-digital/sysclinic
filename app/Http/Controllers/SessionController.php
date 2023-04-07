<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\ProductService;

class SessionController extends Controller
{
    public function index()
    {
        $products = ProductService::where('type', 'treatment')
            ->where('id_company', auth()->user()->creatorId())
            ->get();

        $sessions = Session::treatment(request()->treatment)
            ->where('id_company', auth()->user()->creatorId())
            ->customer(request()->customer)
            ->date(request()->start, request()->end)
            ->orderByDesc('id')->get();

        if (auth()->user()->type != 'company') {
            $sessions = Session::treatment(request()->treatment)
                ->where('id_company', auth()->user()->created_by)
                ->customer(request()->customer)
                ->date(request()->start, request()->end)
                ->orderByDesc('id')->get();
        }

        return view('sessions.index', compact('sessions', 'products'));
    }

    public function realized()
    {
        $session = Session::find(request()->id);

        $realized = json_decode($session->realized, true);

        $data['date'] = date('Y-m-d');
        $data['user'] = auth()->user()->id;
        $data['comment'] = request()->comment;

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
