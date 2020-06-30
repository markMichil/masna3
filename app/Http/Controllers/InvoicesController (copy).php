<?php

namespace App\Http\Controllers;
use App\factory;
use App\product;

use App\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use Session;
use Redirect;
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

        return view('backend.invoices.list')
           ->with('data',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
$data = factory::get();
$this->get_products();
return view('backend.invoices.create')
->with('data',$data);

}

private function factories(){
$factories = factory::all();
return $factories;
}

// ===================================
public function get_products(){
if(request()->ajax()){ 
$data = request()->get('data');
$factory_id = $data['factory_id'];
$search = $data['search'];
// if($data != ''){
$product = product::where('name','LIKE','%'.$search.'%')->where('factories_id','=',$factory_id)->get();
$html_product='';
if( $product->count()> 0 ){

            foreach ($product as $value)
            {
            $product_id = $value['id'];
            $name = $value['name'];
            $html_product .= "
            <li class='list-group-item' > <input type='hidden'  name='product_id' value=$product_id> $name</li>
            ";    
            }

    }else {
            $html_product = "
            <li class='list-group-item'>  لا يوجد منتج بهذا الاسم </li>
            ";

    }

// }
 
  $data_array = array('html_product'=>$html_product);

  // echo  response(['response'=>$data_array]);
    echo   json_encode($data_array);
    exit();
    // return view('backend.invoices.create')->with('all',$all);
}
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
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }
}
