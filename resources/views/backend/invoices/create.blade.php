@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header" style="color: red">  فاتورة   المصنع</h3>

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
                     <th class="text-center" style='font-weight:bold'>#</th>
                        <th class="text-center" style='font-weight:bold'> المصنع </th>
                     <th class="text-center" style='font-weight:bold'>كود المنتج</th>
                     <th class="text-center" style='font-weight:bold'>السعر</th>
                     <th class="text-center" style='font-weight:bold'>الكمية</th>

                     <th class="text-center" style='font-weight:bold'> خصم ع المنتج </th>
                     <th class="text-center" style='font-weight:bold'>المباع</th>
                     <th class="text-center" style='font-weight:bold'>خصم علي المباع</th>

                     <th class="text-center" style='font-weight:bold'>الإجمالي</th>
                     <th class="text-center" style='font-weight:bold'>حذف</th>
                    </tr>
               </thead>
               <tbody>
               <?php $i = 0 ?>
               @if($data !='')
                  @foreach($data as $key)
                      <tr>
                          <td class='text-center'>{{++$i}}</td>
                          <td class='text-center'> <input type="hidden" class="factory_id" name="factory_id" value="{{$key['factory']->id ? $key['factory']->id : 0 }}"> {{$key['factory']->name}}</td>
                          <td class='text-center  code_product'>{{$key['product']->code}}</td>
                          <td class='text-center' id="unit_price_{{$key->id}}">{{$key->price}}</td>
  <td class='text-center'>
                            <input type="number" step="any" min="0" onchange="submit_qty_{{$key->id}} ({{$key->id}});" id="qty_{{$key->id}}" style="width:70px;padding:3px;" max="{{$key['product']->quantity}}" value="{{$key->quantity}}">
                            <p style='color:red;font-size:11px;'>الكمية المتاحة {{$key->quantity}} فقط</p>

                          </td>

                          <td class='text-center' id="unit_price_d_{{$key->id}}">
                            <input type="number" id="price_D_{{$key->id}}" name="price_D" min='0' max="{{$key->price}}" style="width:70px;padding:3px;" value="{{$key->price_D ?  $key->price_D : 0}}"> </td>
                          <td class='text-center' id="">{{$key->sell}}</td>
<td class='text-center' id="unit_price_d_{{$key->id}}"><input type="number" id="sell_{{$key->id}}" name="sell" min='0' max="{{$key['product']->price}}" style="width:70px;padding:3px;" value="0"> </td>

                        
                     


                              <td class="text-center" id="total_price_{{$key->id}}"></td>
                        

                          <td class='text-center'>
                              {!! Form::Open(['url'=>'invoices/remove-cart/'.$key->id]) !!}
                                 <button class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button>
                              {!! Form::Close() !!}
                          </td>
                      </tr>
                  @endforeach
                  @endif
                </tbody>
               </table>


            <div class="row col-md-6 form-group">
               <button id="calc_total" class="btn btn-danger" type="button"><i class="fa fa-money"></i> أحسب إجمالي  الفاتورة</button>
            </div>
            <div calss="col-md-6 form-group">
               <p style='font-size:18px;display:none;margin-top:25px;' id="total_amount">  </p>
               <input type="hidden"  id='total_invioce' name="total_invioce" value="">
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
              <span class="input-group-btn">img
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
                  {!! Form::Open(['url'=>'Invoices/add_to_cart']) !!}
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

      {!! Form::Open(['url'=>'invoices/create']) !!}

     
<input type="hidden" id="factories_id" class="factory_id" name="factory_id" value=""> 

        <div class="col-md-12" style="margin-top:20px;">

           <div class="col-md-4 form-group">
              <label>المدفوع</label>
              <input type="hidden" step="any" id="totalsH" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="total" required>
              <input type="number" step="any" id="totals" min="0"  style="padding:1px;padding-right:10px;" class="form-control"  required>
           </div>

           <div class="col-md-4 form-group">
              <label>الخصم</label>
              <input type="number" step="any" id="discount" min="0" style="padding:1px;padding-right:10px;" onkeyup="calc_remain();"  class="form-control" name="discount" required>
           </div>

           <div class="col-md-4 form-group">
              <label>الإجمالي بعد الخصم</label>
              <input type="number" id="after_dis" step="any" style="padding:1px;padding-right:10px;" class="form-control" name="total_after_dis" required>
           </div>



        </div>  

        <div class="col-md-12" style="margin-top:60px;">
          <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ الفاتورة ودفع المبلغ نقدي</button>
      <a href="{{ url('invoices') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
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
  var Url = '{{ url("invoices/calc-total-cart") }}';

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
                 $("#total_invioce").val(data.total);
                 $("#totals").val(data.total);
                 $("#totals").attr('disabled','disabled');
                 $("#totalsH").val(data.total);

//                 $("#totals").placeholder(data.total);
            }
        }
    });
    return false;
    
  });




  var    factory_id = $('.factory_id').val();
 if( factory_id === undefined  || factory_id === ''   ){

 } else{

$('#factory').val(factory_id);
$("#factory").attr('disabled','disabled');
   $('#factories_id').val(factory_id);

 }

$('#search_btn').on('click', function(){
// $(".code_product")

   var Url = '{{ url("Invoices/search-pro") }}';
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
// var factory_id = '';
//   factory_id = $('.factory_id').val();
//   // alert(factory_id);
//  if( factory_id === undefined ){
// // alert(factory_id);
// // $('#factory').val(factory_id);
// // $("#factory").attr('disabled','disabled');
//  } else{

// $('#factory').val(factory_id);
// // $("#factory").attr('disabled','disabled');
//  }

</script>



@foreach($data as $jscode)
{{--   @foreach(App\Product::where('id',$jscode->products_id)->get() as $jsfun)--}}
<script>
$(document).ready(function(){

   var sell =  $("#sell_{{$jscode->id}}").val();

   if(sell != 0 ){
       var unit_price_ = $("#unit_price_{{$jscode ->id}}").text();
            unit_price = unit_price_ - sell ;
// alert(unit_price);
            
   } else{

       var unit_price = $("#unit_price_{{$jscode ->id}}").text();
// alert(unit_price);
   }
   // alert(sell);

   var qty = $("#qty_{{$jscode ->id}}").val();
  $("#total_price_{{$jscode->id}}").text(unit_price*qty);
});

function submit_qty_{{$jscode->id}}(id){

  // console.log('havepriceD');

  // alert(id);
  $("#total_amount").css({"display":"none"});

if($("#price_D_{{$jscode->id}}").val() !=0 || $("#price_D_{{$jscode->id}}").val() != ''){

   var unit_price = $("#price_D_{{$jscode->id}}").val();

    var qty = $("#qty_{{$jscode->id}}").val();
    // alert(unit_price);
if(unit_price == 0){
  var _price = $("#unit_price_{{$jscode->id}}").text();

    var allTotal= _price*qty;

} else{
    var allTotal= unit_price*qty;

}
    $("#total_price_{{$jscode->id}}").text(allTotal);
} else{
  var unit_price = $("#unit_price_{{$jscode->id}}").text();
    var qty = $("#qty_{{$jscode->id}}").val();
    $("#total_price_{{$jscode->id}}").text(unit_price*qty);
}


    // @if($jscode['product']->price_D != null)


    // var unit_price = $("#price_D_{{$jscode->id}}").val();
    // // alert(unit_price);
    // var qty = $("#qty_{{$jscode->id}}").val();
    // $("#total_price_d_{{$jscode->id}}").text(unit_price*qty);
    // @else
    // var unit_price = $("#unit_price_{{$jscode->id}}").text();
    // var qty = $("#qty_{{$jscode->id}}").val();
    // $("#total_price_{{$jscode->id}}").text(unit_price*qty);
    //     @endif

// alert(1111);
  var value = $("#qty_{{$jscode->id}}").val();
  var Url = "{{ url('Invoices/update-qty/') }}/"+id+'/'+value+'';

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
            console.log(data);
        }
    });
// return false; 
}



$("#price_D_{{$jscode->id}}").change(function(){
var id = {{$jscode->id}};
// alert(id);
  var unit_price = $("#price_D_{{$jscode->id}}").val();

    var qty = $("#qty_{{$jscode->id}}").val();
    // alert(qty);
    // alert(unit_price);

    if(unit_price == 0){
  var _price = $("#unit_price_{{$jscode->id}}").text();

    var allTotal= _price*qty;

} else{
    var allTotal= unit_price*qty;

}

    $("#total_price_{{$jscode->id}}").text(allTotal);


  var value = qty; 

  // alert(value);
  var Url = "{{ url('Invoices/update_price_D/') }}/"+id+'/'+value+'/'+unit_price;
// alert(Url);
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
            console.log(data);
        }
    });
});

function submit_price_D_{{$jscode->id}}(id){





    // @if($jscode['product']->price_D != null)

    var unit_price = $("#price_D_{{$jscode->id}}").val();

    var qty = $("#qty_{{$jscode->id}}").val();
    // alert(qty);
    $("#total_price_{{$jscode->id}}").text(unit_price*qty);
    // @else
    // var unit_price = $("#unit_price_{{$jscode->id}}").text();
    // var qty = $("#qty_{{$jscode->id}}").val();
    // $("#total_price_{{$jscode->id}}").text(unit_price*qty);
    //     @endif

// alert(1111);
  var value = $("#price_D_{{$jscode->id}}").val();
  // alert(value);
  var Url = "{{ url('Invoices/update_price_D/') }}/"+id+'/'+value+'';

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
            console.log(data);
        }
    });
return false;
}

</script>
{{--   @endforeach--}}
@endforeach


@stop
