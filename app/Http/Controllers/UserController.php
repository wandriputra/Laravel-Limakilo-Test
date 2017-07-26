<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// use Illuminate\Contracts\Auth\Guard;

use Session;
use Datatables;
use Collection;

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

    private function cekFromJson(){
      $urljason = "http://jsonplaceholder.typicode.com/comments";
      $url="http://jsonplaceholder.typicode.com/comments";
      $json = file_get_contents($url);
      $jsonArray = json_decode($json, TRUE);
      // dd($jsonArray);
      $collection = collect($jsonArray);
      return $collection;
    }

    function getDetailData($id){
      $data = $this->cekFromJson()->whereLoose('id', $id)->values();
      return $data;
    }


    function getHome(){
      if(Session::get('email') === 'kosong'){
        return redirect('/auth/login');
      }
      return view('welcome');
    }

    function getDatatablesData($delete=false, $id=null){
      $data = $this->cekFromJson();
      if($delete || $id != null){
        $data->pop($id);
      }
      return Datatables::of($data)
                ->addColumn('action', function ($data) {
                  return '<a href="#" onclick="deleteData(this, event)" data-id="'.$data['id'].'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-trash"></i> Delete</a> | <a href="#" data-id="'.$data['id'].'" onclick="showData(this, event)" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';})
                ->make(true);
    }

    function getLogout(){
      Session::forget('email');
        return redirect('/auth/login');
    }

}
