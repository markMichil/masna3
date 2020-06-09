@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">العملاء</h3>

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  
  <form action="{{url('/addCustomer')}}"  method="post">
 
<input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">أضف زبون جديد</h3>
            </div>
      <div class="panel-body">

           <div class="col-md-4 row form-group">
             <label>الأسم</label>
             <input type="text" class="form-control" name="name">
           </div>
           <div class="col-md-4 form-group">
             <label>رقم الهاتف</label>
             <input type="number" class="form-control" min="0" style="padding:1px;padding-right:10px;"  name="phone">
           </div>
           <div class="col-md-4 form-group">
             <label>العنوان</label>
             <input type="text" class="form-control" name="address">
           </div>

           
           <div class="col-md-12"></div>
           <div class="col-md-12 row form-group">
             <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ</button>
             <a href="{{ url('customer') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
           </div>
      </div>
     </div>
   </div>
</form>


  </div>
</div>
</section>

@stop





@section('jsCode')

<script>

$("#paid").on('keyup',function(){
  var total = $("#total").val();
  var paid = $("#paid").val();
  var remain = total-paid;
  $("#remain").val(remain);
})

</script>

@stop