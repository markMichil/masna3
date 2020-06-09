@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الفواتير</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">تعديل الفاتورة</div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

      {!! Form::Open() !!}

        <div class="col-md-12">

           <div class="col-md-4 col-md-offset-2 form-group">
              <label>الأسم</label>
              <input type="text" class="form-control" value="{{$row->name}}" name="name" required>
           </div>

           <div class="col-md-4 form-group">
              <label>رقم الهاتف</label> 
              <input type="text" class="form-control" value="{{$row->phone}}" name="phone" required>
           </div>

      <div class="col-md-12"><hr></div>

           <div class="col-md-2 form-group">
              <label>كود المنتج</label>
              <input type="text" class="form-control" readonly  name="pro_code" value="{{$row->pro_code}}" required>
           </div>

           <div class="col-md-2 form-group">
              <label>السعر</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" value="{{$row->price}}" name="price" required>
           </div>

           <div class="col-md-2 form-group">
              <label>الكمية</label>
              <input type="number" step="any" class="form-control" min='0' style='padding:1px;padding-right:10px;' name="qty" value="{{$row->qty}}" required>
           </div>

           <div class="col-md-6 form-group">
              <label>الوصف</label>
              <input type="text" class="form-control" name="content" required value="{{$row->content}}">
           </div>

        
        @foreach(App\Invoice_attribute::where('invoice_id',$getid)->get() as $attr)
           <div><div class='col-md-12'><br/><hr><br/></div><div class='col-md-2 form-group'><input type="hidden" name="ids[]" value="{{$attr->id}}"><label>كود المنتج</label><input type='text' class='form-control' name='pro_codes[]'  value="{{$attr->pro_code}}"></div><div class='col-md-2 form-group'><label>السعر</label><input type='number' step="any" min='0' style='padding:1px;padding-right:10px;' class='form-control' name='prices[]' value="{{$attr->price}}"></div><div class='col-md-2 form-group'><label>الكمية</label><input type='number' step="any" min='0' style='padding:1px;padding-right:10px;' class='form-control' name='qtys[]' value="{{$attr->qty}}"></div><div class='col-md-6 form-group'><label>الوصف</label><input type="text" class='form-control' name='contents[]' value="{{$attr->content}}"></div><div class="col-md-12"><a href="{{ url('invoices/del/sub/'.$attr->id) }}"  class="btn btn-danger  pull-right"><i class="fa fa-trash"></i> حذف المنتج</a></div></div>
        @endforeach

            <div class="append"></div>

            <div class="col-md-12" style="display:none;">
                <br/><button type="button" id="add_more" class="button btn btn-success"><i class="fa fa-plus-circle"></i> أضف منتج آخر</button><br/>
            </div>

        </div>   



      <div class="col-md-12"><br/><br/></div>
           <div class="col-md-4 col-md-offset-4 form-group">
              <label>الإجمالي</label>
              <input type="number" id="inv_total" style='padding:1px;padding-right:10px;' step="any" class="form-control" name="total" required value="{{$total}}" readonly>
           </div>
      <div class="col-md-12"></div>
           <div class="col-md-4 col-md-offset-2 form-group">
              <label>المدفوع</label>
              <input type="number" id="inv_paid" style='padding:1px;padding-right:10px;'  step="any" class="form-control" name="paid" required value="{{$row->paid}}">
              <input type="hidden" id="inv_re_paid"  step="any" class="form-control" name="re_paid" value="{{$row->paid}}">
           </div>
           <div class="col-md-4 form-group">
              <label>المتبقي</label>
              <input type="number" id="inv_remain" style='padding:1px;padding-right:10px;'  step="any" class="form-control" name="remain" required value="{{$row->remain}}">
              <input type="hidden" id="inv_re_remain"  step="any" class="form-control" value="{{$row->remain}}">
           </div>
      <div class="col-md-12"><br/></div>

        
        <div class="col-md-6">
          
        </div>

        <div class="col-md-12" style="margin-top:80px;">
           <div class="form-group">
              <button class="btn btn-primary submit"><i class="fa fa-edit"></i> تعديل</button>
              <a href="{{ url('invoices') }}" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
           </div>
        </div>
 
    {!! Form::Close() !!}
    </div>

      </div>
  </div>
</div>
</section>
@stop


@section('jsCode')

<script>

document.querySelector('.submit').addEventListener("click", function(){
    window.btn_clicked = true;
});

window.onbeforeunload = function(){
    if(!window.btn_clicked){
        return "Seems Like you wanna leave ?";
    }
};

$('body').on('click', '.remove_attr', function () {
    var didConfirm = confirm("Are you sure you want to delete");
      if (didConfirm == true) {
        $(this).parent().parent().remove();
        return true;
      } else {
          return false;
      }  
});

$(document).ready(function(){
  $("#add_more").click(function(){
     $(".append").append("<div><div class='col-md-12'><br/><hr><br/></div><div class='col-md-2 form-group'><label>كود المنتج</label><input type='text' class='form-control' name='pro_codes[]' required></div><div class='col-md-2 form-group'><label>السعر</label><input type='number' step='any' min='0' style='padding:1px;padding-right:10px;' class='form-control' name='prices[]' required></div><div class='col-md-2 form-group'><label>الكمية</label><input type='number' min='0' style='padding:1px;padding-right:10px;' class='form-control' name='qtys[]' required></div><div class='col-md-6 form-group'><label>الوصف</label><input type='text' class='form-control' name='contents[]' required></div><div class='col-md-12'><button class='btn btn-danger button remove_attr pull-right'><i class='fa fa-trash'></i> حذف المنتج</button></div></div>");
  });
});



$("#inv_paid").change(function(){
  var total = $("#inv_total").val();
  var remain = $("#inv_paid").val();
  var act_rem = total - remain;
  $("#inv_remain").val(act_rem);
})

</script>

@stop