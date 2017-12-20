@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Manajemen Aset
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="active">Manajemen Aset</a></li>
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
        <form action="{{url('manajemenasset/save')}}" method="post">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-6">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" required="true" class="form-control" placeholder="Masukkan nama">
                </div>
                <div class="form-group">
                  <label>Peralatan</label> &nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" title="Pilih 'YA' jika asset ini berbentuk peralatan & pilih 'TIDAK' jika asset ini berbentuk gedung atau ruangan!"></i><br>
                  &nbsp;<input type="radio" name="asset" id="optionsRadios1" value="1" checked> Ya &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="asset" id="optionsRadios1" value="0"> Tidak
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="1">Baik</option>
                    <option value="0">Rusak</option>
                    <option value="2">Sedang diperbaiki</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>No Aset</label>
                  <input type="text" name="no_aset" class="form-control" placeholder="Masukkan no aset">
                </div>
                <div class="form-group" id="divLantai">
                  <label>Sub Aset Dari</label>
                  <select name="idDibawah" style="text-transform:uppercase" class="js-lantai form-control">
                  </select>
                  <input type="hidden" name="inputIdDibawah" id="inputIdDibawah"/>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan" class="form-control" rows="2"></textarea>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{url('manajemenasset')}}" class="btn btn-primary">Kembali</a>
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

  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
  });
// items select2
  $(".js-lantai").select2({
  ajax: {
    url: "{{ url('/manajemenasset/js/cari') }}",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        q: params.term, // search term
        idgedung: $("#idGedung").val() // search term
      };
    },
    processResults: function (data) {
      // parse the results into the format expected by Select2.
      // since we are using carom formatting functions we do not need to
      // alter the remote JSON data

      // console.log(data);

      // data.push({id:'addnew',text:'Add New'});


        return {
          results: data
        };
      },
      cache: true
    },
    minimumInputLength: 2,
  });

  $(".js-lantai").on("select2:select", function (e) {
      var obj = $(".js-lantai").select2("data")
      $('#inputIdDibawah').val(obj[0].id);
  });

</script>


@endsection
