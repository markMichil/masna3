@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">فواتير المصانع المرتجع</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">جميع فواتير المصانع المرتجع ( {{count($data)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

          <a href="{{ url('returnInvoices/create') }}" class="btn btn-danger"><i class="fa fa-plus-circle"></i> أضف فاتورة مرتجع للمصنع</a><br/><br/>

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المصنع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>إجمالي الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المتبقى</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المدفوع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             
                  @foreach($data as $key => $row)
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                          <td class='text-center'>{{$row->id}}</td>
                          <td class='text-center'>{{$row['factory']->name}}</td>
                          <td class='text-center'>
                              {{$row->total_price}}
                             جنيه
                          </td>
                          <td class='text-center'>
                              {{$row->remains}}
                             جنيه
                          </td>
                          <td class='text-center'>
                              {{$row->paid}}
                             جنيه
                          </td>
                          <td class='text-center'>
                          	{!! Form::Open(['url'=>'sales/cash/del/'.$row->id]) !!}
                                 <a href="{{ url('sales/cash/edit/'.$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
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
