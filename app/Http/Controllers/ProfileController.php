<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (empty(auth()->user()->profile)) {
            $profile = new Profile(["user_id" => auth()->user()->id]);
            $profile->save();
            return redirect(route('profile.edit'));
        }
        return view('pages.profile.profile', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.profile.edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|unique:users,email," . auth()->user()->id,
            "bio" => "required|string",
            "address" => "required|string",
            "image" => "nullable|file"
        ]);

        $userData = [
            "name" => $request->name,
            "email" => $request->email,
        ];


        $profileData = [
            "address" => $request->address,
            "bio" => $request->bio,
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk("public")->exists(auth()->user()->profile->image)) {
                Storage::disk("public")->delete(auth()->user()->profile->image);
            }
            $profileData["image"] = Storage::disk("public")->put('user', $request->file('image'));
        }

        if (auth()->user()->update($userData) && auth()->user()->profile->update($profileData)) {
            Toastr::success("Profile Update Succesfully");
        } else {
            Toastr::error("Something went wrong!");
        }
        return redirect(route('profile.show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
