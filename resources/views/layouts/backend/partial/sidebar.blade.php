<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img class="img-responsive " style="border-radius: 100%; width: 50px;height: 50px;"  src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" alt="">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href=""><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        @if(Request::is('admin*'))
          <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}">
                  <i class="fa fa-tachometer"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
              <a href="{{ route('admin.category.index') }}">
                  <i class="fa fa-book"></i>
                  <span>Category</span>
              </a>
          </li>

          {{-- for location --}}
          {{-- <li class="treeview">
            <a href="">
              <i class="fa fa-map-marker"></i>
              <span>Location</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{Request::is('admin/division') ||Request::is('admin/district')  ? 'display:block' : ''}}">
              <li class="{{ Request::is('admin/division*') ? 'active' : '' }}">
                  <a href="{{ route('admin.division.index') }}">
                      <i class="fa fa-circle"></i>
                      <span>Division</span>
                  </a>
              </li>
              <li class="{{ Request::is('admin/district*') ? 'active' : '' }}">
                  <a href="{{ route('admin.district.index') }}">
                      <i class="fa fa-circle"></i>
                      <span>District</span>
                  </a>
              </li>

            </ul>
          </li> --}}

          {{-- for unit --}}
          {{-- <li class="treeview">
            <a href="">
              <i class="fa fa-anchor"></i>
              <span>Unit</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{ Request::is('admin/unit') || Request::is('admin/size') ||Request::is('admin/colour')||Request::is('admin/brand')  ? 'display:block' : ''}}">
              <li class="{{ Request::is('admin/unit*') ? 'active' : '' }}">
                  <a href="{{ route('admin.unit.index') }}">
                      <i class="fa fa-circle"></i>
                      <span>Unit List</span>
                  </a>
              </li>

            </ul>
          </li> --}}

          {{-- for product --}}
          <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
              <a href="{{ route('admin.product.index') }}">
                  <i class="fa fa-cubes"></i>
                  <span>Products</span>
              </a>
          </li>

          @php
            $order_pending = App\Order::where('order_status','Pending')->count();
            $order_Confirmed = App\Order::where('order_status','Confirmed')->count();
            $order_Processing = App\Order::where('order_status','Processing')->count();
            $order_Delivered = App\Order::where('order_status','Delivered')->count();
            $order_Successed = App\Order::where('order_status','Successed')->count();
            $order_Canceled = App\Order::where('order_status','Canceled')->count();
          @endphp

          {{-- for Order Management--}}
          <li class="treeview">
            <a href="">
              <i class="fa fa-ship"></i>
              <span>Order Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{Request::is('admin/all-orders') ||Request::is('admin/order-details*') || Request::is('admin/pending-orders') || Request::is('admin/confirmed-orders') || Request::is('admin/processing-orders') || Request::is('admin/delivered-orders') || Request::is('admin/successed-orders') || Request::is('admin/canceled-orders')  ? 'display:block' : ''}}">

              <li class="{{ Request::is('admin/pending-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.pending_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Pending Orders @if ($order_pending > 0) ( {{$order_pending}} ) @endif</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/confirmed-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.confirmed_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Confirmed Orders @if ($order_Confirmed > 0) ( {{$order_Confirmed}} ) @endif</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/processing-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.processing_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Processing Orders @if ($order_Processing > 0) ( {{$order_Processing}} ) @endif</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/delivered-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.delivered_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Delivered Orders @if ($order_Delivered > 0) ( {{$order_Delivered}} ) @endif</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/successed-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.successed_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Successed Orders @if ($order_Successed > 0) ( {{$order_Successed}} ) @endif</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/canceled-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.canceled_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Canceled Orders @if ($order_Canceled > 0) ( {{$order_Canceled}} ) @endif</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/all-orders') ? 'active' : '' }}">
                  <a href="{{ route('admin.all_order') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>All Orders</span>
                  </a>
              </li>

            </ul>
          </li>

          {{-- for stock --}}
          <li class="treeview">
            <a href="">
              <i class="fa fa-database"></i>
              <span>Stock Management </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{Request::is('admin/purchase')||Request::is('admin/purchase-search*') ||Request::is('admin/sold-out')||Request::is('admin/sold-out-search*') ||Request::is('admin/stock-report')||Request::is('admin/stock-report-search*')  ? 'display:block' : ''}}">
              <li class="{{ Request::is('admin/purchase')||Request::is('admin/purchase-search*') ? 'active' : '' }}">
                  <a href="{{ route('admin.purchase.index') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Purchased Product</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/sold-out')||Request::is('admin/sold-out-search*') ? 'active' : '' }}">
                  <a href="{{ route('admin.sold_out') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Sold out Product</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/stock-report')||Request::is('admin/stock-report-search*') ? 'active' : '' }}">
                  <a href="{{ route('admin.stock_report') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Stock Report</span>
                  </a>
              </li>

            </ul>
          </li>

          {{-- for contact message --}}
          <li class="{{ Request::is('admin/message*') ? 'active' : '' }}">
              <a href="{{ route('admin.message.index') }}">
                  <i class="fa fa-comments-o"></i>
                  <span>Contact Message </span>
              </a>
          </li>

          {{-- for Website --}}
          <li class="treeview">
            <a href="">
              <i class="fa fa-globe"></i>
              <span>Website </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{Request::is('admin/slider*') ||Request::is('admin/banner*') ||Request::is('admin/website*')||Request::is('admin/policy')||Request::is('admin/blog')  ? 'display:block' : ''}}">
              <li class="{{ Request::is('admin/slider*') ? 'active' : '' }}">
                  <a href="{{ route('admin.slider.index') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Slider</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/policy') ? 'active' : '' }}">
                  <a href="{{ route('admin.policy.index') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Policy</span>
                  </a>
              </li>

              <li class="{{ Request::is('admin/blog') ? 'active' : '' }}">
                  <a href="{{ route('admin.blog.index') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Blog</span>
                  </a>
              </li>
              <li class="{{ Request::is('admin/services') ? 'active' : '' }}">
                  <a href="{{ route('admin.services.index') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Services</span>
                  </a>
              </li>
              <li class="{{ Request::is('admin/website*') ? 'active' : '' }}">
                  <a href="{{ route('admin.website.index') }}">
                      <i class="fa fa-long-arrow-right"></i>
                      <span>Setting</span>
                  </a>
              </li>

            </ul>
          </li>
          <li class="treeview">
            <a href="">
              <i class="fa fa-bell-slash"></i>
              <span>Offline Selling </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('admin/slider*') ? 'active' : '' }}">
                  <a href="{{ route('admin.slider.index') }}">
                    <i class="fa fa-long-arrow-right"></i>
                    <span>Offline Sell Product</span>
                  </a>
              </li>
            </ul>
          </li>
          {{-- for seting --}}
          <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
              <a href="{{ route('admin.settings') }}">
                  <i class="fa fa-lock"></i>
                  <span>Settings</span>
              </a>
          </li>
        @endif

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
