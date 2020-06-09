<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title style=""> مكتب جون للحسابات</title>
    <link href="{{ url('elixir/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('elixir/css/bootstrap-rtl.css') }}" rel="stylesheet">
    <link href="{{ url('elixir/css/rtl-css/style-rtl.css') }}" rel="stylesheet">
    <link href="{{ url('elixir/css/rtl-css/responsive-rtl.css') }}" rel="stylesheet">
   <link rel="shortcut icon" href="{{ url('favicon.ico')}}">
</head>

<style>
    tr td ,h1, a, button{
        font-family: 'Droid Arabic Kufi', sans-serif !important;
    }
</style>

<body class="black-color">
<nav class="navigation">
<div class="container-fluid">
<div class="header-logo">
    <a href="{{ url('/') }}">
        <h1>برنامج جون  حسابات</h1>
    </a>
</div>
<div class="top-navigation">

@if(Auth::check())
<div class="menu-control hidden-xs">
    <a href="javascript:void(0)">
        <i class="fa fa-bars"></i>
    </a>
</div>
@endif

@include('backend.layouts.dropdown')


</div>
</div>
</nav>




<section id="main-container">

@if(Auth::check())
<section id="left-navigation">
@else
<section id="left-navigation" class="active">
@endif



@if(Auth::check())

<div class="user-image" style='text-align:center;'>
{{--    <img src="{{ url('elixir/images/logo.jpg') }}" style='max-width:80px;max-height:80px;'/>--}}
    <span><a href="{{ url('profile') }}"  style='color:#fff;'> مدير الموقع</a></span>
    <div class="user-online-status"><span class="user-status is-online"></span> </div>
</div>

<div class="phone-nav-box visible-xs">
    <a class="phone-logo" href="{{ url('/') }}">
        <h1>مدير الموقع</h1>
    </a>
    <a class="phone-nav-control" href="javascript:void(0)">
        <span class="fa fa-bars"></span>
    </a>
    <div class="clearfix"></div>
</div>

@endif



@include('backend.layouts.sidemenu')



@yield('content')






</section>




<script src="{{ url('elixir/js/lib/jquery-1.11.min.js') }}"></script>
<script src="{{ url('elixir/js/bootstrap.min.js') }}"></script>
<script src="{{ url('elixir/js/multipleAccordion.js') }}"></script>
<script src="{{ url('elixir/js/switchery.min.js') }}"></script>
<script src="{{ url('elixir/js/bootstrap-switch.js') }}"></script>
<script src="{{ url('elixir/js/jquery.easypiechart.min.js') }}"></script>
<script type="text/javascript" src="{{ url('elixir/js/chart/flot/jquery.flot.js') }}"></script>
<script type="text/javascript" src="{{ url('elixir/js/chart/flot/jquery.flot.pie.js') }}"></script>
<script type="text/javascript" src="{{ url('elixir/js/chart/flot/jquery.flot.resize.js') }}"></script>
<script type="text/javascript" src="{{ url('elixir/js/pages/layout.js') }}"></script>
<script src="{{ url('elixir/js/countUp.min.js') }}"></script>
<script src="{{ url('elixir/js/skycons.js') }}"></script>
<script src="{{ url('elixir/js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('elixir/js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<script src="{{ url('elixir/js/jquery-ajax.js') }}"></script>
<script src="{{ url('elixir/js/lib/jquery.easing.js') }}"></script>
<script src="{{ url('elixir/js/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ url('elixir/js/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ url('elixir/js/tsort.js') }}"></script>
<script src="{{ url('elixir/js/jquery.tablednd.js') }}"></script>
<script src="{{ url('elixir/js/jquery.dragtable.js') }}"></script>
<script src="{{ url('elixir/js/editable-table/jquery.dataTables.js') }}"></script>
<script src="{{ url('elixir/js/editable-table/jquery.validate.js') }}"></script>
<script src="{{ url('elixir/js/editable-table/jquery.jeditable.js') }}"></script>
<script src="{{ url('elixir/js/editable-table/jquery.dataTables.editable.js') }}"></script>
<script src="{{ url('elixir/js/pages/table.js') }}"></script>

<script>
 $('button').tooltip();
 $('a').tooltip();
</script>

<script>
 $(".confirmClickAction").on("click", function( e ){
    if( ! confirm("Are you sure you want delete?") ){
            e.preventDefault();
      } else {
           $(this).submit();
      }
  });
</script>


<script>
    var href = window.location.href;
    var splits = href.split("radwan/")[1];
    var split = splits.split('/')[0];

    if(split == 'categories')
    {
        $('.li').removeClass("active");
        $("#categories").addClass("active");
    }
    else if(split == 'products')
    {
        $('.li').removeClass("active");
        $("#products").addClass("active");
    }
    else if(split == 'invoices')
    {
        $('.li').removeClass("active");
        $("#invoices").addClass("active");
    }
    else if(split == 'expenses')
    {
        $('.li').removeClass("active");
        $("#expenses").addClass("active");
    }
    else if(split == 'balance')
    {
        $('.li').removeClass("active");
        $("#balance").addClass("active");
    }
    else if(split == 'liabilities')
    {
        $('.li').removeClass("active");
        $("#liabilities").addClass("active");
    }
    else if(split == 'customer')
    {
        $('.li').removeClass("active");
        $("#customer").addClass("active");
    }
    else if(split == 'sales')
    {
        $('.li').removeClass("active");
        $("#sales").addClass("active");
    }
    else if(split == 'report')
    {
        $('.li').removeClass("active");
        $("#report").addClass("active");
    }
    else
    {
        $('.li').removeClass("active");
        $("#dashbaord").addClass("active");
    }
</script>

@yield('jsCode')

</body>
</html>