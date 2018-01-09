@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Manajemen Pengguna
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="active">Manajemen Pengguna</a></li>
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
        <form action="{{url('manajemenuser/ubahsave')}}" method="post">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-6">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" required="true" class="form-control" value="{{$user->name}}">
                  <input type="hidden" name="id" required="true" class="form-control" value="{{$user->id}}">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input name="emailinput" class="form-control" value="{{$user->username}}">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" required="true" class="form-control" value="{{$user->email}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Password (isi bila ingin diubah)</label>
                  <input type="password" name="passwordinput" class="form-control">
                </div>
                <div class="form-group">
                  <label>Level</label>
                  <select name="level" class="form-control">
                    @foreach($leveltype as $row)
                      <option value="{{$row->id}}" @if($user->id_level == $row->id) selected @endif>{{$row->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{url('manajemenuser')}}" class="btn btn-primary">Kembali</a>
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
