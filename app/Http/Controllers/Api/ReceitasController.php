<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Receitas;
use App\Providers\UserDataServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReceitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Receitas::all();
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'ingredient' => 'required|string|max:255',
                'preparationMethod' => 'required|string',
            ]);
            $receitas = Receitas::all();

            $userId = Auth::id();
            
            $newReceita = new Receitas(array_merge(['user_id' => $userId ], $request->all()));
            $newReceita->save();
            
            
            return view('layouts.home');
            // return view('layouts.home')->with('receitas',$receitas );

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->messages();

            return redirect()->back()->withErrors($errors)->withInput();
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return Receitas::where('id', $id)->firstOrFail();
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
