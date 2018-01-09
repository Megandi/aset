@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dasbor
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dasbor</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @if(session('alert'))
    @if(session('alert')=="Gagal! Username sudah tersedia.")
      <div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-times"></i>{{ session('alert') }}</h4>
      </div>
    @else
      <div class="alert alert-info alert-dismissible">
        <h4><i class="icon fa fa-check"></i>{{ session('alert') }}</h4>
      </div>
    @endif
  @endif
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$totalAlat}}</h3>

          <p>Total Aset</p>
        </div>
        <div class="icon">
          <i class="fa fa-home"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$alatRusak}}</h3>

          <p>Aset Rusak</p>
        </div>
        <div class="icon">
          <i class="fa fa-warning"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{$alatBaik}}</h3>

          <p>Aset Baik</p>
        </div>
        <div class="icon">
          <i class="fa fa-check"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$perbaikanAlat}}</h3>

          <p>Aset sedang diperbaiki</p>
        </div>
        <div class="icon">
          <i class="fa fa-sticky-note"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
  </div>

</section>
<!-- /.content -->
@endsection
