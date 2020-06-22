@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الفاتورة</h3>


@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  
   <div class="row col-md-8">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">طباعة الفاتورة</h3>
            </div>
      <div class="panel-body">

        <div class="col-md-12">
             
             <div id="print_div" class="ls-editable-table table-responsive ls-table">
			 <table class="table" style="width:100%;">
               <tr>
                 <td style="border:0;text-align:center;">التجـــــــارة</td>
                 <td style="border:0;text-align:center;"><img src="{{url('elixir/images/1.png') }}"></td>
                 <td style="border:0;text-align:center;">ت/01111111111  ـ/ 01212121212</td>
                 <td style="border:0;text-align:center;"></td>

               </tr>
                 <tr>
                     <td>التاريخ / </td>
                     <td style="border:0;text-align:center;"><?php

                         $mytime = Carbon\Carbon::now();
                         echo $mytime->toDateTimeString();
                         ?></td>


                 </tr>
             </table>
			 <table class="table" style="width:100%; border: 0.1px dotted;">
               <tr>
                 <td style="border:0;width:40%;">الأسم/</td>
                 <td style="border:0;">{{$row->name}}</td>
               </tr>

               <tr>
                 <td style="border:0;width:40%;">رقم الهاتف/</td>
                 <td style="border:0;">{{$row->phone}}</td>
               </tr>

               <tr>
                 <td style="border:0;width:40%;">رقم الفاتورة/</td>
                 <td style="border:0;">{{$row->id}}</td>
               </tr>

             </table>
              <table class="table table-bordered  table-bottomless">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>أسم المنتج</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>السعر</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الكمية</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الإجمالي</th>
                    </tr>
               </thead>
               <tbody>
                 
                  @foreach($data as $key => $rows)
                   @foreach(App\Product::where('pro_code',$rows->pro_code)->get() as $pro) @endforeach
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{$pro->slug}}</td>
                          <td class='text-center'>{{$rows->price}}</td>
                          <td class='text-center'>{{$rows->qty}}</td>
                          <td class="text-center">{{$rows->price*$rows->qty}}</td>
                      </tr>
                  @endforeach


                  <table class="table" style="width:100%;">
                      <tr>
                          <td style="border:0;width:30%;">الإجمالي</td>
                          <td style="border:0;">{{$row->total}}</td>
                      </tr>
                      <tr>
                          <td style="border:0;width:30%;">الخصم</td>
                          <td style="border:0;">{{$row->discount}}</td>
                      </tr>
                      <tr>
                          <td style="border:0;width:30%;">الإجمالي بعد الخصم</td>
                          <td style="border:0;">{{$row->total_after_dis}}</td>
                      </tr>
                  </table>



                </tbody>
               </table>
            </div>


            
            <div class="row col-md-4 form-group">
               <button onclick="printContent('print_div')" type="button" class="btn btn-primary" type="button"><i class="fa fa-print"></i> طباعة الفاتورة</button>
            </div>

        </div>
 
      </div>
     </div>
   </div>



  </div>
</div>
</section>
@stop

@section('jsCode')
<script>
function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}
</script>
@stop
