@extends('backend.layouts.layout')
@section('content')

@if(Auth::check())
<section id="min-wrapper">
@else
<section id="min-wrapper" class="active">
@endif

  <div id="main-content">
    <div class="container-fluid">
    <h2>البحث <span style='font-size:13px;'>( {{count($data)}} )</span></h2>

      <div class="row"><br/>
         <div class="col-md-12">

{!! Form::Open(['url'=>'search','method'=>'GET']) !!}   
 <div class="form-group">
    <input type="text" class="form-control" name="s" value="{{Input::get('s')}}" placeholder="بحث عن المنتجات" style='width:40%;text-align:right;border-radius:0;float:right;margin-bottom:30px;'>
    <i class="fa fa-search" style='margin-right:-30px;font-size:20px;margin-top:5px;'></i>
 </div>
{!! Form::Close() !!}

     
<div class="col-md-12">
   @if(count($data) > 0 )
        @foreach($data as $row)
            <div class="col-md-3" style="height:380px;">
             <a href="{{ url('detail/'.preg_replace('/\s+/ ', '-',$row->slug).'/'.$row->id) }}" style="text-decoration:none">
         	  <img src="{{ url($row->image) }}" style="width:100%;height:300px;border:1px solid #ddd">
         	      <h5 style="color:#565656;">{{str_limit($row->slug,50)}}</h5>
         	      <p style="color:#565656;">{{$row->price}} جنيه</p>
         	   </a>
            </div>
        @endforeach
  @else
        <h2><center>لا يوجد منتجات</center></h2>
  @endif  
</div>


            
        
  </div>
 </div>
</section>


@stop