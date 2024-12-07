<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MsDeedsController;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function ownerDashboard(){
        return view('ownerDashboard');
    }

    public function takerDashboard(){
        $msDeedsController = new MsDeedsController();

        $homepageDeeds = $msDeedsController->homepage(); 


        return view('takerDashboard', [
            'deeds' => $homepageDeeds,
        ]);
    }

    public function generalUserDashboard(){
        return view('generalUserDashboard');
    }
}
