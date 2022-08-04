<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('google_id', $user->getId())->first();

            if($findUser) {
                Auth::login($findUser);
                
                return redirect()->intended('/');

            } else {
                $url = $user->avatar;
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put($name, $contents);
                $newUser = User::create([
                    'name' => $user->name,
                    'photo' => $name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt($user->id)
                ]);
                Auth::login($newUser);
                return redirect()->intended('/');
            }
            
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
