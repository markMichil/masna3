@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الزبائن </h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">جميع الزبائن ( {{count($allCustomers)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error') || Session::has('message'))
 <p class="alert alert-danger">{{Session::get('message')}}</p>
@endif

          <a href="{{ url('addCustomer') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> أضف زبون جديد</a><br/><br/>

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>أسم الزبون</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الهاتف</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>العنوان</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المدفوع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>المتبقي</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             
                  @foreach($allCustomers as $key => $row)
                      <tr>
                          <td class='text-center'>{{$row->id}}</td>
                          <td class='text-center'>{{$row->name}}</td>
                          <td class='text-center'>{{$row->phone}}</td>
                          <td class='text-center'>{{$row->address}}</td>
                          <td class='text-center'>{{$row->total}}</td>
                          <td class='text-center'>{{$row->paid}}</td>
                          <td class='text-center'>{{$row->remain}}</td>
                          <td class='text-center'>
                          	<form>
                                 <a href="{{ url('customer/edit/'.$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                 <a   href="{{ url('customer/delete/'.$row->id) }}" class="btn btn-danger confirmClickAction"><i class="fa fa-trash"></i> حذف</a>
                              </form>
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