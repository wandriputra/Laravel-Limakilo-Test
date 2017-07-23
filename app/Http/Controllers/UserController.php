<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// use Illuminate\Contracts\Auth\Guard;

use Session;

class UserController extends Controller
{
    //
    private $username = 'root@root.com';
    private $password = 'root';

    function __construct(){

    }

    function getLogin(){
      if(!Session::has('email')||Session::get('email') === 'kosong'){
        Session::put('email','kosong');
      }else{
        return redirect('/auth/home');
      }
      return view('auth.login');
    }

    function postLogin(Request $request){
      $data = $request->except('_token');;
      if($data['email'] == $this->username && $data['password'] == $this->password ){
        Session::put('email', $data['email']);
      }else{
        return redirect()->back();
      }
      return redirect('auth/home');
    }

    private function cekFromJson($data){
      $urljason = "http://jsonplaceholder.typicode.com/comments";
      $url="http://jsonplaceholder.typicode.com/comments";
      $json = file_get_contents($url);
      $jsonArray = json_decode($json, TRUE);
      $collection = collect($jsonArray);

      return $collection;

    }

    function getHome(){
      if(Session::get('email') === 'kosong'){
        return redirect('/auth/login');
      }
      return view('welcome');


    }

    function getLogout(){
      Session::forget('email');
        return redirect('/auth/login');
    }

}
