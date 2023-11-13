<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Email;

class EmailController extends Controller
{


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $email = new Email($user);

        Mail::to($user->email)->send($email);

        // Use $user para enviar e-mails usando o Gmail
    }

}
