@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header" style="color: red">  فاتورة مرتجع  المصنع</h3>

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

  
   <div class="col-md-8">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">العبايات</h3>
            </div>
      <div class="panel-body">

        <div class="col-md-12">
          <div class="ls-editable-table table-responsive ls-table">
              <table class="table table-bordered  table-bottomless">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                        <th class="text-center" style='width:10%;font-weight:bold'> المصنع </th>
                     <th class="text-center" style='width:10%;font-weight:bold'>كود المنتج</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>السعر</th>
                     <th class="text-center" style='width:10%;font-weight:bold'> بعد الخصم </th>

                     <th class="text-center" style='width:10%;font-weight:bold'>الكمية</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الإجمالي</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>حذف</th>
                    </tr>
               </thead>
               <tbody>
               <?php $i = 0 ?>
                  @foreach($data as $key)

                      <tr>
                          <td class='text-center'>{{++$i}}</td>
                          <td class='text-center'>{{$key['factory']->name}}</td>
                          <td class='text-center'>{{$key['product']->code}}</td>
                          <td class='text-center' id="unit_price_{{$key->id}}">{{$key->price}}</td>
                          <td class='text-center' id="unit_price_d_{{$key->id}}">{{($key->price_d >0 )?$key->price_d:'لأا يوج خصم'}}</td>

                          <td class='text-center'>
                            <input type="number" step="any" min="0" onchange="submit_qty_{{$key->id}}({{$key->id}});" id="qty_{{$key->id}}" style="width:80px;padding:3px;" max="{{$key['product']->quantity}}" value="{{$key->quantity}}">
                            <p style='color:red;font-size:11px;'>الكمية المتاحة {{$key['product']->quantity}} فقط</p>
                          </td>
                          @if($key->price_d != null && $key->price_d > 0)
                              <td class="text-center" id="total_price_d{{$key->id}}">{{$key->price_d*$key->quantity}}</td>
                              @else
                              <td class="text-center" id="total_price{{$key->id}}">{{$key->price*$key->quantity}}</td>
                              @endif

                          <td class='text-center'>
                              {!! Form::Open(['url'=>'sales/cash/remove-cart/'.$key->id]) !!}
                                 <button class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button>
                              {!! Form::Close() !!}
                          </td>
                      </tr>
                  @endforeach
                </tbody>
               </table>


            <div class="row col-md-6 form-group">
               <button id="calc_total" class="btn btn-danger" type="button"><i class="fa fa-money"></i> أحسب إجمالي  المرتجع</button>
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
                <select id="factory" name="factory">
                    @if(count($factories)>0)
                    <option disabled selected > أختر المصنع لعرض العبايات</option>
                        @foreach($factories as $factory)
                        <option value="{{$factory->id}}">{{$factory->name}}</option>
                        @endforeach
                    @else
                        <option disabled selected >يجب إدخال مصنع ومنتج</option>
                    @endif
                </select>
                <br>
                <br>
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
                    <p> الخصم  <span  id="search_price_d"></span> <span style='font-size:11px;'>جنيه</span></p>
                    <p><label class="label label-success"> الكمية <span id="search_qty"></span></label><input id="just_qty" readonly type='hidden' name='sub_qty'></p>
                  {!! Form::Open(['url'=>'returnInvoices/add_to_cart']) !!}
                     <input type='hidden' name='product_id' id="search_procode">

                    <p><button class="btn btn-danger"><i class="fa fa-plus-circle"></i> أضف الي  المرتجع</button></p>
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
  var Url = '{{ url("returnInvoices/calc-total-cart") }}';

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
   var Url = '{{ url("returnInvoices/search-pro") }}';
   var val = $("#pro_code").val();
   var fac = $("#factory").val();

   $("#total_amount").css({"display":"none"});

   if(!fac){
       $("#factory").css({"border":"1px solid red"});
   }
   else if(!val)
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
        type : "GET",
        data : {val:val,fac:fac},
        // data : {[''=> val,'fac' => fac]},
        dataType : "json",
        success : function(data){
          $("#search_loading").css({"display":"none"});
            if(data.state == true){
                 $("#search_result").css({"display":"block"});
                 $("#search_error").css({"display":"none"});
                 // $("#search_procode").val(data.procode);
                 $("#search_procode").val(data.id);
                 $("#search_img").attr("src", data.image);
                 $("#search_proname").text(data.proname)
                 $("#search_price").text(data.price);
                 $("#search_pprice").val(data.price);
                 $("#search_price_d").text((data.price_d)?data.price_d:'لا يوجد خصم');
                 $("#search_pprice_d").val((data.price_d)?data.price_d:'لا يوجد خصم');
                 $("#search_qty").text(data.qty);
                 $("#just_qty").val(data.qty);
            } else {
                 $("#search_result").css({"display":"none"});
                 $("#search_error").css({"display":"block"});
                 // $("#search_error").text("لا يوجد منتجات");
                $("#search_error").css({"border":"1px solid red"});
                 $("#search_error").text(data.msg);

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
{{--   @foreach(App\Product::where('id',$jscode->products_id)->get() as $jsfun)--}}
<script>
$(document).ready(function(){
   var unit_price = $("#unit_price_{{$jscode ->id}}").text();
   var qty = $("#qty_{{$jscode ->id}}").val();
  $("#total_price_{{$jscode->id}}").text(unit_price*qty);
});

function submit_qty_{{$jscode->id}}(id){
    {{--console.log({{$jscode->id}});--}}
  $("#total_amount").css({"display":"none"});
  var unit_price = $("#unit_price_{{$jscode->id}}").text();
  var unit_price_d = $("#unit_price_{{$jscode->id}}").text();
    // console.log(unit_price);
  var qty = $("#qty_{{$jscode->id}}").val();
    // console.log(qty);

  $("#total_price_{{$jscode->id}}").text(unit_price*qty);
    // console.log(unit_price*qty);
  var value = $("#qty_{{$jscode->id}}").val();
  var Url = "{{ url('returnInvoices/update-qty/') }}/"+id+'/'+value+'';

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
{{--   @endforeach--}}
@endforeach


@stop
