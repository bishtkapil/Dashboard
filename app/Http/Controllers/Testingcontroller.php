<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;


class Testingcontroller extends Controller
{
    //
    function login(){
        return view('login');
    }

    function index(){
        $data  =  DB::table('testing')->get();
        // return $data;
        return view('testingform',compact('data'));
    }


    function formstore(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'course' => 'required',
            'phone' => 'required',
        ]);
        DB::table('testing')->insert([
            'name' => $request->input('name'),
            'course' => $request->input('course'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
       ]);

       return redirect('testingform')->with('success', 'Successfully inserted.');
    }

    function edit(Request $request){

        $edit_id = $request->route('id');
        $data = DB::table('testing')->where('id',$edit_id)->get();
        return view('edit',compact('data'));
    }


    function update(Request $request ,$id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'course' => 'required',
            'phone' => 'required',
        ]);
       DB::table('testing')
            ->where('id',$id)
            ->update([
            'name' => $request->input('name'),
            'course' => $request->input('course'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),

       ]);

       return redirect('testingform')->with('success', 'Successfully Updated.');
    }

    function delete(Request $request ,$id){


       DB::table('testing')
            ->where('id',$id)
            ->delete();

       return redirect('testingform')->with('success', 'Successfully Deleted.');
    }

    function table(){

        return view('table');
     }


    public function saveToDatabase(Request $request)
    {
        $formData = $request->input('formData');

        foreach ($formData as $data) {
            DB::table('datatable')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
           ]);

        }

        return response()->json(['message' => 'Data saved to the database']);
    }


}
