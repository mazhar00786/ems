<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //
    use AuthenticatesUsers, ThrottlesLogins;


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $key = $this->throttleKey($request);
        $rateLimiter = $this->limiter();

        // Check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            $attempts = $rateLimiter->attempts($key);
            $rateLimiter->clear($key);
            if ($attempts === 3) {
                $this->decayMinutes = 5;
            }

            for ($i = 0; $i < $attempts; $i++) {
                $this->incrementLoginAttempts($request);
            }

            $this->fireLockoutEvent($request);  // Fire the lockout event.

            return $this->sendLockoutResponse($request); //Redirect the user back after lockout.
        }

        $user = User::where('email', $request->email)->first();

        if ($user->role == 'admin') {
            # code...
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                return redirect()->intended('/home');
            }
        } else {
            # code...
            Alert::error('SORRY: u r not an admin!');
        }

        // Keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        return back()->withInput($request->only('email', 'remember'));
    }

    
}
