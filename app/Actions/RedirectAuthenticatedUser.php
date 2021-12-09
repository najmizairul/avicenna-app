<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class RedirectAuthenticatedUser
{

    /**
     * Handle an incoming request.
     */
    public function handle()
    {
        $user = Auth::user();

         switch ($user->role) {
             case 'pharmacist':
                 $roleDashboard = 'pharmacy.dashboard';
                 break;
             case 'nurse':
             case 'doctor':
                 $roleDashboard = 'doctors.dashboard';
                 break;
             case 'receptionist':
                $roleDashboard = 'reception.dashboard';
                break;
            default:
                $roleDashboard = null;
                break;
        };

        if ($roleDashboard === null) {
            return request()->session()->invalidate();
        }

        return redirect()->route($roleDashboard);

    }
}
