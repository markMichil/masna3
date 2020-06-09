<style>
  .goal-item li {
    border-bottom: 1px solid #ddd;
    padding: 10px;

  }
 
</style>

<ul style="float:right;width:80%;" class="pull-right">
{{--    <li><a href="{{ url('/') }}" style="font-size:15px;"> جميع المنتجات</a></li>--}}

{{--  @foreach(App\Category::where('parent',0)->orderby('id','ASC')->get() as $cat)--}}
{{--      <li class="dropdown">--}}
{{--            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">--}}
{{--                 <span style='font-size:15px;'>{{$cat->slug}}</span>--}}
{{--            </a>--}}
{{--        @if(App\Category::where('parent',$cat->id)->count() > 0)    --}}
{{--      <div class="dropdown-menu left top-dropDown-1">--}}
{{--            <ul class="goal-item">--}}
{{--               @foreach(App\Category::where('parent',$cat->id)->orderby('id','ASC')->get() as $sub)--}}
{{--                    <li>--}}
{{--                        <a href="{{ url('category/'.preg_replace('/[[:space:]]+/', '-', $sub->slug.'/'.$sub->id)) }}">--}}
{{--                            <div class="goal-content">{{$sub->slug}}</div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--               @endforeach             --}}
{{--            </ul>--}}
{{--     </div>--}}
{{--       @endif--}}
{{--   </li>--}}
{{--   @endforeach--}}
{{--    --}}


      <li class="pull-right">
       @if(Auth::check())
          <a href="{{ url('logout') }}" style="font-size:15px;"><i class="fa fa-power-off"></i> تسجيل خروج</a>
       @else
         <a href="{{ url('login') }}" style="font-size:15px;"><i class="fa fa-sign-in"></i> تسجيل دخول</a>
       @endif
      </li>
</ul>