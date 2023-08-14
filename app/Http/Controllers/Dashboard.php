<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Session;

class Dashboard extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view()
    {
        $userID = session()->get('userID');
        if($userID != ''){
            return view('dashboard');
        }else{
            return redirect(url('/'));
        }
    }
}
