 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="{{ asset('admin/images/miniMallLogo.svg') }}" alt="miniMall Logo" class="brand-image" style="margin-left: .8rem;
      margin-right: .5rem; height:40px; width:30px;">
         <span class="brand-text font-weight-light" style="color: rgba(157, 255, 137, 0.349);">miniMall</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img @if (isset(Auth::guard('admin')->user()->image)&&!empty(Auth::guard('admin')->user()->image))
                 src="{{ asset('admin/images/'.Auth::guard('admin')->user()->image) }}"
                 @endif
                 class="img-circle elevation-2" alt=" User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>

             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item side-li">
                     <a href="{{url('admin/dashboard')}}" class="nav-link">
                         <i class="nav-icon fas fa-chart-pie"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>

                 </li>
                 <li class="nav-item side-li">
                    <a href="{{url('admin/view.order')}}" class="nav-link">
                        <i class="nav-icon fas fa-paste"></i>
                        <p>
                            Order Management
                        </p>
                    </a>
                </li>
                <li class="nav-item side-li">
                    <a href="{{url('admin/view.customers')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Customer Management
                        </p>
                    </a>
                </li>
                 <li class="nav-item side-li">
                     <a href="{{url('admin/view.admins')}}" class="nav-link">
                         <i class="nav-icon fas fa-user-tie"></i>
                         <p>
                             Admin Management
                         </p>
                     </a>
                 </li>
                 <li class="nav-item side-li">
                     <a href="{{url('admin/cms.pages')}}" class="nav-link">
                         <i class="nav-icon fas fa-pencil-alt"></i>
                         <p>
                             Page Management
                         </p>
                     </a>
                 </li>
                 <li class="nav-item side-li">
                    <a href="{{url('admin/view.coupon')}}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Coupon Management
                        </p>
                    </a>
                </li>
                 <li class="nav-item side-li">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-warehouse"></i>
                         <p>
                             Catelogue Management
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                         <li class="nav-item side-li">
                             <a href="{{url('admin/view.category')}}" class="nav-link">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                     Categories
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item side-li">
                             <a href="{{url('admin/view.brand')}}" class="nav-link">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                     Brands
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item side-li">
                             <a href="{{url('admin/view.product')}}" class="nav-link">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                     Products
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item side-li">
                     <a href="{{url('admin/view.banner')}}" class="nav-link">
                         <i class="nav-icon far fa-images"></i>
                         <p>
                             Banner Management
                         </p>
                     </a>

                 </li>
                 @if(Auth::guard('admin')->user()->type == 1)
                 <li class="nav-item side-li">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-wrench"></i>
                         <p>
                             Settings
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                         <li class="nav-item">
                             <a href="{{url('admin/password.admins')}}" class="nav-link">
                                 <i class="nav-icon fas a fa-ellipsis-h"></i>
                                 <p>
                                     Change password
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @endif


             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
