<?php

namespace App\Http\Controllers;
use Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Portal extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkin(){
        $json['result'] = 400;
        // echo'<pre>';print_r($_POST);exit;
        if($_POST['check'] == 'Sign In'){
            $array = array(
                'first_name' => $_POST['First_Name'],
                'last_name' => $_POST['Last_Name'],
                'process' => $_POST['process'],
                'sign' => $_POST['signed'],
                'date' => date('Y-m-d'),
                'time' =>  $_POST['hr'].':'.$_POST['min'].'  '.$_POST['day'],
                'status' => $_POST['check'],
                'ip'=>Request::ip(),
            );
        }else{
            $array['total_hrs'] = $_POST['hrs'];
            $array['work'] = $_POST['work'];
            $array['status'] = $_POST['check'];
            $array['out_time'] = $_POST['hr'].':'.$_POST['min'].'  '.$_POST['day'];
        }

        if($_POST['check'] == 'Sign In'){
            if(DB::table('details')->insert($array)){
                $json['result'] = 200;
            }
        }else{
            if(DB::table('details')->where('first_name',$_POST['First_Name'])->where('last_name',$_POST['Last_Name'])->where('date',date('Y-m-d'))->update($array)){
                $json['result'] = 200;
            }else{
                $json['result'] = 400;
            }       
        }
        return $json;
    }
}
?>