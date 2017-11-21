@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pengguna
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="active">Pengguna</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @if(session('alert'))
    <div class="alert alert-info alert-dismissible">
      <h4><i class="icon fa fa-check"></i>{{ session('alert') }}</h4>
    </div>
  @endif
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Pengguna</h3>
      <a style="margin-left:15px;margin-top:5px;" href="{{url('manajemenuser/tambah')}}" id="detail" class="btn btn-primary btn-sm mb15 pull-right"><i class="fa fa-plus">&nbsp;</i>Tambah</a>
    </div>
    <div class="box-body">
      <div class="box-body table-responsive">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
          </tr>
          <?php $i = 1; ?>
          @foreach($user as $row)
            <tr>
              <td>{{$i++}}.</td>
              <td>{{$row->name}}</td>
              <td>{{$row->username}}</td>
              <td>{{$row->email}}</td>
              <td>{{$row->leveltype->name}}</td>
              <td>
                <a href="{{url('manajemenuser/ubah/'.$row->id)}}" id="editparent" class="btn btn-info"><i class="fa fa-edit"></i></a>
                @if($row->id == Auth::user()->id)
                <a class="btn btn-danger" disabled href="#"><i class="fa fa-trash"></i></a>
                @else
                <a class="btn btn-danger" href="{{url('manajemenuser/hapus/'.$row->id)}}" onclick="return confirm('Anda yakin ingin menghapus user ini?')"><i class="fa fa-trash"></i></a>
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer-->
  </div>

</section>
<!-- /.content -->

<script type="text/javascript">

</script>
@endsection
