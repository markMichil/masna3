@extends('backend.layouts.layout')
@section('content')
   <?php  use Milon\Barcode\DNS1D; ?>

    <section id="min-wrapper" xmlns="http://www.w3.org/1999/html">
  <div id="main-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
          <h3 class="ls-top-header">المنتجات</h3>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">جميع العبايات ( {{count($data)}} )</h3>
                 </div>

    <div class="panel-body">

@if(Session::has('success'))
 <p class="alert alert-success">{{Session::get('success')}}</p>
@elseif(Session::has('error'))
 <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif

          <a href="{{ url('products/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> أضف عباية جديد</a><br/><br/>

        <div class="ls-editable-table table-responsive ls-table" style='font-family:Armata'>
              <table class="table table-bordered  table-bottomless" id="ls-editable-table">
                <thead>
                    <tr>
                     <th class="text-center" style='width:5%;font-weight:bold'>#</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>التاريخ</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>كود العباية</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>باركود</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>صورة</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>الأسم</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>المصنع</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>الكمية</th>
                     <th class="text-center"  style='width:10%;font-weight:bold'>السعر</th>
                     <th class="text-center"  style='width:15%;font-weight:bold'>الحدث</th>
                    </tr>
               </thead>
               <tbody>
             
                  
                  @foreach($data as $key => $row)
                       @if($row->qty <= 0)
                         <tr style="background:#ffe0e0">
                      @else
                         <tr>
                      @endif

                          <td class='text-center'>{{$key+1}}</td>
                          <td class='text-center'>{{explode(' ',$row->created_at)[0]}}</td>
                          <td class='text-center'>{{$row->code}}
<br>

                              <input type="number" id="{{$key+1}}copy"  min="1" value="1" style="
    width: 120px;" placeholder="عدد النسخ">
                              <button class="btn btn btn-primary btn-md" id="click" onclick="printData({{$key+1}});">أطبع الباركود
                              </button>

                          </td>
                           <td class='text-center' id="{{$key+1}}printTable">
                               <?php echo '<br><img src="data:image/png;base64,' . DNS1D::getBarcodePNG($row->code, "c128",2,50) . '" alt="barcode"   />'; ?>
                                   <h2> {{$row->pro_code}}</h2>
                             </td>
                          <td class='text-center'><img src="{{url($row->image)}}" style="width:70px;height:70px;border:1px solid #ddd"></td>
                          <td class='text-center'>{{$row->name}}</td>
                          <td class='text-center'>
                              {{$row['factory']['name']}}
                          </td>
                          <td class='text-center'>{{$row->quantity}}</td>
                          <td class='text-center'>{{$row->sell}}</td>
                          <td class='text-center'>
                              <form action="{{ url('products' , $row->id ) }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <a href="{{url('/products')}}/{{$row->id}}/edit" class="btn btn-success">تعديل</a>
                                  <button class="btn btn-danger confirmClickAction"><i class="fa fa-trash"></i> حذف</button>
                              </form>


{{--                          	 {!! Form::Open(['url'=>'products/del/'.$row->id]) !!}--}}
{{--                                 <a href="{{ url('products/edit/'.$row->id) }}" target="_blank" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a><br><br>--}}
{{--                                 <button class="btn btn-danger confirmClickAction"><i class="fa fa-trash"></i> حذف</button>--}}
{{--                              {!! Form::Close() !!}--}}
                          </td>                       
                      </tr>
                  @endforeach


                  
                </tbody>
               </table>
            </div>



         </div>
      </div>
  </div>
</div>
        <script>
            function printData(x)
            {
                var copy = document.getElementById( x+'copy').value;

            var c = x+'printTable';

            var divToPrint=document.getElementById(c);
            newWin= window.open("");
                for(var i=0;i<copy;i++){
                    newWin.document.write(divToPrint.outerHTML);
                }

            newWin.print();
            newWin.close();
            }
        </script>
</section>
@stop

