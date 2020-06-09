@extends('backend.layouts.layout')
@section('content')


@if(Auth::check())
<section id="min-wrapper">
@else
<section id="min-wrapper" class="active">
@endif

  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تفاصيل المنتج</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">{{$row->pro_code}}</h3>
                 </div>

    <div class="panel-body">



        <div class="col-md-7">
              <h1>{{$row->slug}}</h1>
          <br/>
              <h3>السعر {{ $row->price }} <span style='font-size:14px'>جنيه</span></h3>
              @foreach(App\Category::where('id',$row->cat_id)->get() as $sub) @endforeach
          <br/>
              <h4><label class="label label-success">الكمية {{$row->qty}}</label></h4>
           <br/>
              <div class="form-group">
                <p><hr><br/>{{$row->content}}</p>
              </div>
        </div>   
        
        <div class="col-md-5">
            <img src="{{url($row->image)}}" style="width:100%;height:400px;border:1px solid #ddd;margin-bottom:5px;">
        </div>
 
    </div>

      </div>
  </div>
</div>
</section>
@stop
