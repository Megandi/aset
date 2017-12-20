<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <center><img src="{{url('img/logoup_white_sm.png')}}" style="width:60%;height:50%;padding-bottom:10px;padding-top:10px;"></img></center>
      <li class="header">Menu</li>
      <li @if($menu=='0') class="active" @endif><a href="{{url('/')}}"><i class="fa fa-home"></i><span>Dasbor</span></a></li>

      <?php $cek1 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '1')->get(); ?>
      @if(sizeof($cek1)==1)
      @if($cek1[0]->r==1)
      <li @if($menu=='1') class="active" @endif><a href="{{url('list')}}"><i class="fa fa-list"></i><span>Daftar Aset</span></a></li>
      @endif
      @endif

      <?php $cek2 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '2')->get(); ?>
      @if(sizeof($cek2)==1)
      @if($cek2[0]->r==1)
      <li @if($menu=='2') class="active" @endif><a href="{{url('manajemenasset')}}"><i class="fa fa-wrench"></i><span>Manajemen Aset</span></a></li>
      @endif
      @endif

      <?php $cek3 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '3')->get(); ?>
      @if(sizeof($cek3)==1)
      @if($cek3[0]->r==1)
        <li @if($menu=='3') class="active" @endif><a href="{{url('manajemenuser')}}"><i class="fa fa-user"></i><span>Manajemen Pengguna</span></a></li>
      @endif
      @endif

      <?php $cek4 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '4')->get(); ?>
      @if(sizeof($cek4)==1)
      @if($cek4[0]->r==1)
        <li @if($menu=='4') class="active" @endif><a href="{{url('manajemenrole')}}"><i class="fa fa-sliders"></i><span>Manajemen Role</span></a></li>
      <!--
      <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('master/gedung')}}"><i class="fa fa-building-o"></i> Gedung</a></li>
          <li><a href="{{url('master/lantai')}}"><i class="fa fa-bars"></i> Lantai</a></li>
          <li><a href="{{url('master/kelas')}}"><i class="fa fa-home"></i> Kelas</a></li>
          <li><a href="{{url('master/asset')}}"><i class="fa fa-wrench"></i> Asset</a></li>
        </ul>-->
      </li>
      @endif
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
