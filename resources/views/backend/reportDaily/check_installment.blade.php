@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header"> المبيعات القسط</h3>


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
                    </tr>
               </thead>
               <tbody>
                  
                  <?php $total = 0; ?>
                  @foreach($data as $key => $row)
                   @foreach(App\Product::where('pro_code',$row->pro_code)->get() as $pro) @endforeach
                      <tr>
                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{$row->pro_code}}</td>
                          <td class='text-center' id="unit_price_{{$pro->id}}">{{$row->price}}</td>
                          <td class='text-center'>
                            <input type="number" readonly id="qty_{{$pro->id}}" style="width:80px;padding:3px;" max="{{$pro->qty}}" value="{{$row->qty}}">
                          </td>
                          <td class="text-center" id="total_price_{{$pro->id}}">{{$row->price*$row->qty}}</td>
                      </tr>
                       <?php $total += $pro->price*$pro->qty; ?>
                  @endforeach

                </tbody>
               </table>

            
            <div class="row col-md-4 form-group" >
               <button class="btn btn-success" type="button">إجمالي المشتريات</button>
            </div>
            <div calss="col-md-4 form-group">
               <p style='font-size:18px;margin-top:25px;'>{{number_format($total,2)}} جنيه</p>
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
               <input type="text" class="form-control" placeholder="أدخل كود المنتج" name="pro_code" id="pro_code">
              <span class="input-group-btn">
                <button disabled class="btn btn-primary" ><i class="fa fa-search"></i></button>
              </span>
            </div>

          


        </div>
 
      </div>
     </div>
   </div>










   <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">دفع المبلغ</h3>
            </div>
      
      <div class="panel-body">

      {!! Form::Open() !!}

        <div class="col-md-12">
           <div class="col-md-3 form-group">
              <label>الأسم</label>
              <input type="text" class="form-control" readonly style="background:#ddd;" value="{{$rows->name}}" name="name" required>
           </div>

           <div class="col-md-3 form-group">
              <label>رقم البطاقة</label>
              <input type="text" class="form-control" readonly style="background:#ddd;" value="{{$rows->national_id}}" name="national_id">
           </div>

           <div class="col-md-3 form-group">
              <label>رقم الهاتف</label>
              <input type="number" class="form-control" readonly style="background:#ddd;" value="{{$rows->phone}}" name="phone">
           </div>

           <div class="col-md-3 form-group">
              <label>العنوان</label>
              <input type="text" class="form-control" readonly style="background:#ddd;" value="{{$rows->address}}" name="address">
           </div>
        </div>  



        <div class="col-md-12" style="margin-top:20px;">
           <div class="col-md-3 col-md-offset-2 form-group">
              <label>المبلغ المدفوع</label>
              <input type="text" id="paid" readonly style="background:#ddd;" onkeyup="calc_remain();" value="{{$rows->paid}}" class="form-control" name="paid" required>
           </div>

           <div class="col-md-3 form-group">
              <label>المبلغ المتبقي</label>
              <input type="text" id="remain" readonly style="background:#ddd;" class="form-control" name="remain" value="{{$rows->remain}}" required>
           </div>

           <div class="col-md-3 form-group">
              <label>إجمالي مدة القسط</label>
              <input type="number" readonly style="background:#ddd;" class="form-control" name="count" value="{{$rows->count}}" required>
           </div>
        </div>  

        <div class="col-md-12" style="margin-top:20px;">
           <div class="col-md-2 form-group">
              <label>نوع القسط</label>
              <select id="count_type" readonly style="background:#ddd;padding:1px;" class="form-control" name="per_type">
                     <option value="1" @if($rows->each_type == 1) selected="selected" @endif>أيام</option>
                     <option value="2" @if($rows->each_type == 2) selected="selected" @endif>شهور</option>
              </select>
           </div>

           <div class="col-md-2 form-group">
              <label>مدة القسط</label>
              <select id="per_day" readonly  class="form-control" name="per_day" style="background:#ddd;padding:1px;">
                     <option value="1" @if($rows->each_inst == 1) selected="selected" @endif>1</option>
                     <option value="2" @if($rows->each_inst == 2) selected="selected" @endif>2</option>
                     <option value="3" @if($rows->each_inst == 3) selected="selected" @endif>3</option>
                     <option value="4" @if($rows->each_inst == 4) selected="selected" @endif>4</option>
                     <option value="5" @if($rows->each_inst == 5) selected="selected" @endif>5</option>
                     <option value="6" @if($rows->each_inst == 6) selected="selected" @endif>6</option>
                     <option value="7" @if($rows->each_inst == 7) selected="selected" @endif>7</option>
              </select>
              <select id="per_month" readonly class="form-control" name="per_month" style="display:none;background:#ddd;padding:1px;">
                     <option value="1" @if($rows->each_inst == 1) selected="selected" @endif>1</option>
                     <option value="2" @if($rows->each_inst == 2) selected="selected" @endif>2</option>
                     <option value="3" @if($rows->each_inst == 3) selected="selected" @endif>3</option>
                     <option value="4" @if($rows->each_inst == 4) selected="selected" @endif>4</option>
                     <option value="5" @if($rows->each_inst == 5) selected="selected" @endif>5</option>
                     <option value="6" @if($rows->each_inst == 6) selected="selected" @endif>6</option>
                     <option value="7" @if($rows->each_inst == 7) selected="selected" @endif>7</option>
                     <option value="8" @if($rows->each_inst == 8) selected="selected" @endif>8</option>
                     <option value="9" @if($rows->each_inst == 9) selected="selected" @endif>9</option>
                     <option value="10" @if($rows->each_inst == 10) selected="selected" @endif>10</option>
                     <option value="11" @if($rows->each_inst == 11) selected="selected" @endif>11</option>
                     <option value="12" @if($rows->each_inst == 12) selected="selected" @endif>12</option>
              </select>
           </div>

           <div class="col-md-2 form-group">
              <label>مبلغ القسط</label>
              <input type="number" readonly style="background:#ddd;" class="form-control" value="{{$rows->each_amount}}" name="inst_cost" required>
           </div>

           <div class="col-md-3 form-group">
              <label>تاريخ بدأ القسط</label>
              <input type="date" readonly style="background:#ddd;" class="form-control" value="{{$rows->start_date}}" name="start" required>
           </div>

           <div class="col-md-3 form-group">
              <label>تاريخ إنتهاء القسط</label>
              <input type="date" readonly style="background:#ddd;" class="form-control" value="{{$rows->end_date}}" name="end" required>
           </div>
        </div> 


    {!! Form::Close() !!}
    </div>

     </div>
   </div>
















@foreach(json_decode($rows->others_id) as $key => $otr)
@foreach(App\Installment_other::where('id',$otr)->get() as $other)@endforeach
   <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">مبلغ القسط ( {{$key+1}} )</h3>
            </div>
      
       <div class="panel-body">

          <div class="col-md-4 col-md-offset-2 form-group">
            <label>مبلغ القسط</label>
            <input type='number' class="form-control" @if($other->status == 1) style="background:#ddd;" @endif readonly value="{{$rows->each_amount}}">
          </div>

          <div class="col-md-4 form-group">
            <label>تاريخ القسط</label>
            <input type='date' class="form-control" @if($other->status == 1) style="background:#ddd;" @endif readonly value="{{$other->amount_date}}">
          </div>
      @if($other->status == 1)
          <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
             <button class="btn btn-success btn-block" disabled type="button"><i class="fa fa-check-circle"></i> تم دفع مبلغ القسط ( {{$key+1}} ) بنجاح  </button>
          </div>
      @else
          <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
             <button class="btn btn-warning btn-block" disabled><i class="fa fa-question-circle"></i>  دفع مبلغ القسط ( {{$key+1}} )</button>
          </div>
      @endif

       </div>

     </div>
   </div>
@endforeach


  <div class="col-md-12"><br/><br/><br/><br/></div>


  </div>
</div>
</section>
@stop


@section('jsCode')

<script>

$("#count_type").change(function(){
    var value = $("#count_type").val();
    if(value == 1) {
      $("#per_month").css({"display":"none"});
      $("#per_day").css({"display":"block"});
    } else {
       $("#per_day").css({"display":"none"});
       $("#per_month").css({"display":"block"});
    }

})

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
   var Url = '{{ url("sales/installment/search") }}';
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