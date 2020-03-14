<?php
use \App\Models\Helper;
$role = Auth::user()->role;
?>
 @section('navbar')
 <div id="navbar" class="navbar-collapse collapse">
  <ul class="nav navbar-nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle {{$active_nav == 'category' || $active_nav == 'product' ? 'active' : ''}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalog<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="{{ Helper::adminUrl('product/create') }}">Add New Product</a></li>
        <li><a href="{{ Helper::adminUrl('product') }}">Manage Products</a></li>
        <li><a href="{{ Helper::adminUrl('category/tree-view') }}">Manage Product Categories</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle {{$active_nav == 'deal' || $active_nav == 'deal_category' ? 'active' : ''}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Deal <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="{{ Helper::adminUrl('deal/create') }}">Add New Deals</a></li>
        <li><a href="{{ Helper::adminUrl('deal') }}">Manage Deals</a></li>
        <li><a href="{{ Helper::adminUrl('deal/category') }}">Manage Deal Categories</a></li>
        <li><a href="{{ Helper::adminUrl('sale/deals') }}">Validate Deals</a></li>
      </ul>
    </li>
    <li>
      <a href="{{ Helper::adminUrl('event') }}" class="dropdown-toggle {{$active_nav == 'event' ? 'active' : ''}}" role="button">Events</a>
    </li>
    @if ($role === 'admin')
    <li class="dropdown">
      <a href="#" class="dropdown-toggle {{$active_nav == 'user' ? 'active' : ''}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <!-- <li><a href="{{ Helper::adminUrl('user/vendor/create') }}">Create Vendor</a></li> -->
        <li><a href="{{ Helper::adminUrl('user/vendors') }}">Manage Vendors</a></li>
        <li><a href="{{ Helper::adminUrl('user/permissions') }}">Manage Vendors Permissions</a></li>
        <li><a href="{{ Helper::adminUrl('user/customers') }}">App Users</a></li>
        <!--<li class="divider" role="separator"></li>
        <li><a href="{{ Helper::adminUrl('user/customer/add') }}">Add Customer</a></li>
        <li><a href="{{ Helper::adminUrl('user/customers') }}">List Customers</a></li>-->
      </ul>
    </li>
    <li class="dropdown">
      <a href="{{ Helper::adminUrl('slider/manage') }}" class="{{$active_nav == 'slider' ? 'active' : ''}}" role="button">Sliders</a>
    </li>
    <li class="dropdown">
      <a href="{{ Helper::adminUrl('page/manage') }}" class="{{$active_nav == 'page' ? 'active' : ''}}" role="button" >Pages</a>
    </li>
    @endif
    <li class="dropdown">
      <a href="#" class="dropdown-toggle {{$active_nav == 'sale' ? 'active' : ''}}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sales <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="{{ Helper::adminUrl('sale/orders') }}">Product Orders</a></li>
        <li><a href="{{ Helper::adminUrl('sale/deals') }}">Deal Orders</a></li>
      </ul>
    </li>
    @if (Auth::user()->store && !empty(Auth::user()->store))
      <li>
        <a href="{{Helper::adminUrl('message')}}" class="dropdown-toggle {{$active_nav == 'message' ? 'active' : ''}}" role="button">Messages <span class="badge">{{ $count_message }}</span></a>
      </li>
    @endif
    <!-- <li>
      <a href="{{Helper::adminUrl('redeem')}}" class="dropdown-toggle {{$active_nav == 'redeem' ? 'active' : ''}}" role="button">Redeem</a>
    </li> -->
    @if ($role === 'admin')
      <li><a href="{{ Helper::adminUrl('setting') }}" class="{{$active_nav == 'setting' ? 'active' : ''}}">Settings</a></li>
    @else
      <li><a href="{{ Helper::adminUrl('setting/vendor/'.Auth::user()->id) }}" class="{{$active_nav == 'setting' ? 'active' : ''}}">Settings</a></li>
    @endif
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="javascript:;">{{ ucfirst(Auth::user()->username) }} <span class="caret"></span></a>
      <ul class="dropdown-menu">
        @if (Auth::user()->store && !empty(Auth::user()->store))
          <li><a href="{{Helper::adminUrl('store/edit')}}/{{Auth::user()->store->storeId}}">Manage Store</a></li>
        @endif
         @if ($role === 'admin')
        <li><a href="{{Helper::adminUrl('marketing/notifications')}}">Send Notification</a></li>
        @endif
          <li><a href="{{Helper::adminUrl('wallet')}}">My Wallet</a></li>
        <li><a href="{{Helper::adminUrl('logout')}}">Logout!</a></li>
      </ul>
    </li>
  </ul>
</div><!--/.nav-collapse -->
@stop