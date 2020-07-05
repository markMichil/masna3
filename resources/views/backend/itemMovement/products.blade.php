@extends('backend.layouts.layout')
@section('content')
<?php
use Illuminate\Support\Facades\Input;
?>

<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
            <h3 class="ls-top-header">حركة الصنف</h3>
              <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">نتيجة الحركة ( {{(isset($data['movements'])?count($data['movements']):0)}} ) {{$name}}</h3>
                        </div>

                    <div class="panel-body">
                        <div class="col-md-12" style="margin-bottom:50px;">

                              <?php
                                $years = range(date('Y'), 2016);
                              ?>

                            {!! Form::Open(['method'=>'GET']) !!}

                            <div class="col-md-6">
                      <label>بحث بكود المنتج</label>
                      <input name="pro_code" type="text" placeholder="كود العباية ">
                  </div>
                            <div class="col-md-6">
                              <label style="color:transparent">.button</label>
                              <a  class="btn btn-success" href="{{url('products')}}"
                                 onclick="window.open('{{url('products')}}',
                                         'newwindow',
                                         'width=1000,height=1000');
                                         return false;"
                                 target="_blank">بحث بالاكواد العباية</a>


                            </div>

                            <div class="col-md-2 col-md-offset-1">
                              <label>من شهر</label>
                              <select class="form-control" name="from_month" style="padding:1px;">
                                  <option value="all" @if(Input::get('from_month') == 'all') selected="selected" @endif>الكل</option>
                                  <option value="01" @if(Input::get('from_month') == 01) selected="selected" @endif>يناير</option>
                                  <option value="02" @if(Input::get('from_month') == 02) selected="selected" @endif>فبراير</option>
                                  <option value="03" @if(Input::get('from_month') == 03) selected="selected" @endif>مارس</option>
                                  <option value="04" @if(Input::get('from_month') == 04) selected="selected" @endif>أبريل</option>
                                  <option value="05" @if(Input::get('from_month') == 05) selected="selected" @endif>مايو</option>
                                  <option value="06" @if(Input::get('from_month') == 06) selected="selected" @endif>يونيو</option>
                                  <option value="07" @if(Input::get('from_month') == 07) selected="selected" @endif>يوليو</option>
                                  <option value="08" @if(Input::get('from_month') == 8) selected="selected" @endif>أغسطس</option>
                                  <option value="09" @if(Input::get('from_month') == 9) selected="selected" @endif>سبتمبر</option>
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
                            <div class="col-md-1">
                                  <center style='margin-top:30px;'>
                                      <i class="fa fa-arrow-circle-left"></i>
                                  </center>
                              </div>

                            <div class="col-md-2">
                              <label>إلي شهر</label>
                              <select class="form-control" name="to_month" style="padding:1px;">
                                  <option value="all" @if(Input::get('to_month') == 'all') selected="selected" @endif>الكل</option>
                                  <option value="01" @if(Input::get('to_month') == 01) selected="selected" @endif>يناير</option>
                                  <option value="02" @if(Input::get('to_month') == 02) selected="selected" @endif>فبراير</option>
                                  <option value="03" @if(Input::get('to_month') == 03) selected="selected" @endif>مارس</option>
                                  <option value="04" @if(Input::get('to_month') == 04) selected="selected" @endif>أبريل</option>
                                  <option value="05" @if(Input::get('to_month') == 05) selected="selected" @endif>مايو</option>
                                  <option value="06" @if(Input::get('to_month') == 06) selected="selected" @endif>يونيو</option>
                                  <option value="07" @if(Input::get('to_month') == 07) selected="selected" @endif>يوليو</option>
                                  <option value="08" @if(Input::get('to_month') == 8) selected="selected" @endif>أغسطس</option>
                                  <option value="09" @if(Input::get('to_month') == 9) selected="selected" @endif>سبتمبر</option>
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

                        @if(Session::has('error'))
                            <p class="alert alert-danger">{{Session::get('error')}}</p>
                        @endif
                        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>

                            <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                            <thead>
                            <tr>
                             <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                             <th class="text-center" style='width:10%;font-weight:bold'>كود العباية</th>

                             <th class="text-center" style='width:10%;font-weight:bold'>أسم العباية</th>

                             <th class="text-center" style='width:10%;font-weight:bold'>أسم المصنع</th>

                             <th class="text-center" style='width:10%;font-weight:bold'>سعر الشراء</th>
                             <th class="text-center" style='width:10%;font-weight:bold'>سعر البيع</th>
                             <th class="text-center" style='width:10%;font-weight:bold'>الكمية</th>
                                <th class="text-center" style='width:10%;font-weight:bold'>الحركة</th>
                             <th class="text-center" style='width:10%;font-weight:bold'> رقم الفاتورة</th>


                             <th class="text-center" style='width:10%;font-weight:bold'>التاريخ</th>
                            </tr>
                       </thead>
                            <tbody>
                            @if($data  && !empty($data))
                       @foreach($data['movements'] as $key => $row)

                          @if($data->quantity <= 0)
                              <tr style="background:#ffe0e0">
                          @else
                              <tr>
                          @endif
                              <td class="text-center">{{$key+1}}</td>
                              <td class='text-center'>{{$data->code}}</td>
                                  <td class='text-center'>{{$data->name}}</td>
                                  <td class='text-center'>{{$data['factory']->name}}</td>
                                  <td class='text-center'>{{$row->price}}</td>
                                  <td class='text-center'>{{$row->sell}}</td>
                                  <td class='text-center'>{{$row->qty}}</td>
                                  <td class='text-center'>{{$row['type_movements']->name}}</td>
                                  @if($row['type_movements']->id ==1)
                                          <?php
                                          $buyProduct += $row->qty;
                                          $buy += ($row->qty*$row->price);
                                            ?>
                                    @elseif($row['type_movements']->id==2)
                                      <?php
                                      $sellProduct += $row->qty;
                                          $sell += ($row->qty*$row->sell);
                                      ?>
                                  @elseif($row['type_movements']->id==3)
                                  <?php
                                    $returnBuyProduct += $row->qty;
                                     $returnBuy += ($row->qty*$row->price);
                                     ?>
                                      @elseif($row['type_movements']->id==4)
                                      <?php
                                      $returnSellProduct += $row->qty;
                                      $returnSell += ($row->qty*$row->sell);
                                      ?>
                                      @endif
                                  <td class='text-center'>{{$row->reason}}</td>
                                  <td class='text-center'>{{$row->updated_at}}</td>

                          </tr>
                      @endforeach
                     @endif
                            </tbody>
                       </table>

                        </div>

                        <div class="col-md-12">
                          <br/><br/><br/>
                        </div>

                        <div class="col-md-12">
                            <table class="table">
                            <tr>
                         <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي المخزن
                         <br>
                            {{$qty}} منتج

                         </th>

                         <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي الشراء
                         <br>
                            {{$buyProduct}} منتج

                             <br>
                           {{$buy}} جنيه
                         </th>
                         <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي مرتجعات للمصنع
                               <br>   {{$returnBuyProduct}} منتج

                               <br>
                               {{$returnBuy}} جنيه
                           </th>

                       </tr>
                            </table>
                        </div>

                        <div class="col-md-12">
                        <table class="table">
                            <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي المبيعات
                             <br>
                             {{$sellProduct}} منتج

                             <br>
                             {{$sell}} جنيه
                            </th>


                           <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي مرتجعات بيع
                               <br>
                               {{$returnSellProduct}} منتج

                               <br>
                               {{$returnSell}} جنيه
                            </th>
                         </table>
                    </div>
                    </div>



              </div>
          </div>
       </div>
    </div>
  </div>
</section>
@stop
