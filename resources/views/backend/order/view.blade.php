@extends('backend.layouts.layout')
@section('content')

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header"> المبيعات الآجل</h3>


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
                      <?php $total += $row->price*$row->qty; ?>
                  @endforeach

                </tbody>
               </table>

            
            <div class="row col-md-4 form-group">
               <button class="btn btn-success"><i class="fa fa-dollar"></i> إجمالي المشتريات</button>
               <br/><br/><a href="{{ url('sales/order/invoice/'.$getid) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> الفاتورة</a>
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
                <button id="search_btn" class="btn btn-primary" disabled><i class="fa fa-search"></i></button>
              </span>
            </div>
        
        </div>
 
      </div>
     </div>
   </div>










   <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">بيانات المشتري</h3>
            </div>
      
      <div class="panel-body">

        <div class="col-md-12">
           <div class="col-md-3 form-group">
              <label>الأسم</label>
              <input type="text" class="form-control" readonly value="{{$rows->name}}">
           </div>

           <div class="col-md-3 form-group">
              <label>رقم البطاقة</label>
              <input type="text" class="form-control"  readonly value="{{$rows->national_id}}">
           </div>

           <div class="col-md-3 form-group">
              <label>رقم الهاتف</label>
              <input type="number" class="form-control" readonly value="{{$rows->phone}}">
           </div>

           <div class="col-md-3 form-group">
              <label>العنوان</label>
              <input type="text" class="form-control" readonly value="{{$rows->address}}">
           </div>
        </div>  

        <div class="col-md-12" style="margin-top:20px;">

           <div class="col-md-3 form-group">
              <label>الإجمالي</label>
              <input type="text" step="any" id="totals" class="form-control" value="{{$rows->total}}" name="total" required>
           </div>

           <div class="col-md-3 form-group">
              <label>المدفوع</label>
              <input type="text" step="any" id="paid" readonly value="{{$rows->paid}}" class="form-control">
           </div>

           <div class="col-md-3 form-group">
              <label>المبلغ المتبقي</label>
              <input type="text" step="any" readonly class="form-control" value="{{$rows->remain}}">
           </div>

           <div class="col-md-3 form-group">
              <label>تاريخ سداد المبلغ المتبقي</label>
              <input type="date" class="form-control" readonly value="{{$rows->remain_date}}">
           </div>

           <div class="col-md-12 form-group">
              <label>ملاحظات مع الفاتورة</label>
              <textarea name="comment" rows="5" readonly class="form-control">{{$rows->comment}}</textarea>
           </div>

        </div>  

        <div class="col-md-12" style="margin-top:60px;">
          <a href="{{ url('sales/order/published') }}" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
        </div>

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
          <button class="btn btn-warning btn-block" @if($rows->remain <= 0 ) disabled @endif><i class="fa fa-check-circle"></i> تم دفع المبلغ المتبقي</button>
        </div>
    </div>

     </div>
   </div>

  </div>
</div>
</section>
@stop

