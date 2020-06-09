@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الزبائن</h3>

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  

<form  action="{{url('customer/edit/') }}" method="post">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" name="id" value="{{$customer->id}}">
   <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">تعديل الزبون {{$customer->name}}</h3>
            </div>
      <div class="panel-body">



{{----}}
           

          <div class="col-md-12"></div>
          <div class="col-md-4 col-md-offset-2 form-group">
              <label>الاسم</label>
              <input id="paid" type="name"  style="padding:1px;padding-right:10px;"  class="form-control" name="name" value="{{$customer->name}}">
          </div>

          <div class="col-md-4 col-md-offset-2 form-group">
              <label>التلفون</label>
              <input id="paid" type="name"  style="padding:1px;padding-right:10px;"  class="form-control" name="phone" value="{{$customer->phone}}">
          </div>

          <div class="col-md-4 col-md-offset-2 form-group">
              <label>العنوان</label>
              <input id="paid" type="name" style="padding:1px;padding-right:10px;"  class="form-control" name="address" value="{{$customer->address}}">
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

$("#total").on('keyup',function(){
  var total = $("#total").val();
  var paid = $("#paid").val();
  var remain = total-paid;
  $("#remain").val(remain);
})

document.querySelector('.submit').addEventListener("click", function(){
    window.btn_clicked = true;
});

window.onbeforeunload = function(){
    if(!window.btn_clicked){
        return "Seems Like you wanna leave ?";
    }
};

$('body').on('click', '.remove_inst', function () {
    var didConfirm = confirm("Are you sure you want to delete");
      if (didConfirm == true) {
        $(this).parent().parent().remove();
        return true;
      } else {
          return false;
      }  
});




</script>

@stop