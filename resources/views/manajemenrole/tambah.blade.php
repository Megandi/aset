@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Manajemen Role
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="active">Manajemen Role</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @if(session('alert'))
    <div class="alert alert-info alert-dismissible">
      <h4><i class="icon fa fa-check"></i>{{ session('alert') }}</h4>
    </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <form action="{{url('manajemenrole/save')}}" method="post">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-8">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" required="true" class="form-control" placeholder="Masukkan nama role">
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{url('manajemenrole')}}" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
        </form>
        <!-- /.box-footer-->
      </div>
    </div>
  </div>

</section>
<!-- /.content -->

<script>

</script>


@endsection
