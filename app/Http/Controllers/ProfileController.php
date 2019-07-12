<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($username=null)
    {
        if (isset($username)) {
           $user = User::where('username', $username)->first();
           if ($user != null) {
               return view('profile', ['user' => $user]);
           } else {
               return abort(404);
           }
//        return view('profile', ['user' => $user]);
        } else {
            if (Auth::user() != null) {
                $user = User::where('username', Auth::user()->username)->first();
                $posts = $user->posts;
                return view('profile', ['user' => $user, 'posts' => $posts]);
            } else {
                return route('login');
            }
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('editProfile', ['user' => $user]);
    }

    public function private()
    {
        return view('welcome');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'bio' => 'nullable|max:255',
            'avatar' => 'nullable|max:255'
        ]);
        $user = Auth::user();
        $profile = $user->profile;
        if ($validatedData['bio'] != '') {
            $profile->bio = $validatedData['bio'];
        }
        if ($validatedData['avatar'] != '') {
            $profile->avatar = $validatedData['avatar'];
        }
        $profile->save();
        return redirect(route('profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
