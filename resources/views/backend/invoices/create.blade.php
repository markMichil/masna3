@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">الفواتير</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">أضف فاتورة جديدة</div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

      <form>
        

        <div class="col-md-12">

           <div class="col-md-4 col-md-offset-2 form-group">
              <label>المصنع</label>
              <select type="text" class="form-control" name="name" id="factory" required>
        <option   disabled="" selected="selected"> اختر المصنع</option>              
                  @foreach($data as $factory)
        <option   value="{{$factory->id}}">{{$factory->name}}</option>              
                @endforeach
              </select>
           </div>

           <div class="col-md-4 form-group">
              <label>رقم الهاتف</label>
              <input type="text" class="form-control" name="phone" required>
           </div>

           <div class="col-md-12"><hr></div>

           <div class="col-md-2 form-group">
              <label>كود العباية</label>
              <input type="text" class="form-control   search"  name="pro_code" required>
              <ul id="" class="list-group  html_product"  name='product_id[]'>  </ul>
           </div>

           <div class="col-md-2 form-group">
              <label>السعر</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="price" required>
           </div>

           <div class="col-md-2 form-group">
              <label>الكمية</label>
              <input type="number" step="any" min="0" style='padding:1px;padding-right:10px;' class="form-control" name="qty" required>
           </div>

           <div class="col-md-6 form-group">
              <label>الوصف</label>
              <input type="text" class="form-control" name="content" required>
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
              <a href="{{ url('invoices') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
           </div>
        </div>
 
      </form>
  
    </div>

      </div>
  </div>
</div>
</section>
@stop


@section('jsCode')

<script>
    var split = 'invoices';

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
     $(".append").append("<div><div class='col-md-12'><br/><hr><br/></div><div class='col-md-2 form-group'><label>كود العباية</label><input type='text' class='form-control  search' name='pro_codes[]'><select  class='list-group  html_product'  name='product_id[]'>  </select></div><div class='col-md-2 form-group'><label>السعر</label><input type='number' step='any' min='0' style='padding:1px;padding-right:10px;' class='form-control' name='prices[]'></div><div class='col-md-2 form-group'><label>الكمية</label><input type='number' step='any' class='form-control' min='0' style='padding:1px;padding-right:10px;' name='qtys[]'></div><div class='col-md-6 form-group'><label>الوصف</label><input type='text' class='form-control' name='contents[]' required></div><div class='col-md-12'><button class='btn btn-danger button remove_attr pull-right'><i class='fa fa-trash'></i> حذف العباية</button></div></div>");
  });


var factory_id = 0
$("#factory").click(function(){
 factory_id =  $(this).val();
});

function getProduct(data = ''){



}


$('.search').each(function (){
 $(document).on('keyup','.search',function (){
// alert(factory_id);
var search = $(this).val();
var data = {'search':search,'factory_id':factory_id  };
// console.log(data);

$.ajax({
url:"{{url('invoices/create')}}",
type :'GET',
dataType:'json',
data:{data:data},
success:function(response){
 // console.log(response);

// $(document).on('change','.html_product',function (){
  $('.html_product').html(response.html_product);
// });
}

});

   // getProduct(data);

});
});
});

$("#inv_paid").change(function(){
  var total = $("#inv_total").val();
  var paid = $("#inv_paid").val();
  var remain = total-paid;
  $("#inv_remain").val(remain);
});



</script>

@stop