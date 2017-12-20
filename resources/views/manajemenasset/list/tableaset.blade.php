<table class="table">
  <tr>
    <td style="width:10%"> Nama</td>
    <td style="width:5%">:</td>
    <td style="width:80%">{{$alat->nama}}</td>
  </tr>
  <tr>
    <td style="width:10%"> Status</td>
    <td style="width:5%">:</td>
    <td style="width:80%">@if($alat->status == '1') <font style="color:#3498db;">Baik</font> @elseif($alat->status == '2') <font style="color:#f39c12;">Sedang diperbaiki</font> @else <font style="color:#f56954;">Rusak</font> @endif</font></td>
  </tr>
  <tr>
    <td style="width:10%"> Keterangan</td>
    <td style="width:5%">:</td>
    <td style="width:80%">{{$alat->keterangan}}</td>
  </tr>
</table>

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
        <td><a class="btn btn-info" href="{{ url('list/asset/detail/'.$row->id) }}"><i class="fa fa-edit"></i></a>
        <a class="btn btn-primary" href="{{ url('list/asset/detailaset/'.$row->id) }}"><i class="fa fa-info-circle" ></i></a></td>
      </tr>
    @endforeach
  </table>
</div>
