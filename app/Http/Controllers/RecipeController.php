<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Recipe;
use App\Models\User;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::get();

        return view('recipe.index', compact('recipes'));
    }

    public function print($id)
    {
        $recipe = Recipe::find($id);

        return view('recipe.print', compact('recipe'));
    }

    public function create()
    {
        $user = \Auth::user();
        $customers = Customer::where('created_by', auth()->user()->id)->get();

        $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->get();

        return view('recipe.create', compact('customers', 'users'));
    }

    public function store()
    {
        Recipe::create([
            'id_customer' => request()->id_customer,
            'id_user' => request()->id_user,
            'date' => date('Y-m-d'),
            'description' => request()->description,
        ]);

        return redirect('/recipes');
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $customers = Customer::where('created_by', auth()->user()->id)->get();
        $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->get();
        $recipe = Recipe::find($id);

        return view('recipe.edit', compact('recipe', 'customers', 'users'));
    }

    public function update()
    {
        $consultation = Recipe::find(request()->id);

        $consultation->update([
            'id_customer' => request()->id_customer,
            'id_user' => request()->id_user,
            'date' => date('Y-m-d'),
            'description' => request()->description,
        ]);

        return redirect('/recipes');
    }

    public function delete($id)
    {
        Recipe::find($id)->delete();
        return redirect('/recipes');
    }
}
