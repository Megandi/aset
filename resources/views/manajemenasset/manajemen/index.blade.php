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
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Gedung dan Ruangan</h3>
          <a style="margin-left:15px;margin-top:5px;" href="{{url('manajemenasset/tambah')}}" id="detail" class="btn btn-primary btn-sm mb15 pull-right"><i class="fa fa-plus">&nbsp;</i>Tambah</a>
          <a style="margin-left:15px;margin-top:5px;" href="{{url('manajemenasset/import')}}" id="detail" class="btn btn-warning btn-sm mb15 pull-right"><i class="fa fa-file-excel-o">&nbsp;</i>Import</a>
          <a style="margin-left:15px;margin-top:5px;" href="{{url('manajemenasset/export')}}" id="detail" class="btn btn-info btn-sm mb15 pull-right"><i class="fa fa-file-excel-o">&nbsp;</i>Export</a>
        </div>

        <div class="box-body">
          <div id="jstree1">
            @foreach($asset as $row)
            <ul>
    					<li onclick="detail({{$row->id}})" id="{!! $row->id !!}"> <font>{{$row->nama}}</font>
                <?php $rows2 = App\ManajemenAsset::where('parent', $row->id)->where('asset', '0')->get();?>
                @foreach($rows2 as $row2)
                <ul>
                  <li onclick="detail({{$row2->id}})" id="{!! $row2->id !!}" data-jstree='{"icon" : "glyphicon glyphicon-equalizer"}'> <font>{{$row2->nama}}</font>
                    <?php $rows3 = App\ManajemenAsset::where('parent', $row2->id)->where('asset', '0')->get();?>
                    @foreach($rows3 as $row3)
                    <ul>
                      <li onclick="detail({{$row3->id}})" data-jstree='{"icon" : "glyphicon glyphicon-home"}' id="{{$row3->id}}"><font>{{$row3->nama}}</font></li>
                    </ul>
                    @endforeach
                  </li>
                </ul>
                @endforeach
              </li>
            </ul>
            @endforeach
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
    </div>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail dan Daftar Peralatan</h3>
      <a href="#" id="editparent" class="pull-right btn btn-info"><i class="fa fa-edit"></i></a>
      <a style="margin-right:5px;" id="deleteparent" href="#" onclick="return confirm('Are you sure you want to delete this data ?')" class="pull-right btn btn-danger"><i class="fa fa-trash"></i></a>
    </div>
    <div class="box-body">
      <div id="divpertama">
        <table class="table">
          <tr>
            <th style="width: 10px">No.</th>
            <th>Header</th>
            <th>Nama</th>
            <th>Opsi</th>
          </tr>
          <tr>
            <td colspan="4"><center>Tidak ada asset yang dipilih</center></td>
          </tr>
        </table>
      </div>
      <div id="divkedua"> </div>
    </div>
  </div>

</section>
<!-- /.content -->

<script>

  $(function() {
    $('#jstree1').jstree();
  });
  $('#jstree1').on("changed.jstree", function (e, data) {
    var id = data.selected;
    $("#divkedua").load("{{ URL::to('manajemenasset/load/peralatan')}}/"+id);
    $("#editparent").attr('href','{!! url('manajemenasset/edit') !!}/' + id);
    $("#deleteparent").attr('href','{!! url('manajemenasset/hapus') !!}/' + id);
    document.getElementById('divpertama').style.display = 'none';
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
