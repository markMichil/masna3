<?php

namespace App\Http\Controllers;

use App\movements;
use App\product;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class MovementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from_month     = $request->from_month;
        $from_year      = $request->from_year;
        $to_month       = $request->to_month;
        $to_year        = $request->to_year;

        if($from_month == 'all'){
            $from_month = '01';
        }
        if($to_month == 'all'){
        $to_month = '12';
    }

        $from       = $from_year.'-'.$from_month.'-01';
        $to         = $to_year.'-'.$to_month.'-01';
        $from       .=" 00:00:00";
        $to         .=" 00:00:00";

        $pro_code    = $request->pro_code;

        $name        = '';
        $Quantaty    = 0;

        $product     = array();


        $buy                =   0;
        $sell               =   0;
        $returnBuy          =   0;
        $returnSell         =   0;

        $buyProduct         =   0;
        $sellProduct        =   0;
        $returnBuyProduct   =   0;
        $returnSellProduct  =   0;




        if(!empty($pro_code)){

            $product = product::where('code',$pro_code)
                ->with('factory')
                ->with(['movements'=>function ($query) use($from , $to){
                    $query->whereBetween('created_at',[$from,$to]);
                    $query->with('type_movements');
                }])
                ->first();

            if($product){
                $Quantaty = $product->quantity;
                $name = $product->name;
            }

            else{
                Session::flash('error','كود العباية خطأ او المدة غير صحيحة اعد الادخال');
                return Redirect::back();
            }


        }


        return view('backend.itemMovement.products')

            ->with('buyProduct',$buyProduct)
            ->with('buy',$buy)

            ->with('returnBuyProduct',$returnBuyProduct)
            ->with('returnBuy',$returnBuy)

            ->with('sell',$sell)
            ->with('sellProduct',$sellProduct)


            ->with('returnSellProduct',$returnSellProduct)
            ->with('returnSell',$returnSell)

            ->with('name',$name)
            ->with('qty',$Quantaty)

            ->withdata($product);
        return view('backend.ItemMovement.products');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\movements  $movments
     * @return \Illuminate\Http\Response
     */
    public function show(movements $movments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\movements  $movments
     * @return \Illuminate\Http\Response
     */
    public function edit(movements $movments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movements  $movments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, movements $movments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\movements  $movments
     * @return \Illuminate\Http\Response
     */
    public function destroy(movements $movments)
    {
        //
    }
}
