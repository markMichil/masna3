@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">{{$title}}</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"><span @if($res == 1) style="font-weight:bold"; @endif><a href="{{ url('sales/installment/published') }}" style="color:#575757"> مبيعات القسط</a> ( {{App\Installment::where('remain','>',0)->count()}} )  </span>&nbsp; | &nbsp;<span @if($res == 2) style="font-weight:bold"; @endif>  <a href="{{ url('sales/installment/unpublished') }}" style="color:#575757"> مبيعات القسط المنتهية </a>( {{App\Installment::where('remain',0)->count()}} )</span></h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

          <a href="{{ url('sales/installment/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> أضف مبيعات قسط جديدة</a><br/><br/>

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الأسم</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الإجمالي</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المدفوعات</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المتبقي</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>مدة القسط</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>مبلغ القسط</th>
                     <th class="text-center" style='width:15%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
                       
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
					 

                          <td class='text-center'>{{$key+1}} </td>
                          <td class='text-center'>{{$row->start_date}} </td>
                          <td class='text-center'>{{$row->id}}</td>
                          <td class='text-center'>{{$row->name}}</td>
                          <td class='text-center'>{{number_format($row->total,2)}}</td>
                          <td class='text-center'>{{number_format($row->paid,2)}}</td>
                          <td class='text-center'>{{number_format($row->remain,2)}}</td>
                          <td class='text-center'>{{$row->count}}
                           @if($row->each_type == 1) إيام
                           @else شهور
                           @endif</td>
                          <td class='text-center'>{{$row->each_amount}}</td>
                          <td class='text-center'>
                                @if($res == 1)
                                {!! Form::Open(['url'=>'sales/installment/del/unyet/'.$row->id]) !!}
                                   <a href="{{ url('sales/installment/edit/'.$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                 @else
                                   {!! Form::Open(['url'=>'sales/installment/del/'.$row->id]) !!}
                                   <a href="{{ url('sales/installment/view/'.$row->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> مشاهدة</a>
                                 @endif

                                 <button class="btn btn-danger confirmClickAction"><i class="fa fa-trash"></i> حذف</button>
                              {!! Form::Close() !!}
                          </td>                       
                      </tr>
                  @endforeach

                </tbody>
               </table>
            </div>



         </div>
      </div>
  </div>
</div>
</section>
@stop