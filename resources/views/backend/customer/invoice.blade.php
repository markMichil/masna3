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
                   <td style="border:0;text-align:center;">مكتب جون للعبايات </td>
{{--                   <td style="border:0;text-align:center;"><img src="{{url('elixir/images/1.png') }}"></td>--}}
                  
               </tr>
                 <tr>
                     <td>التاريخ / </td>
                     <td style="border:0;text-align:center;"><?php

                         $mytime = Carbon\Carbon::now();
                         echo $mytime->toDateTimeString();
                         ?></td>


                 </tr>
             </table>
			 <table class="table" style="width:50%;">
               <tr>
                 <td style="border:0;width:40%;"> الأسم/</td>
                 <td style="border:0;">{{$name}}</td>
                   <hr>

               </tr>
             </table>
              <table class="table table-bordered  table-bottomless">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>مبلغ المدفوع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التفاصيل</th>
                    </tr>
               </thead>
               <tbody>

                  {{--@foreach($data as $key => $rows)--}}
                   {{--@foreach(App\Product::where('pro_code',$rows->pro_code)->get() as $pro) @endforeach--}}
                      <tr>
                          <td class='text-center'>1</td>
                          <td class='text-center'>{{$date}}</td>
                          <td class='text-center'>{{$paid}}</td>
                          <td class='text-center'>{{$note}}</td>

                      </tr>
                  {{--@endforeach--}}

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
