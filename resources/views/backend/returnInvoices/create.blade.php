@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
                <h3 class="ls-top-header">الفواتير</h3>
                     <div class="panel panel-danger">
                         <div class="panel-heading">أضف فاتورة مرتجع جديدة</div>
                           <div class="panel-body">

                                @if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                        <?php $disableAction = 0; ?>

                                    <form role="form" action="{{route('returnInvoices.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="col-md-12">
            <div class="col-md-12">
                <label>أختر صاحب المصنع</label>
                    <select class="form-control" name="factories_id" required>
                       @if(count($factories)>0)
                           @foreach($factories as $factory)
                       <option value="{{$factory->id}}">{{$factory->name}}</option>

                           @endforeach
                           @else
                        <option disabled="disabled">يجب إدخال صاحب المصنع اولا</option>
                        @endif
                    </select>


                </div>

            <div class="col-md-12"><hr></div>

           <div class="col-md-3 form-group">
              <label>كود العباية*</label>
              <input type="text" class="form-control"  name="code" required>
           </div>

           <div class="col-md-3 form-group">
              <label>السعر*</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="price" required>
           </div>

           <div class="col-md-3 form-group">
              <label>السعر بعد الخصم</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="price_d" >
           </div>

           <div class="col-md-3 form-group">
              <label> الكمية*</label>
              <input type="number" step="any" min="0" style='padding:1px;padding-right:10px;' class="form-control" name="quantity" required>
           </div>

            <div class="append"></div>

            <div class="col-md-12">
                <br/><button type="button" id="add_more" class="button btn btn-success"><i class="fa fa-plus-circle"></i> أضف منتج آخر</button><br/>
            </div>

        </div>   

      
        <div class="col-md-12"><br/></div>
        

        <div class="col-md-6">
          
        </div>

        <div class="col-md-12" style="margin-top:80px;">
           <div class="form-group">
              <button class="btn btn-primary submit"><i class="fa fa-check-circle"></i> حفظ</button>
              <a href="{{ url('returnInvoices') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
           </div>
        </div>
 
    </form>
                            </div>

                     </div>


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
     $(".append").append("<div>" +
         "<div class='col-md-12'>" +
         "<br/><hr><br/></div>" +
         "<div class='col-md-3 form-group'><label>كودالعباية * </label>" +
         "<input type='text' class='form-control' name='code[]'>" +
         "</div>" +
         "<div class='col-md-3 form-group'><label>السعر*</label>" +
         "<input type='number' step='any' min='0' style='padding:1px;padding-right:10px;' class='form-control' name='price[]'>" +
         "</div>" +
         "<div class='col-md-3 form-group'><label>السعر بعد الخصم*</label><input type='number' step='any' min='0' style='padding:1px;padding-right:10px;' class='form-control' name='price_d[]'></div><div class='col-md-3 form-group'><label>الكمية</label><input type='number' step='any' class='form-control' min='0' style='padding:1px;padding-right:10px;' name='quantity[]'></div><div class='col-md-3 form-group'><div class='col-md-12'><button class='btn btn-danger button remove_attr pull-right'><i class='fa fa-trash'></i> حذف المنتج</button></div></div>");
  });
});

$("#inv_paid").change(function(){
  var total = $("#inv_total").val();
  var paid = $("#inv_paid").val();
  var remain = total-paid;
  $("#inv_remain").val(remain);
})
</script>

@stop
