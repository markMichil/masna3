@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تقارير المبيعات النقدي</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">نتيجة التقارير ( {{count($data)}} )</h3>
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
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>إجمالي المدفوعات</th>
                    </tr>
               </thead>
               <tbody>
                
                <?php $totals = 0; ?>
             @if($data)
               @foreach($data as $key => $row)
                  <tr>
                      <td class="text-center">{{$key+1}}</td>
                      <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                      <td class="text-center"><a href="{{ url('report/cash/check/'.$row->id) }}" style="color:#575757" target="_blank">{{$row->id}}</a></td>
                      <td class="text-center">
                          <?php $total = 0; ?>
                          @foreach(json_decode($row->cash_id) as $cashy)
                            @foreach(App\Cash_other::where('id',$cashy)->get() as $ceto)@endforeach
                            <?php
                              $total += $ceto->price*$ceto->qty;
                              ?>
                          @endforeach
                          {{Number_format($total,2)}} جنيه
                      </td>
                  </tr>
                   <?php $totals += $total; ?>
               @endforeach
            @endif

                </tbody>
               </table>
            </div>
      
       <div class="col-md-12"><br/><br/><br/></div>
            <table class="table">
               <tr>
                 <th class="text-center" style='width:10%;font-weight:bold;font-size:16px;'>الإجمالي</th>
                 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;'>{{number_format($totals,2)}} جنيه</th>
                 <th class="text-center" style='width:50%;font-weight:bold'></th>
               </tr>
            </table>



         </div>
      </div>
  </div>
</div>
</section>
@stop