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
           <div id="print_div">
              
			  <table class="table" style="width:100%;">
               <tr>
                   <td style="border:0;text-align:center;">التجـــــــارة</td>
               </tr>
             </table>
             <table class="table" style="width:50%;">
               <tr>
                 <td style="border:0;width:40%;">الأسم</td>
                 <td style="border:0;">{{$raw->name}}</td>
               </tr>
               <tr>
                 <td style="border:0;width:40%;">رقم الهاتف</td>
                 <td style="border:0;">{{$raw->phone}}</td>
               </tr>
               <tr>
                 <td style="border:0;width:40%;">رقم الفاتورة</td>
                 <td style="border:0;">{{$raw->id}}</td>
               </tr>
             </table>
             <div class="ls-editable-table table-responsive ls-table">
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
                  <?php $total = 0; $qty = 0; ?>
                  @foreach($data as $key => $row)
                   @foreach(App\Product::where('pro_code',$row->pro_code)->get() as $pro) @endforeach
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{$pro->slug}}</td>
                          <td class='text-center'>{{$row->price}}</td>
                          <td class='text-center'>{{$row->qty}}</td>
                          <td class="text-center">{{$row->price*$row->qty}}</td>
                      </tr>
                   <?php $total += $row->price*$row->qty; $qty += $row->qty; ?>
                  @endforeach
                      <tr>
                        <td colspan="3" class="text-center">الإجمالي شامل سعر الضربية والقسط</td>
                        <td class="text-center">{{$qty}}</td>
                        <td class="text-center">{{number_format($raw->total,2)}}</td>
                      </tr>
                </tbody>
               </table>
            </div>

              <table class="table" style="width:50%;">
               <tr>
                 <td style="border:0;width:30%;">المقدم</td>
                 <td style="border:0;">{{number_format($raw->paid,2)}}</td>
               </tr>
               <tr>
                 <td style="border:0;width:30%;">المتبقي</td>
                 <td style="border:0;">{{number_format($raw->remain,2)}}</td>
               </tr>
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
