<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use Illuminate\Support\Facades\Validator;
class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $branches = auth()->user()->store->branches;
        $Context = [
          'title_page' => 'Branches',
          'branches'   =>  $branches,
        ];
        return view('dashboard.branches.index')->with($Context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validation = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with('error','error_branch');
        }
        auth()->user()->store->branches()->create($request->all());
        toast('success_branch','success');
        return back();
        //return back()->with('success','success_branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $Context = [
          'title_page' => 'Edite Branches',
          'branch'     =>  Branch::find($id),
        ];
        return view('dashboard.branches.edit')->with($Context);
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
        $validation = Validator::make($request->all(),[
            'name' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->with('error', 'error_branch');
        }
        Branch::where('id',$id)->update(['name' => $request->name]);
        toast('success_branch','success');
        return back();
        //return back()->with('success','success_branch');
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
         Branch::destroy($id);
         return back();
    }
}
