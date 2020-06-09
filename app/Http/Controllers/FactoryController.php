<?php

namespace App\Http\Controllers;

use App\factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('backend.factories.create');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
         $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ]);

         factory::create($validatedData);
         return back()->with(['success' => ' your data saved ']);

      // dd(request()->all());     



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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function show(factory $factory)
    {
    $all_factory= factory::get();
         return view('backend.factories.list',compact('all_factory'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function edit(factory $factory)



    {
        $factory_data = factory::find(request('id'));
        

     

           return view('backend.factories.edit', compact('factory_data'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, factory $factory)
    {
        $update_factory = factory::find(request('id'));
        $update_factory->name = request('name');
        $update_factory->phone = request('phone');
        $update_factory->address = request('address');
        $update_factory->save();

        return redirect('factories')->with("success", 'تم تعديل بينتاك');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function destroy(factory $factory)
    {
        $delete = factory::find(request('id'));
        $delete->delete();
        return redirect("factories")->with('message', 'تم حذف المصنع ');
    }
}
