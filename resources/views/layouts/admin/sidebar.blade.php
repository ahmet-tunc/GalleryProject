<!-- ========== LEFT SIDEBAR ========== -->
<div class="left-sidebar fixed-sidebar bg-black-300 box-shadow tour-three">
    <div class="sidebar-content">
        <div class="user-info closed">
            <img src="http://placehold.it/90/c2c2c2?text=User" alt="John Doe" class="img-circle profile-img">
            <h6 class="title">John Doe</h6>
            <small class="info">PHP Developer</small>
        </div>
        <!-- /.user-info -->

        <div class="sidebar-nav">
            <ul class="side-nav color-gray">
                <li class="nav-header">
                    <span class="">Admin Panel</span>
                </li>
                <li class="has-children">
                    <a href="#"><i class="fa fa-photo"></i> <span>Slider İşlemleri</span> <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li class="{{\Illuminate\Support\Facades\Route::is('admin.slider')?'active':''}}"><a href="{{route('admin.slider')}}"><i class="fa fa-file-image-o"></i> <span>Slider</span></a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('admin.subSlider')?'active':''}}"><a href="{{route('admin.subSlider')}}"><i class="fa fa-file-image-o"></i> <span>Alt Slider</span></a></li>
                    </ul>
                </li>

                <li class="{{\Illuminate\Support\Facades\Route::is('admin.gallery')?'active':''}}"><a href="{{route('admin.gallery')}}"><i class="fa fa-image"></i> <span>Galeri</span></a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('admin.news')?'active':''}}"><a href="{{route('admin.news')}}"><i class="fa fa-book"></i> <span>Haberler</span></a></li>
                <li><a href="javascript:void(0)" onclick="document.getElementById('frmLogout').submit()"><i class="fa fa-sign-out"></i> <span>Çıkış Yap</span></a></li>
                <form id="frmLogout" action="{{route('logout')}}" method="POST">
                    @csrf
                </form>
            </ul>
        </div>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.sidebar-content -->
</div>
<!-- /.left-sidebar -->
