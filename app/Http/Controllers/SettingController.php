<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    



    public function create()
    {
         $setting=Setting::first();
         if($setting)
         {
            return view('backend.setting.edit',compact('setting'));
         }
         else{
            return view('backend.setting.create');
         }
          
    }

    public function store(Request $request)
    {
        
        $setting= new Setting;
        $setting->name=$request->name;
        $setting->email=$request->email;
        $setting->address=$request->address;
        $setting->phone_no=$request->phone_no;
        $setting->contact_no=$request->contact_no;
        $setting->description=$request->description;
        $setting->facebook_id=$request->facebook_id;
        $setting->twitter_id=$request->twitter_id;
     
        if($request->file('icon'))
        {
            $file = $request->file('icon');
            $filename=$file->getClientOriginalName();
            $destinationPath = 'Uploads/Setting';
            $file->move($destinationPath,$filename);
            $setting->logo=$filename;
        }

        $setting->save();

         return redirect()->route('setting.edit');


    }

    public function edit()
    {
          $setting=Setting::first();
          return view('backend.setting.edit',compact('setting'));
    }



    public function update(Request $request,$id)
    {
        
        $setting=Setting::find($id);
        $setting->name=$request->name;
        $setting->email=$request->email;
        $setting->address=$request->address;
        $setting->phone_no=$request->phone_no;
        $setting->contact_no=$request->contact_no;
        $setting->description=$request->description;
        $setting->facebook_id=$request->facebook_id;
        $setting->twitter_id=$request->twitter_id;
     
        if($request->file('icon'))
        {
            $file = $request->file('icon');
            $filename=$file->getClientOriginalName();
            $destinationPath = 'Uploads/Setting';
            $file->move($destinationPath,$filename);
            $setting->logo=$filename;
        }



     
        $setting->save();
       
        return redirect()->back();
    }
}
