<?php

namespace App\Http\Controllers;

use App\factory;
use App\product;
use App\return_invoices;
use App\return_invoice_details;
use App\cart_return_invoice;
use App\cart;
use App\invoices;
use App\invoice_details;
use App\movements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = product::with('factory')->get();

        return view('backend.invoices.list')->with('data',$data) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(request()->all());
        // $data = factory::get();
// $this->get_products();
        $data = cart::with('product')->with('factory')->get();

        $factories = factory::all();

        return view('backend.invoices.create')->with('factories',$factories)->with('data',$data) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

public function save_invoice(Request $request){
        // dd($request->all());

         $total   = $request->total;
         $paid   = $request->paid;
         $remain   = $request->remain;
         $factory_id   = $request->factory_id;


      $invoice_id = invoices::insertGetId([
        'factories_id' => $factory_id,
        'paid' => $paid,
        'remains' => $remain,
        'total_price' =>$total ,
        'type_buy' => 1,
        'done' => 0,
    ]);
      // dd($invoice_id);

      // invoices_id','products_id','quantity','price','sell','sell_D','price_D'

        $carts  = cart::where('factories_id','=',$factory_id)->get();

        foreach($carts as $cart){
            // dump($cart);
            
        // $invoices_id   = $cart->invoices_id;
        $products_id   = $cart->products_id;
        $price         = $cart->price;
        $sell          = $cart->sell ;
        $quantity      = $cart->quantity;
        $sell_D        = $cart->sell_D  ? $cart->sell_D  : 0 ;
        $price_D      = $cart->price_D;
        
        $invoice_details = invoice_details::create([
            'invoices_id'=> $invoice_id,
            'products_id'=> $products_id,
            'quantity'=> $quantity,
            'price'=> $price,
            'sell'=> $sell,
            'sell_D'=> $sell_D,
            'price_D'=> $price_D
        ]);

        // dd($invoice_details);

        $Product = product::find($products_id);  
        $add_qty = $Product->quantity + $quantity;
        $Product = product::where('id','=',$products_id)->update(['quantity' => $add_qty]);


$reasonString = 'فاتورة رقم';
 $movement = new movements();
            $movement->products_id =  $products_id;
            $movement->type_movements_id = 1;
            $movement->price = $price;
            $movement->sell = $sell;
            $movement->qty = $quantity;
            $movement->reason = $reasonString.' ('.$invoice_id.')';
            $movement->save();

// dd($add_qty);      

  }
        // 
        // dd($quantity);

return 'sucess';

}

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

/**************************************************************************************/

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
        // dd($request->all());

    $isExits = cart::where('products_id','=',$request->product_id)->exists() ;
    if( $isExits == true){
     \Session::flash('error','هذا المنتج موجود بالفعل ');
            return \Redirect::back();

    }
            $product = product::find($request->product_id);

//        dd($product);
        $row = new cart();
        $row->products_id = $product->id;
        $row->factories_id = $product->factories_id;
        $row->quantity = $product->quantity;
        $row->price = $product->price;
        $row->sell = 0;

// dd($row);
        try
        {
            $row->save();

            \Session::flash('success','تم إضافة العبايات بنجاح');
        }catch(\Exception $e) {
            \Session::flash('error','لم يتم إضافة العبايات');
        }
        return \Redirect::back();
    }
/**************************************************************************************/

    #Update Qty
    public function update_qty($id,$value, Request $request)
    {

        $cart = cart::find($id);
        $cart->quantity = $value;

        try{
            $cart->save();
            \Session::flash('success','تم تعديل المبيعات بنجاح');
        }catch(\Exception $e){
            \Session::flash('error','لم يتم تعديل المبيعات');
        }
    }

/**************************************************************************************/
      public function update_price_D($id,$value,$price_D, Request $request)
    {
        $cart = cart::find($id);

        $cart->price_D = $price_D;
        $cart->quantity = $value;
// dd($cart);
        try{
            $cart->save();

            
            \Session::flash('success','تم تعديل المبيعات بنجاح');
        }catch(\Exception $e){
            \Session::flash('error','لم يتم تعديل المبيعات');
        }
    }
/**************************************************************************************/

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

        $cashs = cart::get();

        $total = 0;
        $i = 0;
        foreach($cashs as $cash){

            if($cash->price_D != null && $cash->price_D >0){
                $i++;
                $total += $cash->price_D*$cash->quantity;
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


public function deleteFromCart ($id){
// dd($id);

$delete =  cart::where('id','=',$id)->delete();

return redirect('invoices/create')->with('success','تم ازاله المنتج');
}





}
