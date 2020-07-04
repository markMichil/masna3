@if(Auth::check())
<ul class="mainNav">
@else
<ul class="mainNav active">
@endif

@if(Auth::check())
<li>
    <a id="dashbaord" class="li" href="{{ url('/') }}">
        <i class="fa fa-home"></i> <span>الرئيسية</span>
    </a>
</li>
{{--<li>--}}
{{--    <a id="categories" class="li" href="{{ url('categories') }}">--}}
{{--        <i class="fa fa-flag"></i> <span>الأقسام</span>--}}
{{--    </a>--}}
{{--</li>--}}
<li>
    <a id="products" class="li" href="{{ url('products') }}">
        <i class="fa fa-coffee  "></i> <span>العبايات</span>
    </a>
</li>
<li>
    <a id="invoices" class="li" href="{{ url('invoices') }}">
        <i class="fa fa-edit"></i> <span>فواتير المشتريات</span>
    </a>
</li>

        <li style="background-color: red">
            <a id="sinvoices" class="li" href="{{ url('returnInvoices') }}">
                <i class="fa fa-edit"></i> <span> مرتجع  فواتير مشتريات</span>
            </a>
        </li>
{{--<li>--}}
{{--    <a id="expenses" class="li" href="{{ url('expenses') }}">--}}
{{--        <i class="fa fa-bomb"></i> <span>مصروفات عامة</span>--}}
{{--    </a>--}}
{{--</li>--}}
<li>
    <a id="balance" class="li" href="{{ url('balance') }}">
        <i class="fa fa-money"></i> <span>الرصيد</span>
    </a>
</li>
<li>
    <a id="liabilities" class="li" href="{{ url('liabilities') }}">
        <i class="fa fa-bell"></i> <span>المطلوبات</span>
    </a>
</li>
<li>
    <a id="customer" class="li" href="{{ url('customer') }}">
         <i class="fa fa-users"></i> <span>الزبائن</span>
    </a>
</li><li>
    <a id="customer" class="li" href="{{ url('factories') }}">
         <i class="fa fa-users"></i> <span>المصانع</span>
    </a>
</li>

<li class="list dropdown">
    <a id="sales" href="#">
        <i class="fa fa-rocket"></i> <span>المبيعات</span>
    </a>
   <ul id="sales-ul">
       <li><a href="{{ url('sales/cash') }}"><i class="fa fa-arrow-circle-left"></i> نقدي</a></li>
       <li><a href="{{ url('sales/order/published') }}"><i class="fa fa-arrow-circle-left"></i> آجل</a></li>
{{--       <li><a href="{{ url('sales/installment/published') }}"><i class="fa fa-arrow-circle-left"></i> قسط</a></li>--}}
   </ul>
</li>

        <li class="list dropdown " style="background-color:red;">
            <a id="sales" href="#">
                <i class="fa fa-remove"></i> <span>مرتجع مبيعات </span>
            </a>
            <ul id="sales-ul" >
                <li style="background-color:#c10303;"><a href="{{ url('return/cash') }}"><i class="fa fa-arrow-circle-left"></i> نقدي</a></li>
                <li style="background-color:#c10303;"><a href="{{ url('return/order2') }}"><i class="fa fa-arrow-circle-left"></i> الاجل</a></li>
            </ul>
        </li>

{{--<li class="list dropdown">--}}
{{--    <a id="report" class="li" href="#">--}}
{{--        <i class="fa fa-line-chart"></i> <span>التقارير</span>--}}
{{--    </a>--}}
{{--    <ul id="report-ul">--}}
{{--        <li><a href="{{ url('report/products') }}"><i class="fa fa-arrow-circle-left"></i> المنتجات</a></li>--}}
{{--        <li><a href="{{ url('report/invoices') }}"><i class="fa fa-arrow-circle-left"></i> الفواتير</a></li>--}}
{{--        <li><a href="{{ url('report/expenses') }}"><i class="fa fa-arrow-circle-left"></i> المصروفات</a></li>--}}
{{--        <li><a href="{{ url('report/balance') }}"><i class="fa fa-arrow-circle-left"></i> الرصيد</a></li>--}}
{{--        <li><a href="{{ url('report/customer') }}"><i class="fa fa-arrow-circle-left"></i> العملاء</a></li>--}}
{{--        <li><a href="{{ url('report/cash') }}"><i class="fa fa-arrow-circle-left"></i> المبيعات النقدي</a></li>--}}
{{--        <li><a href="{{ url('report/order') }}"><i class="fa fa-arrow-circle-left"></i> المبيعات الآجل</a></li>--}}
{{--        <li><a href="{{ url('report/installment') }}"><i class="fa fa-arrow-circle-left"></i> المبيعات القسط</a></li>--}}
{{--    </ul>--}}
{{--</li>--}}
{{--<li class="list dropdown">--}}
{{--    <a id="report" class="li" href="#">--}}
{{--        <i class="fa fa-line-chart"></i> <span> التقارير اليومية</span>--}}
{{--    </a>--}}
{{--    <ul id="report-ul">--}}
{{--        <li><a href="{{ url('reportDaily/products') }}"><i class="fa fa-arrow-circle-left"></i> المنتجات</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/invoices') }}"><i class="fa fa-arrow-circle-left"></i> الفواتير</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/expenses') }}"><i class="fa fa-arrow-circle-left"></i> المصروفات</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/balance') }}"><i class="fa fa-arrow-circle-left"></i> الرصيد</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/customer') }}"><i class="fa fa-arrow-circle-left"></i> العملاء</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/cash') }}"><i class="fa fa-arrow-circle-left"></i> المبيعات النقدي</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/order') }}"><i class="fa fa-arrow-circle-left"></i> المبيعات الآجل</a></li>--}}
{{--        <li><a href="{{ url('reportDaily/installment') }}"><i class="fa fa-arrow-circle-left"></i> المبيعات القسط</a></li>--}}
{{--    </ul>--}}
{{--</li>--}}

        <li style="background-color:green;">
            <a id="movment" class="li" href="{{ url('ItemMovement') }}">
                <i class="fa fa-motorcycle"></i> <span>حركة الصنف</span>
            </a>
        </li>
@endif
</ul>
</section>


