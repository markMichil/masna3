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
                    <h3 class="panel-title">جميع الأقسام ( {{count($data)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

          <a href="{{ url('categories/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> أضف قسم جديد</a><br/><br/>

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>أسم القسم</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>النوع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             
                  @foreach($data as $key => $row)
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                          <td class='text-center'>{{$row->slug}}</td>
                          <td class='text-center'>
                            @if($row->parent == 0)
                              <span class="label label-danger">قسم رئيسية</span>
                            @else
								 @if(App\Category::where('id',$row->parent)->count() > 0 )
                              @foreach(App\Category::where('id',$row->parent)->get() as $sub) @endforeach
                              <span class="label label-default">قسم فرعي من {{$sub->slug}}</span>
							    @endif
                            @endif
                           </td>
                          <td class='text-center'>
                          	{!! Form::Open(['url'=>'categories/del/'.$row->id,'id'=>'Category_Destroy']) !!}
                                 <a href="{{ url('categories/edit/'.$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
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
