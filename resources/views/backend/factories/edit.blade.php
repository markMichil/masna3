@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="factory_data">
          <div class="col-md-12">
          <h3 class="ls-top-header">المصانع</h3>

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  
<form  method="post" action="{{url('factories/edit')}}">   
  <input type="hidden" name="_token" value="{{ csrf_token()}}">

  <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">تعديل المصنع {{$factory_data->name}}</h3>
            </div>
      <div class="panel-body">


           <div class="col-md-4 col-md-offset-4 form-group">
             <label>اسم المصنع</label>
             <input type="hidden" name="id" value="{{$factory_data->id}}">
             <input id="total" type="text"  style="padding:1px;padding-right:10px;"  class="form-control" name="name" value="{{$factory_data->name}}">
           </div>
           <div class="col-md-12"></div>
           <div class="col-md-4 col-md-offset-2 form-group">
             <label>الهاتف</label>
             <input id="paid" type="number"  style="padding:1px;padding-right:10px;"  class="form-control" name="phone" value="{{$factory_data->phone}}">
           </div>
           <div class="col-md-4 form-group">
             <label>العنوان</label>
             <input id="remain" type="text" style="padding:1px;padding-right:10px;"  class="form-control" name="address" value="{{$factory_data->address}}">
           </div>
           <div class="col-md-12"></div>
           <div class="col-md-12 factory_data form-group">
             <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ</button>
             <a href="{{ url('factories') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
           </div>
      </div>
     </div>
   </div>

</form>


   




  </div>
</div>
</section>
