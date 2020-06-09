@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">المبيعات النقدي</h3>

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  
   <div class="col-md-8">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">المشتريات</h3>
            </div>
      <div class="panel-body">

        <div class="col-md-12">
          <div class="ls-editable-table table-responsive ls-table">
              <table class="table table-bordered  table-bottomless">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>كود المنتج</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>السعر</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الكمية</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الإجمالي</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>حذف</th>
                    </tr>
               </thead>
               <tbody>
                  @foreach($data as $key => $row)
                   @foreach(App\Product::where('pro_code',$row->pro_code)->get() as $pro) @endforeach
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{$row->pro_code}}</td>
                          <td class='text-center' id="unit_price_{{$pro->id}}">{{$row->price}}</td>
                          <td class='text-center'>
                            <input type="number" step="any" min="0" onchange="submit_qty_{{$pro->id}}({{$row->id}});" id="qty_{{$pro->id}}" style="width:80px;padding:3px;" max="{{$pro->qty}}" value="{{$row->qty}}">
                            <p style='color:red;font-size:11px;'>الكمية المتاحة {{$pro->qty}} فقط</p>
                          </td>
                          <td class="text-center" id="total_price_{{$pro->id}}">{{$row->price*$row->qty}}</td>
                          <td class='text-center'>
                              {!! Form::Open(['url'=>'sales/cash/remove-cart/'.$row->id]) !!}
                                 <button class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button>
                              {!! Form::Close() !!}
                          </td>    
                      </tr>
                  @endforeach
                </tbody>
               </table>

            
            <div class="row col-md-6 form-group">
               <button id="calc_total" class="btn btn-success" type="button"><i class="fa fa-dollar"></i> أحسب إجمالي المشتريات</button>
            </div>
            <div calss="col-md-6 form-group">
               <p style='font-size:18px;display:none;margin-top:25px;' id="total_amount"></p>
            </div>


            </div>

        </div>
 
      </div>
     </div>
   </div>







   <div class="col-md-4">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">بحث عن المنتجات</h3>
            </div>
      <div class="panel-body">

        <div class="col-md-12">

            <div class="input-group">
               <input type="text" style='text-transform:uppercase' class="form-control" placeholder="أدخل كود المنتج" name="pro_code" id="pro_code">
              <span class="input-group-btn">
                <button id="search_btn" class="btn btn-primary" ><i class="fa fa-search"></i></button>
              </span>
            </div>

            <br/><br/>
            <div id="search_loading" style='text-align:center;display:none;'><img src="{{ url('elixir/images/loading.gif') }}" style="width:30px;height:30px;"></div>
            <div id="search_error" style='text-align:center;display:none;'></div>
            <div id="search_result" class="form-group"  style="display:none;height:auto">
                <div class="col-md-12">
                     <img id="search_img" src="" style="width:100%;height:200px;border:1px solid #ddd">
                    <h5 id="search_proname"></h5>
                    <p>السعر <span  id="search_price"></span> <span style='font-size:11px;'>جنيه</span></p>
                    <p><label class="label label-success"> الكمية <span id="search_qty"></span></label><input id="just_qty" readonly type='hidden' name='sub_qty'></p>
                  {!! Form::Open(['url'=>'sales/cash/add-to-cart']) !!}  
                     <input type='hidden' name='procode' id="search_procode">
                     <input type='hidden' name='price' id="search_pprice">
                    <p><button class="btn btn-danger"><i class="fa fa-plus-circle"></i> أضف الي  المشتريات</button></p>
                  {!! Form::Close() !!}
                </div>
            </div>


        </div>
 
      </div>
     </div>
   </div>
   
   
   
   <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">بيانات الفاتورة</h3>
            </div>
      
      <div class="panel-body">

      {!! Form::Open() !!}

        <div class="col-md-12">
           <div class="col-md-4 col-md-offset-2 form-group">
              <label>الأسم</label>
              <input type="text" class="form-control" name="name" required>
           </div>

           <div class="col-md-4 form-group">
              <label>رقم الهاتف</label>
              <input type="number" class="form-control" name="phone">
           </div>


        </div>  



        <div class="col-md-12" style="margin-top:20px;">

           <div class="col-md-4 form-group">
              <label>الإجمالي</label>
              <input type="number" step="any" id="totals" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="total" required>
           </div>

           <div class="col-md-4 form-group">
              <label>الخصم</label>
              <input type="number" step="any" id="discount" min="0" style="padding:1px;padding-right:10px;" onkeyup="calc_remain();"  class="form-control" name="discount" required>
           </div>

           <div class="col-md-4 form-group">
              <label>الإجمالي بعد الخصم</label>
              <input type="number" id="after_dis" step="any" style="padding:1px;padding-right:10px;" class="form-control" name="total_after_dis" required>
           </div>


           <div class="col-md-12 form-group">
              <label>ملاحظات مع الفاتورة</label>
              <textarea name="note" rows="5" class="form-control"></textarea>
           </div>

        </div>  

        <div class="col-md-12" style="margin-top:60px;">
          <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ الفاتورة ودفع المبلغ نقدي</button>
		  <a href="{{ url('sales/cash') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
        </div>

    {!! Form::Close() !!}
    </div>

     </div>
   </div>




  </div>
</div>
</section>
@stop


@section('jsCode')

<script>

$("#calc_total").on('click',function(){
  var Url = '{{ url("sales/cash/calc-total-cart") }}';

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
//                 $("#totals").placeholder(data.total);
            }
        }
    });
    return false;
    
  });






$('#search_btn').on('click', function(){
   var Url = '{{ url("sales/cash/search-pro") }}';
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
                 $("#just_qty").val(data.qty);
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



function calc_remain(){
   var total = $("#totals").val();
   var dis = $("#discount").val();
   var after = total-dis;
   $("#after_dis").val(after);
}

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
  var Url = "{{ url('sales/cash/update-qty/') }}/"+id+'/'+value+'';
  
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