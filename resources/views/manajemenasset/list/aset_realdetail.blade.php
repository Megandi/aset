@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h4>
    Detail Aset
  </h4>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="{{url('list')}}"><i class="fa fa-list"></i>Daftar Aset</a></li>
    <li><a href="#">Detail Aset</a></li>
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
      <div class="col-lg-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">{{$alat->nama}}</h3>
          </div>
          <div class="box-body">
            <table width="100%">
              <tr>
                <th style="width:30%;">Nomor aset</th>
                <th style="padding-top:10px"><input disabled class="form-control" value="{{$alat->no_aset}}"></th>
              </tr>
              <tr>
                <th style="width:30%;">Status saat ini</th>
                <th style="padding-top:10px"><input disabled class="form-control" @if($alat->status=='1') value="Baik" @elseif($alat->status=='2') value="Sedang diperbaiki" style="color:#f39c12" @else value="Rusak" style="color:#f56954" @endif></th>
              </tr>
              <tr>
                <th>Foto</th>
                <th style="padding-top:10px;">
                  @if($alat->foto=="")
                    <font>&nbsp;Tidak ada foto</font>
                  @else
                    <image src="{{url('imgaset/'.$alat->foto)}}" id="myImg" width="200px" alt="{{$alat->keterangan}}" height="200px">
                  @endif
                </th>
              </tr>
              <tr>
                <th>Keterangan</th>
                <th style="padding-top:10px"><textarea disabled required name="keterangan" class="form-control" rows="3">{{$alat->keterangan}}</textarea></th>
              </tr>
              <tr>
                <th>Status terakhir diubah oleh</th>
                @if($alat->user_last_updated==0)
                  <th style="padding-top:10px"><input disabled class="form-control" value=""></th>
                @else
                  <th style="padding-top:10px"><input disabled class="form-control" value="{{$alat->user_last_updated}} - {{$alat->user_last->name}}"></th>
                @endif
              </tr>
              <tr>
                <th>Status terakhir diubah pada</th>
                <th style="padding-top:10px"><input disabled class="form-control" value="{{$alat->updated_at}}"></th>
              </tr>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            @if($alat->asset=="1")
              <a href="{{url('list')}}" class="btn btn-primary">Kembali</a>
            @elseif($alat->asset=="0")
              <a href="{{url('list')}}" class="btn btn-primary">Kembali</a>
            @endif
          </div>
          <!-- /.box-footer-->
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Log</h3>
          </div>
          <div class="box-body">
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="width: 10px">No.</th>
                    <th>Status Awal</th>
                    <th>Status Akhir</th>
                    <th>Waktu</th>
                    <th>Oleh</th>
                    <th>Log</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($alat->log as $row)
                  <tr>
                    <td>{{$i++}}.</td>
                    <td>@if($row->status_awal=="1") Baik @elseif($row->status_awal=="2") Sedang diperbaiki @else Rusak @endif</td>
                    <td>@if($row->status_akhir=="1") Baik @elseif($row->status_akhir=="2") Sedang diperbaiki @else Rusak @endif</td>
                    <td>{{$row->waktu}}</td>
                    <td>{{$row->user->name}}</td>
                    <td>{{$row->log}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>

<style>
  /* Style the Image Used to Trigger the Modal */
  #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
  }

  #myImg:hover {opacity: 0.7;}

  /* The Modal (background) */
  .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }

  /* Modal Content (Image) */
  .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
  }

  /* Caption of Modal Image (Image Text) - Same Width as the Image */
  #caption {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      text-align: center;
      color: #ccc;
      padding: 10px 0;
      height: 150px;
  }

  /* Add Animation - Zoom in the Modal */
  .modal-content, #caption {
      -webkit-animation-name: zoom;
      -webkit-animation-duration: 0.6s;
      animation-name: zoom;
      animation-duration: 0.6s;
  }

  @-webkit-keyframes zoom {
      from {-webkit-transform:scale(0)}
      to {-webkit-transform:scale(1)}
  }

  @keyframes zoom {
      from {transform:scale(0)}
      to {transform:scale(1)}
  }



  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
      .modal-content {
          width: 100%;
      }
  }
</style>
<!-- The Modal -->
<div id="myModal" class="modal closee">


  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
<!-- /.content -->

<script>

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById('myImg');
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("closee")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>

@endsection
