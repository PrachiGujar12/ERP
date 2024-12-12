<nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <!-- <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/logo.svg')}}" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/logo-mini.svg')}}" alt="logo"/></a>
            </div> -->
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-cube-outline menu-icon"></i>
                  <span class="menu-title">Blogs</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="{{url('/blogs-list')}}">All Blogs</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/add-blogs')}}">Add New Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/blog-categories')}}">Category</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/tags')}}">Tags</a></li>
                    </ul>
                </div>
              </li>
            </ul>
        </div>
      </nav>