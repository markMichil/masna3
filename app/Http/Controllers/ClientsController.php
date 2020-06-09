<?php

namespace App\Http\Controllers;

use App\clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('backend.customer.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         
         $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ]);

         clients::create($validatedData);
         return back()->with(['success' => ' تم اضافه بيانات العميل بنجاح']);
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
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        $allCustomers = clients::get();
        return view('backend.customer.list', compact('allCustomers'));
        // dd($allCustomers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(clients $clients)
    {
        $customer = clients::find(request('id'));
        return view('backend.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clients $clients)
    {
        
 $update_customer = clients::find(request('id'));
        $update_customer->name = request('name');
        $update_customer->phone = request('phone');
        $update_customer->address = request('address');
        $update_customer->save();

        return redirect('customer')->with("success", 'تم تعديل بينتاك');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(clients $clients)
    {
        $delete = clients::find(request('id'));
        $delete->delete();
        return redirect("customer")->with('message', 'تم حذف المصنع ');
    }
}
