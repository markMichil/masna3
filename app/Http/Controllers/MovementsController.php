<?php

namespace App\Http\Controllers;

use App\movements;
use App\product;
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
//        if(!empty($pro_code)){
//            dd($request->all());
//            $product = Product::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])->
//            where('code',$pro_code)->first();
//
//            if($product){
////                dd($product);
//                $pro = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('code',$pro_code)->get();
//                if(!empty($product))
//                    $name= $product->slug;
//                $Quantaty = $product->qty;
//
//
//                $totalBuy = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',1)->get()->sum('qty');
//
//                $totalBuyMoney = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',1)->get()->sum('price');
//
//                $totalBuyReturn = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',2)->get()->sum('qty');
//
//
//                $totalBuyReturnMoney = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',2)->get()->sum('price');
//
//                $totalSell = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',3)->get()->sum('qty');
//
//                $totalSellMoney = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',3)->get()->sum('sell');
//
//                $totalSellReturn = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',4)->get()->sum('qty');
//
//                $totalSellReturnMoney = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',4)->get()->sum('sell');
//
//                $totalSellOrder = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',5)->get()->sum('qty');
//
//                $totalSellMoneyOrder = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',5)->get()->sum('sell');
//
//                $totalSellOrderReturn = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])->
//                where('pro_code',$pro_code)->where('type_go',6)->get()->sum('qty');
//
//                $totalSellOrderReturnMoney = item_movement::whereBetween('created_at',[$from." 00:00:00",$to." 00:00:00"])
//                    ->where('pro_code',$pro_code)->where('type_go',6)->get()->sum('sell');
//
//            }
//
//
//        }






        $from_month = $request->from_month;
        $from_year = $request->from_year;
        $to_month = $request->to_month;
        $to_year = $request->to_year;

        if($from_month == 'all'){
            $from_month = '01';
        }if($to_month == 'all'){
        $to_month = '12';
    }
        $from = '1-'.$from_month.'-'.$from_year;
        $from = $from_year.'-'.$from_month.'-01';
        $to = $to_year.'-'.$to_month.'-01';
        $from.=" 00:00:00";
        $to.=" 00:00:00";

        $pro_code = $request->pro_code;

        $name = '';
        $pro = array();

        $totalBuy = 0;
        $totalBuyMoney = 0;

        $totalBuyReturn = 0;
        $totalBuyReturnMoney = 0;

        $totalSell = 0;
        $totalSellMoney = 0;

        $totalSellReturn = 0;
        $totalSellReturnMoney = 0;

        $totalSellOrder = 0;
        $totalSellMoneyOrder = 0;

        $totalSellOrderReturn = 0;
        $totalSellOrderReturnMoney = 0;

        $Quantaty = 0;

        $product = array();
        if(!empty($pro_code)){

            $product = product::where('code',$pro_code)
                ->with('factory')
                ->with(['movements'=>function ($query) use($from , $to){
                    $query->whereBetween('created_at',[$from,$to]);
                    $query->with('type_movements');
                }])
                ->first();

//

        }





        return view('backend.itemMovement.products')
            ->with('tb',$totalBuy)
            ->with('tbm',$totalBuyMoney)

            ->with('tbr',$totalBuyReturn)
            ->with('tbrm',$totalBuyReturnMoney)

            ->with('ts',$totalSell)
            ->with('tsm',$totalSellMoney)

            ->with('tsr',$totalSellReturn)
            ->with('tsrm',$totalSellReturnMoney)


            ->with('tso',$totalSellOrder)
            ->with('tsmo',$totalSellMoneyOrder)

            ->with('tsor',$totalSellOrderReturn)
            ->with('tsorm',$totalSellOrderReturnMoney)

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
