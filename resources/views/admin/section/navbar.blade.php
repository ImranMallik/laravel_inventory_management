<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>

                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="#brandManage" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>

                        <span> Brand Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="brandManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.brand.all') }}" class="tp-link">All Brand</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#warehouseManage" data-bs-toggle="collapse">
                        <i data-feather="home"></i>

                        <span> Manage Ware House </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="warehouseManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.ware-house.all') }}" class="tp-link">All Warehouse</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#supplierManage" data-bs-toggle="collapse">
                        <i data-feather="box"></i>


                        <span> Manage Supplier </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="supplierManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.supplier.all') }}" class="tp-link">All Supplier</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#customerManage" data-bs-toggle="collapse">
                        <i data-feather="user"></i>


                        <span> Manage Customer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="customerManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.customer.all') }}" class="tp-link">All Customer</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#productManage" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>


                        <span> Manage Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="productManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.category.all') }}" class="tp-link">All Category</a>
                            </li>

                        </ul>
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.all-products') }}" class="tp-link">All Products</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#purchaseManage" data-bs-toggle="collapse">
                        <i data-feather="clipboard"></i>
                        <span> Purchase Manage </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="purchaseManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.all-purchase') }}" class="tp-link">All Purchase</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.all-purchase-return') }}" class="tp-link">All Purchase
                                    Return</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#sidebarError" data-bs-toggle="collapse">
                        <i data-feather="alert-octagon"></i>
                        <span> Error Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarError">
                        <ul class="nav-second-level">
                            <li>
                                <a href="error-404.html" class="tp-link">Error 404</a>
                            </li>
                            <li>
                                <a href="error-500.html" class="tp-link">Error 500</a>
                            </li>
                            <li>
                                <a href="error-503.html" class="tp-link">Error 503</a>
                            </li>
                            <li>
                                <a href="error-429.html" class="tp-link">Error 429</a>
                            </li>
                            <li>
                                <a href="offline-page.html" class="tp-link">Offline Page</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Utility </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="pages-starter.html" class="tp-link">Starter</a>
                            </li>
                            <li>
                                <a href="pages-profile.html" class="tp-link">Profile</a>
                            </li>
                            <li>
                                <a href="pages-pricing.html" class="tp-link">Pricing</a>
                            </li>
                            <li>
                                <a href="pages-timeline.html" class="tp-link">Timeline</a>
                            </li>
                            <li>
                                <a href="pages-invoice.html" class="tp-link">Invoice</a>
                            </li>
                            <li>
                                <a href="pages-faqs.html" class="tp-link">FAQs</a>
                            </li>
                            <li>
                                <a href="pages-gallery.html" class="tp-link">Gallery</a>
                            </li>
                            <li>
                                <a href="pages-maintenance.html" class="tp-link">Maintenance</a>
                            </li>
                            <li>
                                <a href="pages-coming-soon.html" class="tp-link">Coming Soon</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="calendar.html" class="tp-link">
                        <i data-feather="calendar"></i>
                        <span> Calendar </span>
                    </a>
                </li>

            </ul>

        </div>

    </div>
</div>
