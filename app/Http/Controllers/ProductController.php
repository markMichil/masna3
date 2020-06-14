<?php

namespace App\Http\Controllers;

use App\factory;
use App\product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use Session;
use Redirect;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = product::with('factory')->get();

        return view('backend.products.list')
           ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factories = $this->factories();
        return view('backend.products.create')
            ->with('factories',$factories);

    }

    private function factories(){
        $factories = factory::all();
        return $factories;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules =
            [
                'code' => 'unique:products,code',
                'factory_id' => 'required',


            ];

        $validate = Validator::make(Input::all(),$rules);
        if($validate->fails())
        {
            return Redirect::back()->withInput()->withErrors($validate);
        }

        $row = new product;
        $row->code = $request->input('code');


        if(Input::hasFile('image'))
        {
            $file = Input::file('image');
            $path = 'public/uploads/';
            $filename = date('Y-m-d-h-s-i').'.'.$file->getClientOriginalName();
            $file->move($path,$filename);
            $row->image = $path.$filename;
        }


        $row->factories_id= $request->input('factory_id');
        $row->name= $request->input('name');

        $row->price = $request->input('cost_price');
        $row->sell = $request->input('price');
        $row->quantity = $request->input('qty');

        try{
            $row->save();
            Session::flash('success','تم إضافة العباية بنجاح');
            return Redirect::to('products');
        } catch(\Exception $e)
        {

            Session::flash('error','لم يتم  إضافة العباية ');
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $factory = $this->factories();

        $row = Product::with('factory')->find($id);
        return view('backend.products.edit')
            ->with('factories',$factory)
            ->withrow($row);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $rules =array();
        if($request->code != $product->code ){

            $rules +=[ 'code' => 'unique:products,code',];
        }
        if($request->has('factory_id')){
            $rules +=[   'factory_id' => 'required',];
        }

        $validate = Validator::make(Input::all(),$rules);
        if($validate->fails())
        {

            return Redirect::back()->withInput()->withErrors($validate);
        }

        if($request->code != $product->code ){
            $product->code = $request->code;
        }
     if($request->has('factory_id')){
         $product->factories_id = $request->factory_id;
        }





        if(Input::hasFile('image'))
        {
            $file = Input::file('image');
            $path = 'public/uploads/';
            $filename = date('Y-m-d-h-s-i').'.'.$file->getClientOriginalName();
            $file->move($path,$filename);
            $product->image = $path.$filename;
        }

        $product->name = $request->input('name');

        $product->price = $request->input('price');
        $product->sell = $request->input('sell');
        $product->quantity = $request->input('quantity');
        try{
            $product->save();
            Session::flash('success','تم تعديل تفاصيل العباية بنجاح');

            return Redirect::to('products');
//            return Redirect::back()->perPage();
        } catch(\Exception $e){
            dd($e);
            Session::flash('error','لم يتم تعديل  تفاصيل العباية');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $delete = product::find($id);
//        dd($delete);
        if($delete['quantity'] == 0)
        {
            $delete->delete();
            return redirect("products")->with('success', 'تم حذف العباية ');
        }
        return redirect("products")->with('error', 'لم يتم حذف العباية لوجود عدد بالمخزن ');
    }
}
