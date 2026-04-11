<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
        return view('subscriber.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        //
        $user = Auth::user();

        if ($request->hasFile('photo')) {
            //elliminar imagen anterior
            File::delete(public_path('storage/' . $profile->photo));
            //asigna nueva imagen
            $photo = $request->file('photo')->store('profiles');
        } else {

            $photo = $user->profile->photo;
        }

        //asignar nombre y correo

        $user->full_name = $request->full_name;

        $user->email = $request->email;

        //asignar foto

        $user->profile->photo = $photo;

        //Guardar campos del usuario

        $user->save();

        //guardar campos de perfiel

        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
