@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الأقسام</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">أضف قسم جديد</h3>
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
              <label>النوع</label>
              <select name="parent" class="form-control" style="padding:0;padding-right:5px;">
                      <option value="0">قسم رئيسي</option>
                 @foreach(App\Category::where('parent',0)->get() as $cat) 
                      <option value="{{$cat->id}}">قسم فرعي من {{$cat->slug}}</option>
                 @endforeach
              </select>
           </div> 


           <div class="form-group">
              <label>أسم القسم</label>
              <input type="text" class="form-control" name="slug" required>
           </div>



        </div>   
        
        <div class="col-md-6">
          
        </div>

        <div class="col-md-12">
           <div class="form-group">
              <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ</button>
              <a style="cursor:pointer" onclick="history.go(-1);" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
           </div>
        </div>
 
    {!! Form::Close() !!}
    </div>

      </div>
  </div>
</div>
</section>
@stop
