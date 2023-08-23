
<!---========== Left Sidebar Start ========== -->
<div class="leftside-menu leftside-menu-detached">

    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="assets/admin/images/users/avatar-1.jpg" alt="user-image" height="42"
                class="rounded-circle shadow-sm">
            <span class="leftbar-user-name">Admin</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce"
                class="side-nav-link">
                <i class="uil-user"></i>
                <span> Users </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarEcommerce">
                <ul class="side-nav-second-level">

                    <li>
                        <a href="sellers">Manage Sellers</a>
                    </li>
                    <li>
                        <a href="buyers">Manage Buyers</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail"
                class="side-nav-link">
                <i class="fas fa-list-alt"></i>
                <span> Categories </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarEmail">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="categories">Manage Categories</a>
                    </li>
                    <li>
                        <a href="sub_categories">Manage Subcategories</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
                <i class="fas fa-language"></i>
                <span> Language </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarLayouts">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="languages">Manage Language</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
                <i class="fa fa-money-bill-alt"></i>
                <span> Currencies </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarBaseUI">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="currencies"> Manage Currencies</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false" aria-controls="sidebarTables" class="side-nav-link">
                <i class="fa fa-credit-card"></i>
                <span> Payments </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTables">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="payments">Manage Payments</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons" class="side-nav-link">
                <i class="uil-streering"></i>
                <span> WithDrawal Request </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarIcons">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="withdrawal_requests">Withrawal Requests</a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="side-nav-item">
            <a href="#"  data-bs-toggle="modal"
            data-bs-target="#updatepassword" class="side-nav-link">
                <i class="fa fa-key"></i>
                <span> Change Password </span>
            </a>
        </li>


    </ul>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->

@include('admin.changepassword')

