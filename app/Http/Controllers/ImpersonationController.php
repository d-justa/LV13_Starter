<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function stop()
    {
        $adminId = session('impersonator_id');

        abort_unless($adminId, 403);

        Auth::loginUsingId($adminId);

        session()->forget('impersonator_id');

        return redirect()->route('dashboard');
    }
}
