<?php

namespace App\Http\Controllers;
// namespace App\Models;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Reader\Xls; 

class Admin extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login()
    {
        $userID = session()->get('userID');
        if ($userID != '') {
            return redirect(url('dashboard'));
        } else {
            return view('login');
        }
    }

    public function logincheck()
    {
        $user = new User;
        $json =  $user->checklogin();
        return $json;
    }

    public function logout()
    {
        $user = new User;
        $user->logout();
        Session::flush();
        $json['result'] = 200;
        return $json;
    }

    public function excel(Request $request)
    {
        $file = $request->file('excel');
        $file_name = $file->getClientOriginalName();

        if (is_file("uploads/" . $file_name)) {
            unlink("uploads/" . $file_name);
        }
        $file->move('uploads/', '' . $file_name);

        $reader = new Xls(); 
        $spreadsheet = $reader->load('uploads/'.$file_name); 
        $worksheet = $spreadsheet->getActiveSheet();  
        $worksheet_arr = $worksheet->toArray(); 

        for ($k = 1; $k < count($worksheet_arr); $k++) {
            $address = $worksheet_arr[$k][2];
            $eng_address = $this->get_arabic_address($address);

            $data['excel'][] = array(
                'id' => $worksheet_arr[$k][0],
                'name' => $worksheet_arr[$k][1],
                'address' => $eng_address,
            );
        }

        unlink("uploads/" . $file_name);
        return view('download_excel',$data);
    }

    public function get_arabic_address($address)
    {
        $response = Http::get('https://api.mymemory.translated.net/get?q=' . $address . '&langpair=ar-SA|en-GB')->json();
        return $response['responseData']['translatedText'];
    }
}
