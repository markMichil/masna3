@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">المطلوبات</h3>
      

      <div class="panel panel-default">
             <div class="panel-heading">
                  <h3 class="panel-title">أضف مطلوب جديد</h3>
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
            <label>الأسم</label>
            <input type="text" class="form-control" name="name" required>
       </div>

       <div class="col-md-8 form-group">
            <label>المطلوب</label>
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
                  <h3 class="panel-title">جميع المطلوبات ( {{count($data)}} )</h3>
             </div>

      <div class="panel-body">

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
            <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الأسم</th>
                     <th class="text-center" style='width:50%;font-weight:bold'>المطلوب</th>
                     <th class="text-center" style='width:20%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             
                  @foreach($data as $key => $row)
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{$row->date}}</td>
                          <td class='text-center'>{{$row->name}}</td>
                          <td class='text-center'>{{$row->reason}}</td>
                          <td class='text-center'>
                          	{!! Form::Open(['url'=>'liabilities/del/'.$row->id]) !!}
                                 <a href="{{ url('liabilities/edit/'.$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
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

