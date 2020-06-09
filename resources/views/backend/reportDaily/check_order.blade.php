@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تعديل المبيعات الآجل</h3>


@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  








   <div class="col-md-4">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">بحث عن المنتجات</h3>
            </div>
      <div class="panel-body">

        <div class="col-md-12">

            <div class="input-group">
               <input type="text" class="form-control"  placeholder="أدخل كود المنتج" name="pro_code" id="pro_code">
              <span class="input-group-btn">
                <button id="search_btn" disabled=""  class="btn btn-primary" ><i class="fa fa-search"></i></button>
              </span>
            </div>

            


        </div>
 
      </div>
     </div>
   </div>










   <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">دفع المبلغ آجل</h3>
            </div>
      
      <div class="panel-body">

      {!! Form::Open() !!}

        <div class="col-md-12">
           <div class="col-md-3 form-group">
              <label>الأسم</label>
              <input type="text" readonly style="background:#ddd;" class="form-control" value="{{$rows->name}}" name="name" required>
           </div>

           <div class="col-md-3 form-group">
              <label>رقم البطاقة</label>
              <input type="text" readonly style="background:#ddd;" class="form-control" value="{{$rows->national_id}}" name="national_id">
           </div>

           <div class="col-md-3 form-group">
              <label>رقم الهاتف</label>
              <input type="number" readonly style="background:#ddd;" class="form-control" value="{{$rows->phone}}" name="phone">
           </div>

           <div class="col-md-3 form-group">
              <label>العنوان</label>
              <input type="text" readonly style="background:#ddd;" class="form-control" value="{{$rows->address}}" name="address">
           </div>
        </div>  

        <div class="col-md-12" style="margin-top:20px;">
           <div class="col-md-3 col-md-offset-2 form-group">
              <label>المبلغ المدفوع</label>
              <input type="text" id="paid" style="background:#ddd;" readonly onkeyup="calc_remain();" value="{{$rows->paid}}" class="form-control" name="paid" required>
           </div>

           <div class="col-md-3 form-group">
              <label>المبلغ المتبقي</label>
              <input type="text" id="remain" style="background:#ddd;" readonly class="form-control" value="{{$rows->remain}}" name="remain" required>
           </div>

           <div class="col-md-3 form-group">
              <label>تاريخ سداد المبلغ المتبقي</label>
              <input type="date" readonly style="background:#ddd;" class="form-control" value="{{$rows->remain_date}}" name="remain_date" required>
           </div>
        </div>  

    

    {!! Form::Close() !!}
    </div>

     </div>
   </div>




   <div class="col-md-12" style="margin-bottom:50px;">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">دفع المبلغ المتبقي</h3>
            </div>
      
      <div class="panel-body">

        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;margin-bottom:20px;">
          <button class="btn btn-warning btn-block" disabled="" type="button" @if($rows->remain <= 0 ) disabled @endif><i class="fa fa-question-circle"></i> دفع المبلغ المتبقي</button>
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

function calc_remain(){
   var total = $("#just_amount").text();
   var paid = $("#paid").val();
   var remain = total-paid;
   $("#remain").val(remain);
}

$("#calc_total").on('click',function(){
  var Url = '{{ url("sales/cash/calc/total") }}';

  $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

$.ajax({
        url : Url,
        type : "POST",
        dataType : "json",
        success : function(data){
            if(data.state == true){
                 $("#total_amount").css({"display":"block"});
                 $("#total_amount").text(data.total+' جنيه');
                 $("#just_amount").text(data.total);
            }
        }
    });
    return false;
    
  });






$('#search_btn').on('click', function(){
   var Url = '{{ url("sales/cash/search") }}';
   var val = $("#pro_code").val();

   $("#total_amount").css({"display":"none"});

   if(!val) 
   {
      $("#pro_code").css({"border":"1px solid red"});

   } else {
    $("#pro_code").css({"border":"1px solid #ccc"});
    $("#search_loading").css({"display":"block"});
    $("#search_result").css({"display":"none"});
    $("#search_error").css({"display":"none"});
   
  $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

   $.ajax({
        url : Url,
        type : "POST",
        data : {val,val},
        dataType : "json",
        success : function(data){
          $("#search_loading").css({"display":"none"});
            if(data.state == true){
                 $("#search_result").css({"display":"block"});
                 $("#search_error").css({"display":"none"});
                 $("#search_procode").val(data.procode);
                 $("#search_img").attr("src", data.image);
                 $("#search_proname").text(data.proname)
                 $("#search_price").text(data.price);
                 $("#search_pprice").val(data.price);
                 $("#search_qty").text(data.qty);
            } else {
                 $("#search_result").css({"display":"none"});
                 $("#search_error").css({"display":"block"});
                 $("#search_error").text("لا يوجد منتجات");
          }
        }
    });
    return false;
    }
  });

</script>



@foreach($data as $jscode)
   @foreach(App\Product::where('pro_code',$jscode->pro_code)->get() as $jsfun)
<script>
$(document).ready(function(){
   var unit_price = $("#unit_price_{{$jsfun->id}}").text();
   var qty = $("#qty_{{$jsfun->id}}").val();
  $("#total_price_{{$jsfun->id}}").text(unit_price*qty); 
});

function submit_qty_{{$jsfun->id}}(id){
  $("#total_amount").css({"display":"none"});
  var unit_price = $("#unit_price_{{$jsfun->id}}").text();
  var qty = $("#qty_{{$jsfun->id}}").val();
  $("#total_price_{{$jsfun->id}}").text(unit_price*qty);
  
  var value = $("#qty_{{$jsfun->id}}").val();
  var Url = "{{ url('sales/cash/update/qty/') }}/"+id+'/'+value+'';
  
  $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
        url : Url,
        type : "GET",
        dataType : "json",
        success : function(data){
        }
    }); 
return false;
};

</script>
   @endforeach
@endforeach


@stop