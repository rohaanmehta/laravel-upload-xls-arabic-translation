<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class User extends Model
{
  public function checklogin() {
    $email = DB::table('users')->select('*')->where('email',$_POST['users_email'])->count();
    $log = DB::table('users')->select('*')->where('email',$_POST['users_email'])->where('password',$_POST['users_password'])->count();
    $json['status'] = '400';
    if($log == 1){
        $json['result'] = 'Login Successfull';
        $json['status'] = '200';

        $user =  DB::table('users')->select('*')->where('email',$_POST['users_email'])->get();
        
        if(isset($_POST['Remember']) && $_POST['Remember'] == 'on'){
            //set cookie here 
            Cookie::queue('email', $user[0]->email,'0');
            Cookie::queue('password', $user[0]->password,'0');
            Cookie::queue('rememberme','1','0');

            // exit;
        }else{
            Cookie::queue( Cookie::forget('email')); //forget cookies 
            Cookie::queue( Cookie::forget('password'));
            Cookie::queue( Cookie::forget('rememberme'));
        }
        session()->put('userID',$user[0]->id);
        // session()->put('user_Name',$user[0]->first_name.' '.$user[0]->last_name);
        session()->put('user_Email',$user[0]->email);

        // DB::table('log')->insert([
        //     'user'=>$user[0]->id,
        //     'login_time' => date('Y-m-d H:i:s')
        // ]);
    }
    else if($email == 1){
        $json['result'] = 'Wrong Password';
    }else{
        $json['result'] = 'Wrong users';
    }
    // print_r(Cookie::get('rememberme'));exit;
    return $json; 
  }
  public function logout(){
    // DB::table('log')->insert([
    //     'user'=>session()->get('userID'),
    //     'logout_time' => date('Y-m-d H:i:s')
    // ]);
  }
}
?>