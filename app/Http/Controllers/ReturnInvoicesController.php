<?php

namespace App\Http\Controllers;

use App\factory;
use App\return_invoices;
use Illuminate\Http\Request;

class ReturnInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = return_invoices::all();

        return view('backend.returnInvoices.list')->with('data',$data) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factories = factory::all();

        return view('backend.returnInvoices.create')->with('factories',$factories) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());

        $factories_id   = $request->factories_id;
        $code           = $request->code;
        $price          = $request->price;
        $price_d        = $request->price_d;
        $quantity       = $request->quantity;




//        try {
//            return DB::transaction(function()
//            {
//                $factoryId        = Input::get('factories_id');
//
//
//                $row             = new return_invoices();
//                $row->factories_id   = $factoryId->id;
//
//                $row->code   = Input::get('code');
//                $row->price      = Input::get('price');
//                $row->price      = Input::get('price');
//                $row->qty        = Input::get('qty');
//
//                $row->save();
//
//
//                $movment = new item_movement;
//                $movment->pro_code   = Input::get('pro_code');
//                $movment->type_go    = 2;
//                $movment->type_id    = $row->id;
//                $movment->price      = Input::get('price');
//                $movment->qty        = Input::get('qty');
//                $movment->reason     = '  فاتورة مرتجع  فواتير مشتريات';
//                $movment->save();
//
//                $pro = Product::where('pro_code',$row->pro_code)->first();
//                $pro->qty = $pro->qty - $row->qty;
//                $pro->save();
//
//                if(!empty(Input::get('pro_codes'))) {
//                    $features = [];
//                    foreach(Input::get('pro_codes') as $key => $feature){
//                        $features[] = [
//                            'invoice_id' => $row->id,
//                            'pro_code' => Input::get('pro_codes')[$key],
//                            'price' => Input::get('prices')[$key],
//                            'qty' => Input::get('qtys')[$key],
//                            'content' => Input::get('contents')[$key]
//                        ];
//                        $pps = Product::where('pro_code',Input::get('pro_codes')[$key])->first();
//                        $pps->qty = $pps->qty - Input::get('qtys')[$key];
//                        $pps->save();
//
//                        $movment = new item_movement;
//                        $movment->pro_code   = Input::get('pro_codes')[$key];
//                        $movment->type_go    = 1;
//                        $movment->type_id    = $row->id;
//                        $movment->price      = Input::get('prices')[$key];
//                        $movment->qty        = Input::get('qtys')[$key];
//                        $movment->reason     = 'فاتورة مرتجع  فواتير مشتريات ';
//                        $movment->save();
//
//
//                    }
//                    Return_invoice_attribute::insert($features);
//                }
//
//                if(Input::get('paid') > 0) {
//                    /* Balance */
//                    $rows = new Balance;
//                    $rows->type = 3;
//                    $rows->date = date('Y-m-d');
//                    $rows->amount = $row->paid;
//                    $rows->reason = 'فاتورة مرتجع  فواتير مشتريات';
//                    $rows->save();
//                }
//
//
//
//
//                Session::flash('success','تم حفظ الفاتورة بنجاح');
//                return Redirect::to('returnInvoices');
//            });
//
//
//        }catch(\Exception $e) {
//            dd($e);
//            Session::flash('error','لم يتم حفظ الفاتورة كود المنتج غير صحيح ');
//            return Redirect::back();
//        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\return_invoices  $return_invoices
     * @return \Illuminate\Http\Response
     */
    public function show(return_invoices $return_invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\return_invoices  $return_invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(return_invoices $return_invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\return_invoices  $return_invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, return_invoices $return_invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\return_invoices  $return_invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(return_invoices $return_invoices)
    {
        //
    }
}
