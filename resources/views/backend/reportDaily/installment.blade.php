@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تقارير المبيعات القسط</h3>
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
                     <th class="text-center" style='width:10%;font-weight:bold'>تاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الأسم</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المدفوعات</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>مدة القسط</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>مبلغ القسط</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المتبقي</th>
                    </tr>
               </thead>
               <tbody>

              <?php $total = 0; $total_remain = 0;?>
             @if($data)
               @foreach($data as $key => $row)
                       <?php $dates = array(); ?>
                  @foreach(json_decode($row->others_id) as $oty)
                        @foreach(App\Installment_other::where('id',$oty)->where('status',0)->get() as $oshy )
                  <?php $dates[] = $oshy->amount_date; ?>
                        @endforeach
                  @endforeach

                  @if(!empty($dates[0]) && date('Y-m-d') >= $dates[0])
                  <tr style="background:#ffe0e0">
                  @else
                  <tr>
                  @endif

                      <td class="text-center">{{$key+1}}</td>
                      <td class='text-center'>{{$row->start_date}}</td>
                      <td class="text-center"><a href="{{ url('report/installment/check/'.$row->id) }}" style="color:#575757" target="_blank">{{$row->id}}</a></td>
                      <td class='text-center'>{{$row->name}}</td>
                      <td class='text-center'>{{$row->paid}}</td>
                      <td class='text-center'>{{$row->count}}
                           @if($row->each_type == 1)
                              @if($row->count == 1)
                                 {{ 'يوم' }}
                              @else
                                 {{ 'إيام' }}
                              @endif
                           @else
                              @if($row->count == 1)
                                  {{ 'شهر' }}
                               @else
                                   {{ 'شهور' }}
                               @endif
                           @endif
                      </td>
                      <td class='text-center'>{{$row->each_amount}}</td>
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
