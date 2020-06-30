<?php

namespace App\Http\Controllers;

use App\factory;
use App\product;
use App\return_invoices;
use App\return_invoice_details;
use App\cart_return_invoice;
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

        $data = return_invoices::with('factory')
            ->with('return_invoice_details')
            ->get();

        return view('backend.returnInvoices.list')->with('data',$data) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = cart_return_invoice::with('product')->with('factory')->get();

        $factories = factory::all();

        return view('backend.returnInvoices.create')
            ->with('data',$data)
            ->with('factories',$factories) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carts = cart_return_invoice::get();

        $factories_id = $carts[0]['factories_id'];




        $total = $request->total;
        $paid = $request->paid;
        $remain = $request->remain;
        $type_buy = 1;
        $done = 0;

                $return_Invoice = new return_invoices();
        $return_Invoice['factories_id'] = $factories_id;
        $return_Invoice['total_price'] = $total;
        $return_Invoice['paid'] = $paid;
        $return_Invoice['remains'] = $remain;
        $return_Invoice['type_buy'] = $type_buy;
        $return_Invoice['done'] = $done;
        $return_Invoice->save();


         foreach ($carts as $cart)
        {
            $cart_return_invoice = new return_invoice_details();
            $cart_return_invoice['return_invoices_id'] = $return_Invoice->id;
            $cart_return_invoice['products_id'] = $cart['products_id'];

            $cart_return_invoice['quantity'] = $cart['quantity'];
            $cart_return_invoice['price'] = $cart['price'];
            $cart_return_invoice['price_d'] = $cart['price_d'];
             $cart_return_invoice->save();

        }


        try {
            cart_return_invoice::truncate();
                \Session::flash('success','تم حفظ الفاتورة بنجاح');
            return \Redirect::to('returnInvoices');
        }catch (\Exception $e){

             \Session::flash('error','لم يتم حفظ الفاتورة كود المنتج غير صحيح ');
            return \Redirect::back();

        }







//        $factories_id   = $request->factories_id;
//        $code           = $request->code;
//        $price          = $request->price;
//        $price_d        = $request->price_d;
//        $quantity       = $request->quantity;




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


    #Search
    public function search_pro(Request $request)
    {

        $procode = $request->input('val');
        $factoryId = $request->input('fac');

        if(Product::where('code',$procode)->where('factories_id',$factoryId)->count() > 0 )
        {
            $pro = Product::where('code',$procode)->where('factories_id',$factoryId)->first();
            return \Response::json([
                'state'=>true,

                'procode' => $pro->code,
                'id' => $pro->id,
                'image' => url($pro->image),
                'proname' => $pro->name,
                'price' => $pro->price,
                'price_d' => $pro->price_D,
                'qty' => $pro->quantity
            ]);
        } else
            return \Response::json(['state'=>false,'msg'=>'المصنع خطا او كود العباية غير موافق للمصنع']);
    }

    #Add To Cart
    public function add_to_cart(Request $request)
    {

        $isExits = cart_return_invoice::where('products_id','=',$request->product_id)->exists() ;
        if( $isExits == true){
            \Session::flash('error','هذا المنتج موجود بالفعل ');
            return \Redirect::back();

        }



        $product = product::find($request->product_id);
//        dd($product);
        $row = new cart_return_invoice();
        $row->products_id = $product->id;
        $row->factories_id = $product->factories_id;
        $row->quantity = 1;
        $row->price = $product->price;
        $row->price_d = $product->price_D;


        try
        {
            $row->save();
            \Session::flash('success','تم إضافة العبايات بنجاح');
        }catch(\Exception $e) {
            \Session::flash('error','لم يتم إضافة العبايات');
        }
        return \Redirect::back();
    }

    #Update Qty
    public function update_qty($id,$value, Request $request)
    {

        $cart = cart_return_invoice::find($id);
        $cart->quantity = $value;

        try{
            $cart->save();
            \Session::flash('success','تم تعديل المبيعات بنجاح');
        }catch(\Exception $e){
            \Session::flash('error','لم يتم تعديل المبيعات');
        }
    }

    public function update_qty_update($id,$value, Request $request)
    {

        $cash = Cash_other::find($id);
        $pro = Product::where('pro_code',$cash->pro_code)->first();

        if($value > $cash->qty) {
            $new_qty = $value - $cash->qty;
            $pro->qty = $pro->qty - $new_qty;
        } else {
            $new_qty = $cash->qty - $value;
            $pro->qty = $pro->qty + $new_qty;
        }
        $pro->save();
        $cash->qty = $value;
        try{
            $cash->save();
            Session::flash('success','تم تعديل العبايات  بنجاح');
        }catch(\Exception $e){
            Session::flash('error','لم يتم تعديل العبايات');
        }
    }


    # Calc Total Cart
    public function calc_total_cart()
    {

        $cashs = cart_return_invoice::get();

        $total = 0;
        $i = 0;
        foreach($cashs as $cash){

            if($cash->price_d != null && $cash->price_d >0){
                $i++;
                $total += $cash->price_d*$cash->quantity;
            }else{
                $total += $cash->price*$cash->quantity;
            }

        }

        return \Response::json([
            'state'=>true,
            'total' => $total,
            'discount' => $i,
        ]);
    }


    public function calc_total_cart_update($id)
    {
        $cashs = Cash::where('id',$id)->first();
        $total = 0;
        foreach(json_decode($cashs->cash_id) as $cash){
            $pro = Cash_other::where('id',$cash)->first();
            $total += $pro->price*$pro->qty;
        }

        return Response::json([
            'state'=>true,
            'total' => $total,
        ]);
    }




    # Remove Form Cart
    public function remove_from_cart($id)
    {
        $cart = cart_return_invoice::find($id);



//        $cash = Return_cash_other::find($id);
        if(!$cart) {
            return \Redirect::back();}
        try{
            $cart->delete();
            \Session::flash('success','تم حذف المرتجع بنجاح');
        } catch(\Exception $e) {
            \Session::flash('error','لم يتم حذف المرتجع');
        }
        return \Redirect::back();
    }

    public function remove_from_cart_update($id,$getid)
    {
        $cash = Return_cash_other::find($id);
        if(!$cash) {
            return Redirect::back();}
        try{
            $pro = Product::where('pro_code',$cash->pro_code)->first();
            $pro->qty = $pro->qty - $cash->qty;
            $pro->save();
            $cash->delete();

            // remove from table json
            $app = Return_cashes::find($getid);
            $decoded = json_decode($app->cash_id, true);
            if(($key = array_search($id, $decoded)) !== false) {
                unset($decoded[$key]);
            }
            $app->cash_id = json_encode($decoded);
            $app->save();
            Session::flash('success','تم حذف المرتجع بنجاح');
        } catch(\Exception $e) {
            Session::flash('error','لم يتم حذف المرتجع');
        }
        return Redirect::back();
    }






}
