<!-- Left Sidebar  -->
<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">utama</li>
                <li> <a href="{{ route('dashboard.index') }}" aria-expanded="false"><i class="fa fa-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Transaction</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('transaction.list') }}">List</a></li>
                        <li><a href="{{ route('transaction.add') }}">Add Transaction</a></li>
                    </ul>
                </li>
                @if (Auth::User()->akses == "admin")
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-folder"></i><span class="hide-menu">Master</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('informasi.index') }}">Informasi Toko</a></li>
                        <li><a href="{{ route('user.list') }}">Daftar User</a></li>
                        <li><a href="{{ route('kategori.list') }}">Category</a></li>
                        <li><a href="{{ route('unit.list') }}">Unit</a></li>
                        <li><a href="{{ route('product.list') }}">Product</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
        <!-- End Left Sidebar  -->