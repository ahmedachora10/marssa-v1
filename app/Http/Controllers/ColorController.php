<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


use DB;
use App\Colors;


    

class ColorController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function color(Request $request)
    {
        $context = ['title_page' => 'color'];
        $colors = \App\Colors::get();
        $context['colors'] = $colors; 
        return view('dashboard.color.color', $context);
    }

    public function add(Request $request)
    {
        $context = ['title_page' => 'color'];
       
        return view('dashboard.color.add', $context);
    }

    public function edit(Request $request)
    {
       

        $color =  DB::table('colors')->where('id', $request->id)->first();
        
        if(empty($color)){
            return redirect()->route('dashboard.admin.color.index');
        };
        $context = ['title_page' => 'color'];
        $context['color'] = $color;
     
       
        return view('dashboard.color.edit', $context);
    }

    public function update(Request $request)
    {
        
        $color = DB::table('colors')->where('id', $request->id)->first();

        if(empty($color)){
            return redirect()->route('dashboard.admin.color.index');
        };

       DB::table('colors')
         ->where('id', $request->id)
         ->update([
            'color_ar' => $request->color_ar,
            'color_en' => $request->color_en,
            'color_fr' => $request->color_fr,
       ]);
        
       toast(__('master.Successfully'),'success');
        return redirect()->route('dashboard.admin.color.index');
        //return redirect()->route('dashboard.admin.color.index')->with('success', 'Successfully');
    }

    public function delete(Request $request)
    {       
        DB::table('colors')->where('id', $request->id)->delete();
        toast(__('master.Successfully'),'success');
        return redirect()->route('dashboard.admin.color.index');
        //return redirect()->route('dashboard.admin.color.index')->with('success', 'Successfully');

    }

    public function save(Request $request)
    {
        $color = new Colors;
       
        
        $color->color_ar = $request->color_ar;
        $color->color_en = $request->color_en;
        $color->color_fr = $request->color_fr;
        $color->save();
      
        toast(__('master.Successfully'),'success');
        return redirect()->route('dashboard.admin.color.index');
        //return redirect()->route('dashboard.admin.color.index')->with('success', 'Successfully');
        
    }
    
    

    }
