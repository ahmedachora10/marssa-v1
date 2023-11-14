<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Explanation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ExplanationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $Context = [
          'title_page' => 'Explanations',
          'explanations' => Explanation::all(),
        ];
        return view('dashboard.explanations.show')->with($Context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $Context = [
          'title_page' => 'Explanations',
          'explanations' => Explanation::all(),
        ];
        return view('dashboard.explanations.index')->with($Context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
          'section' => 'required|unique:explanations',
          'video_link' => 'required|url'
        ]);

        Explanation::create($request->all());


        return back()->with('success','success_explanation');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        //
        if($request->type == 'ajax'){
            $explanation = Explanation::where('section',$id)->first();
            if($explanation){
                $type_resource = strpos($explanation->video_link,'vimeo') ? 'vimeo' : 'mp4';
                $context = [
                    'status'        => 'success',
                    'explanation'   => $explanation,
                    'title_page'    => 'edit_explanation',
                    'type_resource' => $type_resource
                ];
                return view('dashboard.explanations.watch_video')->with($context);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $explanation = Explanation::find($id);
        $context = [
            'explanation' => $explanation,
            'title_page'  => 'edit_explanation',
        ];
        return view('dashboard.explanations.edit')->with($context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request,[
          'section' => [
               'required',
               Rule::unique('explanations')->ignore($id,'id'),
          ],
          'video_link' => 'required|url'
        ]);

        Explanation::where('id',$id)->update(['title'=>$request->title,
                             'description'=>$request->description,
                             'section'    =>$request->section,
                             'video_link' =>$request->video_link]);


        return back()->with('success','success_explanation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Explanation::destroy($id);
        return back();
    }
}
