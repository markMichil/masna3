@extends('backend.layouts.layout')
@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">تقارير المنتجات</h3>
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

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>كود المنتج</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>صورة</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>أسم المنتج</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>القسم</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>سعر الشراء</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>سعر البيع</th>
                     <th class="text-center" style='width:10%;font-weight:bold'>الكمية</th>
                    </tr>
               </thead>
               <tbody>
                
                <?php $total = 0; $sales = 0; ?>
             @if($data)
               @foreach($data as $key => $row)
                  @if($row->qty <= 0)
                      <tr style="background:#ffe0e0">
                  @else
                      <tr>
                  @endif
                      <td class="text-center">{{$key+1}}</td>
                      <td class='text-center'>{{$row->pro_code}}</td>
                          <td class='text-center'><img src="{{url($row->image)}}" style="width:70px;height:70px;border:1px solid #ddd"></td>
                          <td class='text-center'>{{$row->slug}}</td>
                          <td class='text-center'>
                               @foreach(App\Category::where('id',$row->cat_id)->get() as $sub) @endforeach
                              <span class="label label-warning">{{$sub->slug}}</span>
                          </td>
                          <td class='text-center'>{{$row->cost_price}}</td>
                          <td class='text-center'>{{$row->price}}</td>
                          <td class="text-center">{{$row->qty}}</td>
                  </tr>
                    <?php $total += $row->cost_price*$row->qty; $sales += $row->price*$row->qty; ?>
               @endforeach
             @endif

                </tbody>
               </table>
            </div>

      <div class="col-md-12"><br/><br/><br/></div>
            <table class="table">
               <tr>
                 <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي الشراء</th>
                 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;'>{{number_format($total,2)}} جنيه</th>
                 <th class="text-center" style='width:5%;font-weight:bold;font-size:16px;'></th>
				 <th class="text-center" style='width:15%;font-weight:bold;font-size:16px;'>إجمالي المبيعات</th>
				 <th class="text-center" style='width:20%;font-weight:bold;font-size:16px;'>{{number_format($sales,2)}} جنيه</th>
               </tr>
            </table>



         </div>
      </div>
  </div>
</div>
</section>
@stop