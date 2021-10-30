<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ActivateYourAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    //activate your account
    public function activateUserAccount($code)
    {
        $user = User::whereCode($code)->first();
        $user->code = null;
        $user->update([
            "active" => 1
        ]);
        Auth::login($user);
        return redirect("/")->withSuccess("connected");
    }

    //send email to activate user account
    public function resendActivationCode($email)
    {
        $user = User::whereEmail($email)->first();
        if ($user->active) {
            return redirect("/");
        }
        Mail::to($user)->send(new ActivateYourAccount($user->code));
        return redirect("/login")->withSuccess("Activation link sent");
    }
}
