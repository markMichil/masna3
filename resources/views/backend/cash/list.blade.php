@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">المبيعات النقدي</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">جميع المبيعات النقدي ( {{count($data)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

          <a href="{{ url('sales/cash/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> أضف مبيعات نقدية جديدة</a><br/><br/>

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الاسم</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>إجمالي الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             
                  @foreach($data as $key => $row)
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                          <td class='text-center'>{{$row->id}}</td>
                          <td class='text-center'>{{$row->name}}</td>
                          <td class='text-center'>
                            <?php $total = 0;
                                foreach(json_decode($row->cash_id) as $cashy){
                                       $prices = App\Cash_other::where('id',$cashy)->pluck('price');
                                       $qtys = App\Cash_other::where('id',$cashy)->pluck('qty');
                                       $total += $prices*$qtys;
                                }
                            ?>
                            {{number_format($total,2)}} جنيه
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