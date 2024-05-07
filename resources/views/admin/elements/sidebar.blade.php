        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    {{-- <div class="image">
                             <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                         </div> --}}
                    <div class="info">
                        <a href="#" class="d-block">Tên</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">Quản trị</li>
                        <li class="nav-item">
                            <a href="{{ route("category") }}" class="nav-link">
                                <i class="nav-icon fas fa-qrcode"></i>
                                <p>
                                    Danh mục
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route("subcategory") }}" class="nav-link">
                                <i class="nav-icon fas fa-qrcode"></i>
                                <p>
                                    Chủ đề
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route("post") }}" class="nav-link">
                                <i class="nav-icon fas fa-qrcode"></i>
                                <p>
                                    Bài viết
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route("$moduleName.accounts.get") }}" class="nav-link">
                                <i class="nav-icon fas fa-qrcode"></i>
                                <p>
                                    Tài khoản
                                </p>
                            </a>
                        </li> --}}

                </nav>
            </div>
        </aside>
