 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">
     <ul class="sidebar-nav" id="sidebar-nav">
         <!-- Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li>
         <!-- Homepage slider  -->
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() == 'slider' ? '' : 'collapsed' }}" href="{{ route('slider') }}">
                 <i class="bi bi-sliders"></i>
                 <span>Slider</span>
             </a>
         </li>
         <!-- Components Nav -->
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() == 'product.attributes' ? '' : 'collapsed' }}"
                 data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-basket"></i><span>Product Attributes</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="products-nav"
                 class="nav-content collapse {{ (((Route::currentRouteName() == 'color' ? 'show' : '' || Route::currentRouteName() == 'size') ? 'show' : '' || Route::currentRouteName() == 'category') ? 'show' : '' || Route::currentRouteName() == 'subcategory') ? 'show' : '' || Route::currentRouteName() == 'product' ? 'show' : ''}}"
                 data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('product') }}"
                         class="{{ Route::currentRouteName() == 'product' ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Product</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('color') }}"
                         class="{{ Route::currentRouteName() == 'color' ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Color</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('size') }}"
                         class="{{ Route::currentRouteName() == 'size' ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Size</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('category') }}"
                         class="{{ Route::currentRouteName() == 'category' ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Category</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('subcategory') }}"
                         class="{{ Route::currentRouteName() == 'subcategory' ? 'active' : '' }}">
                         <i class="bi bi-circle"></i><span>Subcategory</span>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- pages -->
         <li class="nav-heading">Pages</li>
         {{-- brands --}}
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() == 'brands' ? '' : 'collapsed' }}" href="{{ route('brands') }}">
                 <i class="bi bi-building"></i>
                 <span>Brands</span>
             </a>
         </li>
         {{-- team membrs --}}
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() == 'team.member' ? '' : 'collapsed' }}" href="{{ route('team.member') }}">
                 <i class="bi bi-people"></i>
                 <span>Team Members</span>
             </a>
         </li>
         {{-- profile --}}
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() == 'profile' ? '' : 'collapsed' }}" href="{{ route('profile') }}">
                 <i class="bi bi-person"></i>
                 <span>Profile</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-faq.html">
                 <i class="bi bi-question-circle"></i>
                 <span>F.A.Q</span>
             </a>
         </li><!-- End F.A.Q Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-contact.html">
                 <i class="bi bi-envelope"></i>
                 <span>Contact</span>
             </a>
         </li><!-- End Contact Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-register.html">
                 <i class="bi bi-card-list"></i>
                 <span>Register</span>
             </a>
         </li><!-- End Register Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-login.html">
                 <i class="bi bi-box-arrow-in-right"></i>
                 <span>Login</span>
             </a>
         </li><!-- End Login Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-error-404.html">
                 <i class="bi bi-dash-circle"></i>
                 <span>Error 404</span>
             </a>
         </li><!-- End Error 404 Page Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="pages-blank.html">
                 <i class="bi bi-file-earmark"></i>
                 <span>Blank</span>
             </a>
         </li><!-- End Blank Page Nav -->

     </ul>

 </aside><!-- End Sidebar-->
