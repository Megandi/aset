@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Aset
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="active">Daftar Aset</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Aset</h3>
    </div>
    <a style="margin-left:15px;margin-top:5px;" href="#" id="detail" class="btn btn-primary btn-sm mb15"><i class="fa fa-info-circle" >&nbsp;&nbsp;</i>Detail Peralatan</a>

    <div class="box-body">
      <div id="jstree1">
        @foreach($asset as $row)
          <?php
            $cekstatus = 'aman';
            $rowssatu = App\ManajemenAsset::where('parent', $row->id)->get();
            foreach ($rowssatu as $rowsatu) {
              if($rowsatu->status=='0'){
                $cekstatus = 'tidakaman';
              }
              else if($rowsatu->status=='2' && $cekstatus != "tidakaman"){
                $cekstatus = 'tidakamanperbaiki';
              }
              $rowsdua = App\ManajemenAsset::where('parent', $rowsatu->id)->get();
              foreach ($rowsdua as $rowdua) {
                if($rowdua->status=='0'){
                  $cekstatus = 'tidakaman';
                }
                else if($rowdua->status=='2' && $cekstatus != "tidakaman"){
                  $cekstatus = 'tidakamanperbaiki';
                }
                $rowstiga = App\ManajemenAsset::where('parent', $rowdua->id)->get();
                foreach ($rowstiga as $rowtiga) {
                  if($rowtiga->status=='0'){
                    $cekstatus = 'tidakaman';
                  }
                  else if($rowtiga->status=='2' && $cekstatus != "tidakaman"){
                    $cekstatus = 'tidakamanperbaiki';
                  }
                }

              }

            }
          ?>
          <ul>
  					<li onclick="detail({{$row->id}})" id="{!! $row->id !!}"> <font @if($cekstatus=='tidakaman' || $row->status=="0") style="color:red" @elseif($cekstatus=='tidakamanperbaiki' || $row->status=="2") style="color:#f39c12" @endif>{{$row->nama}}</font>
              <?php $rows2 = App\ManajemenAsset::where('parent', $row->id)->where('asset', '0')->get();?>
              @foreach($rows2 as $row2)
                <?php
                  $cekstatus2 = 'aman';
                    $rowsdua2 = App\ManajemenAsset::where('parent', $row2->id)->get();
                    foreach ($rowsdua2 as $rowdua2) {
                      if($rowdua2->status=='0'){
                        $cekstatus2 = 'tidakaman';
                      } else if($rowdua2->status=='2' && $cekstatus2 != "tidakaman"){
                        $cekstatus2 = 'tidakamanperbaiki';
                      }
                      $rowstiga3 = App\ManajemenAsset::where('parent', $rowdua2->id)->get();
                      foreach ($rowstiga3 as $rowtiga3) {
                        if($rowtiga3->status=='0'){
                          $cekstatus2 = 'tidakaman';
                        } else if($rowtiga3->status=='2' && $cekstatus2 != "tidakaman"){
                          $cekstatus2 = 'tidakamanperbaiki';
                        }
                      }

                    }
                ?>
                <ul>
                  <li onclick="detail({{$row2->id}})" id="{!! $row2->id !!}" data-jstree='{"icon" : "glyphicon glyphicon-equalizer"}'> <font @if($cekstatus2=='tidakaman' || $row2->status=="0") style="color:red"  @elseif($cekstatus2=='tidakamanperbaiki' || $row2->status=="2") style="color:#f39c12" @endif>{{$row2->nama}}</font>
                    <?php $rows3 = App\ManajemenAsset::where('parent', $row2->id)->where('asset', '0')->get();?>
                    @foreach($rows3 as $row3)
                      <?php
                        $cekstatus3 = 'aman';
                        $rowstiga3 = App\ManajemenAsset::where('parent', $row3->id)->get();
                        foreach ($rowstiga3 as $rowtiga3) {
                          if($rowtiga3->status=='0'){
                            $cekstatus3 = 'tidakaman';
                          } else if($rowtiga3->status=='2' && $cekstatus3 != "tidakaman"){
                            $cekstatus3 = 'tidakamanperbaiki';
                          }
                        }
                      ?>
                      <ul>
                        <li onclick="detail({{$row3->id}})" data-jstree='{"icon" : "glyphicon glyphicon-home"}' id="{{$row3->id}}"><font @if($cekstatus3=='tidakaman' || $row3->status=="0") style="color:red"  @elseif($cekstatus3=='tidakamanperbaiki' || $row3->status=="2") style="color:#f39c12" @endif>{{$row3->nama}}</font></li>
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

</section>
<!-- /.content -->



<script type="text/javascript">
  $(function() {
    $('#jstree1').jstree();
  });



	$('#jstree1').on("changed.jstree", function (e, data) {
	  var id = data.selected;
	  $("#detail").attr('href','{!! url('list/asset') !!}/' + id);

	});

  // function detail(id) {
	// 	$("#link").attr('href','{!! url('rlist/asset') !!}/' + id);
  //   $('#modal-info').modal();
  // }
</script>
@endsection
