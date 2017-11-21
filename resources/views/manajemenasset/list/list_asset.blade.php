@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Assets')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Detail Aset
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="{{url('list')}}"><i class="fa fa-list"></i>Daftar Aset</a></li>
    <li><a href="active">Detail Aset</a></li>
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
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
        <font class="box-title" style="margin-right:10px;">Status <b>{{$alat->nama}}:</b> @if($alat->status == '1') <font style="color:#3498db;">Baik</font> @elseif($alat->status == '2') <font style="color:#f39c12;">Sedang diperbaiki</font> @else <font style="color:#f56954;">Rusak</font> @endif</font></h3>
        <a class="btn btn-info" style="margin-right:5px;" href="{{ url('list/asset/detail/'.$alat->id) }}"><i class="fa fa-edit">&nbsp;</i>Ubah Status</a>
        <a class="btn btn-primary" href="{{ url('list/asset/detailaset/'.$alat->id) }}"><i class="fa fa-info-circle" >&nbsp;&nbsp;</i>Detail</a></td>
      </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      {{-- search --}}
      <!-- Search FIX -->
      <form class="form" action="{{ url('/list/asset/'.$parent.'/search') }}" method="post">
        {{csrf_field()}}
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Pencarian Aset (Alat) di <b>{{$alat->nama}}</b></h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Nama</label>
                  <input type="text" name="nama" class="form-control"  @if(isset($arraydata[0])) value="{{$arraydata[0]}}" @endif>
                </div>
                <div class="form-group">
                  <label class="control-label">Status</label>
                  <select name="status" class="form-control">
                    <option value="3"  @if(isset($arraydata[1])) @if($arraydata[1]=='3') selected @endif @endif>All</option>
                    <option value="0" @if(isset($arraydata[1])) @if($arraydata[1]=='0') selected @endif @endif>Rusak</option>
                    <option value="1" @if(isset($arraydata[1])) @if($arraydata[1]=='1') selected @endif @endif>Baik</option>
                    <option value="2" @if(isset($arraydata[1])) @if($arraydata[1]=='2') selected @endif @endif>Sedang diperbaiki</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Keterangan</label>
                  <textarea name="keterangan" rows="3" class="form-control" style="margin-bottom:10px;"> @if(isset($arraydata[2])) {{$arraydata[2]}} @endif</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <a href="{{url('list')}}" class="btn btn-primary">Kembali</a>
            <div class="pull-right">
              <a style="width : 90px;" href="{{url('list/asset/'.$parent)}}" type="button" onclick="return confirm('Are you sure want to reset?')" class="btn btn-warning">Setel Ulang</a>
              <button style="width : 90px;" type="submit" class="btn btn-primary">Cari</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary" id="boxaset">
        <div class="box-header with-border">
          <h3 class="box-title" style="width:80%;">Daftar Aset(Alat) di {{$alat->nama}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">No.</th>
              <th>Nama Peralatan</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($assets as $row)
              <tr>
                <td>{{$i++}}.</td>
                <td>{{$row->nama}}</td>
                @if($row->status == '1')
                  <td style="background-color:#3498db;color:white">Baik</td>
                @elseif($row->status == '2')
                  <td style="background-color:#f39c12;color:white">Sedang diperbaiki</td>
                @else
                  <td style="background-color:#f56954;color:white">Rusak</td>
                @endif
                <td>{{$row->keterangan}}</td>
                <td><a class="btn btn-info" href="{{ url('list/asset/detail/'.$row->id) }}"><i class="fa fa-edit">&nbsp;</i>Ubah Status</a>
                <a class="btn btn-primary" href="{{ url('list/asset/detailaset/'.$row->id) }}"><i class="fa fa-info-circle" >&nbsp;&nbsp;</i>Detail</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

@endsection
