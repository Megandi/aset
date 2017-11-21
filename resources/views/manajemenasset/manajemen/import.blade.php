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
    @if(session('alert')=="Gagal dalam import data!")
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
    <div class="col-lg-12">
      <div class="box">
        <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validasitrue();" action="{!! url('manajemenasset/importsave') !!}"  id="fimcs">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="box-header with-border">
            <h3 class="box-title">Import Data Aset</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="row">
                <div class="col-md-11">
                    <div class="form-group">
                        <label for="import" class="col-sm-2 control-label">Excel File</label>
                        <div class="col-sm-6">
                            <input name="import" type="file" id="import" placeholder="Import" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="import" class="col-sm-2 control-label">Format</label>
                        <div class="col-sm-10">
                            <input type='text' readonly class='form-control' value='Sheet 1 : ID | PARENT | NAMA | STATUS | KETERANGAN | JENIS_ASET'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="import" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            <ul>
                                <li><b>ID:</b> ID aset yang ingin disimpan. ID ini akan dijadikan acuan apabila aset menjadi parent dari aset yang lain. ID tiap aset bersifat unik.</li>
                                <li><b>PARENT:</b> Tulis ID parent secara jelas dan akurat | untuk aset utama (yang tidak memiliki parent) isikan dengan 0.</li>
                                <li><b>NAMA:</b> Nama dari aset.</li>
                                <li><b>STATUS:</b> Isikan status dari aset yang akan disimpan. 1: aset dalam keadaan baik, 2: sedang diperbaiki, 0: Rusak. </li>
                                <li><b>KETERANGAN:</b> Keterangan dari aset yang akan disimpan.</li>
                                <li><b>JENIS ASET:</b> Isikan 0 apabila aset berbentuk gedung/ruangan dan isikan 1 apabila aset berbentuk alat.</li>
                            </ul>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header"  style="background-color: #e30100;color: white">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">PERHATIAN</h4>
                    </div>
              	  <div class="modal-body">
              		  <p>Apakah anda yakin ingin mengimport data?<br>Jika iya, data aset yang lama akan terhapus secara permanent!</p>
              	  </div>
                    <div class="modal-footer">
                      <input type="submit" name="action" value="Import"  class="btn btn-primary"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{url('manajemenasset')}}" class="btn btn-primary">Kembali</a>
              <a id="btnsave" class="btn btn-info pull-right" name="upload" style="margin-left:5px;" value="Upload"><i class="ti-upload mr5"></i>Upload</a>
              <a href="{!! url('manajemenasset/import/sample') !!}" class="btn btn-warning pull-right"><i class="ti-download mr5"></i>Sample</a>
            </div>
            <!-- /.box-footer-->
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script>

$('#btnsave').on('click', function() {
          $('#rejectModal').modal();
      });
</script>


@endsection
