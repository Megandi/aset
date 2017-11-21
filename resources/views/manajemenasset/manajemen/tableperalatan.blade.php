<table class="table">
  <tr>
    <td style="width:10%"> Nama</td>
    <td style="width:5%">:</td>
    <td style="width:80%">{{$asset->nama}}</td>
  </tr>
  <tr>
    <td style="width:10%"> Sub Aset</td>
    <td style="width:5%">:</td>
    @if($asset->parent=="0")
      <td style="width:80%">Top</td>
    @else
      <?php $parent = App\ManajemenAsset::find($asset->parent); ?>
      <td style="width:80%">{{$parent->nama}}</td>
    @endif
  </tr>
  <tr>
    <td style="width:10%"> Keterangan</td>
    <td style="width:5%">:</td>
    <td style="width:80%">{{$asset->keterangan}}</td>
  </tr>
</table>

<table class="table">
  <tr>
    <th style="width: 10px">No.</th>
    <th>Nama Peralatan</th>
    <th>Aksi</th>
  </tr>
  <?php $i=1; ?>
  @if($peralatan->isEmpty())
    <tr>
      <td colspan="3"><center>Tidak ada daftar peralatan</center></td>
    </tr>
  @else
    @foreach($peralatan as $row)
    <tr>
      <td>{{$i++}}.</td>
      <td>{{$row->nama}}</td>
      <td>
        <a href="{{url('manajemenasset/edit/'.$row->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
        <a href="{{url('manajemenasset/hapus/'.$row->id)}}" onclick="return confirm('Are you sure you want to delete this data ?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
    @endforeach
  @endif
</table>
