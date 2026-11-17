<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
class CareerController extends Controller
{
     public function index()
    {
       $careers = Career::all();
       return view('careers.index', compact('careers')); 
    }


    public function create()
    {
      return view('careers.create'); 
    }


    public function store(Request $request)
    {
       $this->validate($request,[

        'title'         => 'required',
        'description'   => 'required',
        ]);

        $career                = new Career();
        $career->title         = $request->title;
        $career->description   = $request->description;
        $career->save();

        return redirect()->back()->with('success', 'Your Career has been created');
    }

    public function show($id)
    {
      $career        = Career::find($id);
      return view('Careers.show', compact('Career', 'industries', 'services', 'setting', 'Careers')); 
    }

    public function edit($id)
    {
       $career = Career::find($id);
       return view('careers.edit', compact('career'));   
    }


    public function update(Request $request, $id)
    {
         $this->validate($request,[

        'title'         => 'required',
        'description'   => 'required',


        ]);

        $career                = Career::find($id);
        $career->title         = $request->title;
        $career->description   = $request->description;
        $career->save();

        return redirect()->back()->with('success', 'Career post has been updated');
    }


    public function destroy($id)
    {
       $career = Career::find($id);
       $career->delete();
       return redirect()->back()->with('success', 'Career post has been deleted');  
    }


    public function jobPost()
    {
       $careers = Career::all();
       return view('careers.list', compact('careers')); 
    }


    public function jobView($id)
    {
       $career = Career::find($id);
       return view('careers.view', compact('career')); 
    }
}
