@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تقارير العملاء</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">جميع العملاء ( {{count($data)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif




        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>تاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الأسم</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الهاتف</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الإجمالي</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المدفوع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المتبقي</th>
                    </tr>
               </thead>
               <tbody>
             
              <?php $total = 0; $total_remain = 0;?>
             @if($data)
               @foreach($data as $key => $row)

                   @if($row->remain > 0 )
                  <tr style="background:#ffe0e0">
                   @else
                  <tr>
                   @endif

                      <td class="text-center">{{$key+1}}</td>
                      <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                      <td class="text-center">{{$row->name}}</td>
                      <td class='text-center'>{{$row->phone}}</td>
                      <td class='text-center'>{{$row->total}}</td>
                      <td class='text-center'>{{$row->paid}}</td>
                      <td class='text-center'>{{$row->remain}}</td>
                  </tr>
                  <?php $total += $row->paid; $total_remain += $row->remain; ?>
               @endforeach
            @endif

                </tbody>
               </table>
            </div>
       
       <div class="col-md-12"><br/><br/><br/></div>
            <table class="table">
               <tr>
                 <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي المدفوعات</th>
                 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;text-align:right;'>{{number_format($total,2)}} جنيه</th>
                 <th class="text-center" style='width:5%;font-weight:bold'></th>
				 <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي المتبقي</th>
                 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;text-align:right;'>{{number_format($total_remain,2)}} جنيه</th>
                 <th class="text-center" style='width:5%;font-weight:bold'></th>
               </tr>
            </table>



         </div>
      </div>
  </div>
</div>
</section>
@stop