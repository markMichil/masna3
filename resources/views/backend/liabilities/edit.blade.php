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
                  <h3 class="panel-title">تعديل المطلوبات</h3>
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
            <input type="date" value="{{$row->date}}" class="form-control" name="date" required>
      </div>

       <div class="col-md-2 form-group">
            <label>الأسم</label>
            <input type="text" class="form-control" name="name" value="{{$row->name}}" required>
       </div>

       <div class="col-md-8 form-group">
            <label>السبب</label>
            <input type="text" class="form-control" name="reason" value="{{$row->reason}}" required>
       </div>
       
       <div class="col-md-8 form-group">
           <button class="btn btn-primary"><i class="fa fa-edit"></i> تعديل</button>
           <a href="{{ url('liabilities') }}" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
       </div>
    {!! Form::Close() !!}
       
         </div>
      </div>






  </div>
</div>
</section>
@stop