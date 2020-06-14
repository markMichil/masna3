@extends('backend.layouts.layout')

@section('content')


<section id="min-wrapper">
  <div id="main-content">
    <div class="container-fluid">
           <div class="row">
              <div class="col-md-12">
                  <h3 class="ls-top-header">العبايات</h3>
                      <div class="panel panel-default">
                                <div class="panel-heading">
                            <h3 class="panel-title">تعديل العباية</h3>
                         </div>

                                <div id='mark' class="panel-body">

                                    @if(Session::has('success'))
                                     <p class="alert alert-success">{{Session::get('success')}}</p>
                                    @elseif(Session::has('error'))
                                     <p class="alert alert-danger">{{Session::get('error')}}</p>
                                    @endif

                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    <form role="form" action="{{route('products.update',$row->id)}}" method="post" enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')


                                        <div class="col-md-6">

                                           <div class="form-group">
                                              <label>المصنع</label>
                                               <select name="factory_id" class="form-control" style="padding:0;padding-right:5px;">

                                                   @if(count($factories)>0)
                                                       <option disabled>[ اختر المصنع ]</option>
                                                       @foreach($factories as $factory)

                                                           <option value="{{$factory->id}}" {{($factory->id == $row->factories_id)?'selected':''}}>{{$factory->name}}</option>

                                                       @endforeach
                                                   @else

                                                       <option disabled>[ يجب إدخال  المصنع ]</option>
                                                   @endif

                                               </select>
                                           </div>

                                           <div class="form-group">
                                              <label>كود المنتج</label>
                                              <input type="text" class="form-control" style='text-transform:uppercase' name="code" value="{{$row->code}}">
                                           </div>

                                           <div class="form-group">
                                              <label>أسم المنتج</label>
                                              <input type="text"  class="form-control" name="name" required value="{{$row->name}}">
                                           </div>

                                           <div class="form-group">
                                              <label>سعر الشراء</label>
                                              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="price" value="{{$row->price}}" required>
                                           </div>

                                           <div class="form-group">
                                              <label>سعر البيع</label>
                                              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="sell" value="{{$row->sell}}" required>
                                           </div>

                                           <div class="form-group">
                                              <label>الكمية</label>
                                              <input type="number" step="any" class="form-control" min="0" style="padding:1px;padding-right:10px;" name="quantity" value="{{$row->quantity}}" required>
                                           </div>


                                        </div>

                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">

                                          <div class="form-group">
                                            <label>صورة</label>
                                            <img id="img" src="{{ url($row->image) }}" style="width:100%;height:370px;border:1px solid #ddd;margin-bottom:5px;">
                                            <input type="file" data-image-target="#img" name="image"  accept="image/x-png, image/jpg, image/jpeg">
                                          </div>

                                        </div>



                                           <div class="form-group">
                                              <button class="btn btn-primary"><i class="fa fa-edit"></i> تعديل</button>
                                              <a href="{{ url('products') }}" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
                                           </div>



                                    </form>
                                </div>
                      </div>

              </div>
            </div>
    </div>
  </div>
</section>


@stop

@section('jsCode')
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var image = jQuery(input).data('image-target');

        var reader = new FileReader();

        reader.onload = function (e) {
            jQuery(image).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
jQuery("input[type=file]").change(function() {
   readURL(this);
});


document.querySelector('.submit').addEventListener("click", function(){
    window.btn_clicked = true;
});

window.onbeforeunload = function(){
    if(!window.btn_clicked){
        return "Seems Like you wanna leave ?";
    }
};

</script>
@stop
