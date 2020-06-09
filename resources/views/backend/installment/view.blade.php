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
                          <td class='text-center'>{{$row->price}}</td>
                          <td class='text-center'>{{$row->qty}}</td>
                          <td class="text-center">{{$row->price*$row->qty}}</td>
                      </tr>
                       <?php $total+= $row->price*$row->qty; ?>
                  @endforeach

                </tbody>
               </table>

            
            <div class="row col-md-4 form-group">
               <button class="btn btn-success" type="button"><i class="fa fa-dollar"></i> إجمالي المشتريات</button>
               <br/><br/><a href="{{ url('sales/installment/invoice/'.$getid) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> الفاتورة</a>
            </div>
            <div calss="col-md-4 form-group">
               <p style='font-size:18px;margin-top:25px;' id="total_amount">{{number_format($total,2)}} جنيه</p>
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
                <button id="search_btn" disabled class="btn btn-primary" ><i class="fa fa-search"></i></button>
              </span>
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


        <div class="col-md-12">
           <div class="col-md-3 form-group">
              <label>الأسم</label>
              <input type="text" class="form-control" readonly value="{{$rows->name}}" name="name" required>
           </div>

           <div class="col-md-3 form-group">
              <label>رقم البطاقة</label>
              <input type="text" class="form-control" readonly value="{{$rows->national_id}}" name="national_id">
           </div>

           <div class="col-md-3 form-group">
              <label>رقم الهاتف</label>
              <input type="number" class="form-control" readonly value="{{$rows->phone}}" name="phone">
           </div>

           <div class="col-md-3 form-group">
              <label>العنوان</label>
              <input type="text" class="form-control" readonly value="{{$rows->address}}" name="address">
           </div>
        </div>  



        <div class="col-md-12" style="margin-top:20px;">

           <div class="col-md-3 form-group">
              <label>الإجمالي</label>
              <input type="number" step="any" id="total" min="0" readonly style="padding:1px;padding-right:10px;" class="form-control" name="total" value="{{$rows->total}}" required>
           </div>

           <div class="col-md-3 form-group">
              <label>المبلغ المدفوع</label>
              <input type="number" step="any" id="paid" min="0" readonly style="padding:1px;padding-right:10px;" onkeyup="calc_remain();" value="{{$rows->paid}}" class="form-control" name="paid" required>
           </div>

           <div class="col-md-3 form-group">
              <label>المبلغ المتبقي</label>
              <input type="number" step="any" id="remain" min="0" readonly style="padding:1px;padding-right:10px;" class="form-control" name="remain" value="{{$rows->remain}}" required>
           </div>

           <div class="col-md-3 form-group">
              <label>إجمالي مدة القسط</label>
              <input type="number" step="any" min="0" readonly style="padding:1px;padding-right:10px;" class="form-control" name="count" value="{{$rows->count}}" required>
           </div>
        </div>  

        <div class="col-md-12" style="margin-top:20px;">
           <div class="col-md-2 form-group">
              <label>نوع القسط</label>
              <select id="count_type" readonly  class="form-control" name="per_type" style="padding:1px;">
                     <option value="1" @if($rows->each_type == 1) selected="selected" @endif>أيام</option>
                     <option value="2" @if($rows->each_type == 2) selected="selected" @endif>شهور</option>
              </select>
           </div>

           <div class="col-md-2 form-group">
              <label>مدة القسط</label>
              <select id="per_day" readonly class="form-control" name="per_day" style="padding:1px;">
                     <option value="1" @if($rows->each_inst == 1) selected="selected" @endif>1</option>
                     <option value="2" @if($rows->each_inst == 2) selected="selected" @endif>2</option>
                     <option value="3" @if($rows->each_inst == 3) selected="selected" @endif>3</option>
                     <option value="4" @if($rows->each_inst == 4) selected="selected" @endif>4</option>
                     <option value="5" @if($rows->each_inst == 5) selected="selected" @endif>5</option>
                     <option value="6" @if($rows->each_inst == 6) selected="selected" @endif>6</option>
                     <option value="7" @if($rows->each_inst == 7) selected="selected" @endif>7</option>
              </select>
              <select id="per_month" readonly class="form-control" name="per_month" style="display:none;padding:1px;">
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
              <input type="number" step="any" readonly min="0" style="padding:1px;padding-right:10px;" class="form-control" value="{{$rows->each_amount}}" name="inst_cost" required>
           </div>

           <div class="col-md-3 form-group">
              <label>تاريخ بدأ القسط</label>
              <input type="date" readonly class="form-control" value="{{$rows->start_date}}" name="start" required>
           </div>

           <div class="col-md-3 form-group">
              <label>تاريخ إنتهاء القسط</label>
              <input type="date" readonly class="form-control" value="{{$rows->end_date}}" name="end" required>
           </div>

           <div class="col-md-12 form-group">
              <label>ملاحظات مع الفاتورة</label>
              <textarea name="comment" rows="5" readonly class="form-control">{{$rows->comment}}</textarea>
           </div>

        </div> 

        <div class="col-md-12" style="margin-top:30px;">
          <a href="{{ url('sales/installment/unpublished') }}" class="btn btn-danger"> رجوع <i class="fa fa-undo"></i></a>
        </div>

    </div>

     </div>
   </div>
















@foreach(json_decode($rows->others_id) as $key => $otr)
@foreach(App\Installment_other::where('id',$otr)->get() as $other)@endforeach
   <div class="col-md-12">
      <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title">مبلغ القسط ( {{$key+1}} ) </h3>
            </div>
      
       <div class="panel-body">
         {!! Form::Open(['url'=>'sales/installment/pay/'.$otr.'/'.$rows->id]) !!}
      
          <div class="col-md-4 col-md-offset-2 form-group">
            <label>مبلغ القسط</label>
            <input type='number' style="padding:1px;padding-right:10px;" class="form-control" readonly value="{{$rows->each_amount}}">
          </div>

          <div class="col-md-4 form-group">
            <label>تاريخ القسط</label>
            <input type='date' class="form-control" @if($other->status == 0 && date('Y-m-d') >= $other->amount_date)  style='background:#ffe0e0;' @endif readonly value="{{$other->amount_date}}">
          </div>
      @if($other->status == 1)
          <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
             <button class="btn btn-success btn-block" type="button"><i class="fa fa-check-circle"></i> تم دفع مبلغ القسط ( {{$key+1}} ) بنجاح  </button>
          </div>
      @else
          <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
             <button class="btn btn-warning btn-block"><i class="fa fa-question-circle"></i>  دفع مبلغ القسط ( {{$key+1}} )</button>
          </div>
      @endif

        {!! Form::Close() !!}
       </div>

     </div>
   </div>
@endforeach


  <div class="col-md-12"><br/><br/><br/><br/></div>


  </div>
</div>
</section>
@stop
