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
                    <h3 class="panel-title">أضف عباية  جديدة</h3>
                 </div>

    <div class="panel-body">

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

      {!! Form::Open(['files'=>true]) !!}

        <div class="col-md-6">

           <div class="form-group">
              <label>القسم الفرعي</label>
              <select name="cat_id" class="form-control" style="padding:0;padding-right:5px;">

                  @foreach(App\Category::where('parent',0)->get() as $cat)
                      <option disabled>[ {{$cat->slug}} ]</option>
                      @foreach(App\Category::where('parent',$cat->id)->get() as $sub)
                          <option value="{{$sub->id}}">{{$sub->slug}}</option>
                      @endforeach
                  @endforeach
                 
              </select>
           </div> 

           <div class="form-group">
              <label>كود العباية</label>
              <input type="text" class="form-control" name="pro_code" style='text-transform:uppercase' required>
           </div>

           <div class="form-group">
              <label>أسم العباية</label>
              <input type="text" class="form-control" name="slug" required>
           </div>

           <div class="form-group">
              <label>سعر الشراء</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="cost_price" required>
           </div>

           <div class="form-group">
              <label>سعر البيع</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="price" required>
           </div>

     
           <div class="form-group">
              <label>الكمية</label>
              <input type="number" step="any" min="0" style="padding:1px;padding-right:10px;" class="form-control" name="qty" required>
           </div>


        </div>   
        
        <div class="col-md-1"></div>
        <div class="col-md-5">
          
          <div class="form-group">
            <label>صورة</label>
            <img id="img" src="" style="width:100%;height:370px;border:1px solid #ddd;margin-bottom:5px;">
            <input type="file" data-image-target="#img" name="image"  accept="image/x-png, image/jpg, image/jpeg">
          </div>

        </div>

        <div class="col-md-12">
           <div class="form-group">
             <label>وصف العباية</label>
             <textarea class="form-control" rows="9" name="content"></textarea>
           </div>

           <div class="form-group">
              <button class="btn btn-primary"><i class="fa fa-check-circle"></i> حفظ</button>
              <a href="{{ url('products') }}" class="btn btn-danger">رجوع <i class="fa fa-undo"></i></a>
           </div>
        </div>
 
    {!! Form::Close() !!}
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