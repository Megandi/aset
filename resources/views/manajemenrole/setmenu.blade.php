@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Role
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="{{url('manajemenrole')}}"><i class="fa fa-list"></i>Role</a></li>
    <li><a href="active">Set Menu</a></li>
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
    <div class="col-lg-6">
      <div class="box">
        <form action="{{url('manajemenrole/role/save')}}" method="post">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-12">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" required="true" class="form-control" value="{{$leveltype->name}}">
                  <input type="hidden" name="id" required="true" class="form-control" value="{{$leveltype->id}}">
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
        </form>
        <!-- /.box-footer-->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Set Menu</h3>
        </div>
        <form action="{{url('manajemenrole/update')}}" method="post">
        <div class="box-body">
            {{ csrf_field() }}
          <input type="hidden" value="{{$id_level}}" name="id_level">
          <table id="table-home" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                @foreach($levelakses as $item)
                <tr>
                  <td>{{ $item->menu->nama }}</td>
                  <td><input type="checkbox" name="read_{{$item->id_menu}}" {{$item->r==1?"checked":""}}></td>
                </tr>
                @endforeach
              </tbody>
            </table>
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

<script type="text/javascript">

</script>
@endsection
