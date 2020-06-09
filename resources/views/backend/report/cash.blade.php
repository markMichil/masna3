@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تقارير المبيعات النقدي</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">نتيجة التقارير ( {{count($data)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

      <div class="col-md-12" style="margin-bottom:50px;">
       
      <?php
        $years = range(date('Y'), 2016);
      ?>

      {!! Form::Open(['method'=>'GET']) !!}

           <div class="col-md-2 col-md-offset-1">
                <label>من شهر</label>
               <select class="form-control" name="from_month" style="padding:1px;">
                  <option value="all" @if(Input::get('from_month') == 'all') selected="selected" @endif>الكل</option>
                  <option value="1" @if(Input::get('from_month') == 1) selected="selected" @endif>يناير</option>
                  <option value="2" @if(Input::get('from_month') == 2) selected="selected" @endif>فبراير</option>
                  <option value="3" @if(Input::get('from_month') == 3) selected="selected" @endif>مارس</option>
                  <option value="4" @if(Input::get('from_month') == 4) selected="selected" @endif>أبريل</option>
                  <option value="5" @if(Input::get('from_month') == 5) selected="selected" @endif>مايو</option>
                  <option value="6" @if(Input::get('from_month') == 6) selected="selected" @endif>يونيو</option>
                  <option value="7" @if(Input::get('from_month') == 7) selected="selected" @endif>يوليو</option>
                  <option value="8" @if(Input::get('from_month') == 8) selected="selected" @endif>أغسطس</option>
                  <option value="9" @if(Input::get('from_month') == 9) selected="selected" @endif>سبتمبر</option>
                  <option value="10" @if(Input::get('from_month') == 10) selected="selected" @endif>أكتوبر</option>
                  <option value="11" @if(Input::get('from_month') == 11) selected="selected" @endif>نوفمبر</option>
                  <option value="12" @if(Input::get('from_month') == 12) selected="selected" @endif>ديسمبر</option>
               </select>
           </div>
           <div class="col-md-2">
                <label>سنة</label>
               <select class="form-control" name="from_year" style="padding:1px;">
                  @foreach($years as $year)
                   <option value="{{$year}}" @if(Input::get('from_year') == $year) selected="selected" @endif>{{$year}}</option>
                  @endforeach
               </select>
           </div>

          <div class="col-md-1"><center style='margin-top:30px;'><i class="fa fa-arrow-circle-left"></i></center></div>
           
           <div class="col-md-2">
                <label>إلي شهر</label>
               <select class="form-control" name="to_month" style="padding:1px;">
                  <option value="all" @if(Input::get('to_month') == 'all') selected="selected" @endif>الكل</option>
                  <option value="1" @if(Input::get('to_month') == 1) selected="selected" @endif>يناير</option>
                  <option value="2" @if(Input::get('to_month') == 2) selected="selected" @endif>فبراير</option>
                  <option value="3" @if(Input::get('to_month') == 3) selected="selected" @endif>مارس</option>
                  <option value="4" @if(Input::get('to_month') == 4) selected="selected" @endif>أبريل</option>
                  <option value="5" @if(Input::get('to_month') == 5) selected="selected" @endif>مايو</option>
                  <option value="6" @if(Input::get('to_month') == 6) selected="selected" @endif>يونيو</option>
                  <option value="7" @if(Input::get('to_month') == 7) selected="selected" @endif>يوليو</option>
                  <option value="8" @if(Input::get('to_month') == 8) selected="selected" @endif>أغسطس</option>
                  <option value="9" @if(Input::get('to_month') == 9) selected="selected" @endif>سبتمبر</option>
                  <option value="10" @if(Input::get('to_month') == 10) selected="selected" @endif>أكتوبر</option>
                  <option value="11" @if(Input::get('to_month') == 11) selected="selected" @endif>نوفمبر</option>
                  <option value="12" @if(Input::get('to_month') == 12) selected="selected" @endif>ديسمبر</option>
               </select>
           </div>
           <div class="col-md-2">
                <label>سنة</label>
               <select class="form-control" name="to_year" style="padding:1px;">
                  @foreach($years as $year)
                   <option value="{{$year}}" @if(Input::get('to_year') == $year) selected="selected" @endif>{{$year}}</option>
                  @endforeach
               </select>
           </div>

           <div class="col-md-1">
                <label style="color:transparent">.button</label>
               <button class="btn btn-primary">بحث <i class="fa fa-search"></i></button>
           </div>
        

         {!! Form::Close() !!}
      </div>


        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>رقم الفاتورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>إجمالي المدفوعات</th>
                    </tr>
               </thead>
               <tbody>
                
                <?php $totals = 0; ?>
             @if($data)
               @foreach($data as $key => $row)
                  <tr>
                      <td class="text-center">{{$key+1}}</td>
                      <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                      <td class="text-center"><a href="{{ url('report/cash/check/'.$row->id) }}" style="color:#575757" target="_blank">{{$row->id}}</a></td>
                      <td class="text-center">
                          <?php $total = 0; ?>
                          @foreach(json_decode($row->cash_id) as $cashy)
                            @foreach(App\Cash_other::where('id',$cashy)->get() as $ceto)@endforeach
                            <?php
                              $total += $ceto->price*$ceto->qty;
                              ?>
                          @endforeach
                          {{Number_format($total,2)}} جنيه
                      </td>
                  </tr>
                   <?php $totals += $total; ?>
               @endforeach
            @endif

                </tbody>
               </table>
            </div>
      
       <div class="col-md-12"><br/><br/><br/></div>
            <table class="table">
               <tr>
                 <th class="text-center" style='width:10%;font-weight:bold;font-size:16px;'>الإجمالي</th>
                 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;'>{{number_format($totals,2)}} جنيه</th>
                 <th class="text-center" style='width:50%;font-weight:bold'></th>
               </tr>
            </table>



         </div>
      </div>
  </div>
</div>
</section>
@stop