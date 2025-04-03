<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * prikaz korisnikovih projekata
     */
    public function index(): View
    {
        $user = Auth::user();
        $vodeniProjekti = $user->vodeniProjekti;
        $clanProjekti = $user->projektiClanstva;

        return view('dashboard', compact('vodeniProjekti', 'clanProjekti'));
    }
}
