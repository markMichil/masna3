@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الصفحة الشخصية</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">تعديل كلمة المرور</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

      {!! Form::Open() !!}

        <div class="col-md-6">

           <div class="form-group">
              
           <div class="form-group">
              <label>كلمة المرور الجديدة</label>
              <input type="password" class="form-control" name="password" required>
           </div>

           <div class="form-group">
              <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ</button>
              <a href="{{ url('profile') }}" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
           </div>



        </div>   
        
    {!! Form::Close() !!}
    </div>

      </div>
  </div>
</div>
</section>
@stop
