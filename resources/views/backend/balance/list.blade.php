@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الرصيد</h3>
      

      <div class="panel panel-default">
             <div class="panel-heading">
                  <h3 class="panel-title">أضف رصيد جديد</h3>
             </div>

      <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

     {!! Form::Open() !!}
      <div class="col-md-2 form-group">
            <label>التاريخ</label>
            <input type="date" value="{{date('Y-m-d')}}" class="form-control" name="date" required>
      </div>

      <div class="col-md-2 form-group">
            <label>النوع</label>
            <select style="padding:1px;padding-right:10px;" class="form-control" name="type">
                <option value="0">داخل</option>
                <option value="1">خارج</option>
            </select>
      </div>

      <div class="col-md-2 form-group">
            <label>المبلغ</label>
            <input type="number" step="any" style="padding:1px;padding-right:10px;" class="form-control" name="amount" required>
      </div>

      <div class="col-md-6 form-group">
            <label>السبب</label>
            <input type="text" class="form-control" name="reason" required>
      </div>
       
      <div class="col-md-8 form-group">
           <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> أضف</button>
      </div>
    {!! Form::Close() !!}
       
         </div>
      </div>



      <div class="panel panel-default">
             <div class="panel-heading">
                  <h3 class="panel-title">جميع الأرصدة ( {{count($data)}} )</h3>
             </div>

      <div class="panel-body">

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
            <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المبلغ</th>
                     <th class="text-center" style='width:50%;font-weight:bold'>السبب</th>
                     <th class="text-center" style='width:20%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             <?php $in = App\Balance::where('type',0)->sum('amount'); $out = App\Balance::where('type',1)->sum('amount'); $total = $in-$out; ?>
                @foreach($data as $key => $row)
                    @if($row->type == 1)
                        <tr style="background:#ffe0e0">
                    @else
                        <tr>
                    @endif
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{$row->date}}</td>
                          <td class='text-center'>{{$row->amount}}</td>
                          <td class='text-center'>{{$row->reason}}</td>
                          <td class='text-center'>
                             {!! Form::Open(['url'=>'balance/del/'.$row->id]) !!}
                                 <a href="{{ url('balance/edit/'.$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                 <button class="btn btn-danger confirmClickAction"><i class="fa fa-trash"></i> حذف</button>
                              {!! Form::Close() !!}
                          </td>                       
                      </tr>
                  @endforeach

                </tbody>
               </table>
            </div>

            <div class="col-md-12"><br/><br/><br/></div>
            <table class="table">
               <tr>
                 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;'>إجمالي الرصيد</th>
                 <th class="text-center"  style='width:20%;font-weight:bold;font-size:16px;@if($total < 0 )   color:red; @endif '> {{number_format($total,2)}} جنيه</th>
                 <th class="text-center" style='width:50%;font-weight:bold'></th>
               </tr>
            </table>

      </div>

      </div>


  </div>
</div>
</section>
@stop

