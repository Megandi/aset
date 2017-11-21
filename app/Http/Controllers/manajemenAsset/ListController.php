<?php

namespace App\Http\Controllers\manajemenAsset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gedung;
use App\Kelas;
use Illuminate\Support\Facades\DB;
use App\Alat;
use App\LogModel;
use File;
use App\ManajemenAsset;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class ListController extends Controller
{

  public function index()
  {
    $asset = ManajemenAsset::where('parent', '0')->where('asset', '0')->get();

    $cekstatus = 'aman';

    return view('manajemenasset.list.index')->with('asset', $asset)
    ->with('cekstatus', $cekstatus);
  }

  public function detail($id)
  {
    //$asset = ManajemenAsset::find($idKelas);
    $gedung = manajemenAsset::find($id);
    $asset = ManajemenAsset::where('parent', $id)->where('asset', '1')->get();
    return view('manajemenasset.list.list_asset')->with('assets', $asset)
                            ->with('parent', $id)
                            ->with('alat', $gedung);
  }

  public function search(Request $request, $idKelas)
  {
    $nama = $request->nama;
    $status = $request->status;
    $ket = $request->keterangan;

    // validate empty
    if($nama == "" && $status == "" && $ket == ""){
        return redirect(url('list/asset/'.$idKelas));
    }
    else
    {
      if($status=='3' || $status==''){
        $status_sc = "";
      } else {
        $status_sc			= " AND status='".$status."'";
      }
      $nama_sc 		= $nama != "" ? " AND nama LIKE '%".$nama."%'" : "";
      $ket_sc 		= $ket != "" ? " AND keterangan LIKE '%".$ket."%'" : "";

      $alat = DB::select("SELECT * FROM manajemen_asset
                  WHERE parent = '".$idKelas."' AND asset ='1'
                  $status_sc $nama_sc $ket_sc ");

      $arraydata = [$nama,$status,$ket];


      return view('manajemenasset.list.list_asset')->with('assets', $alat)
                              ->with('parent', $idKelas)
                              ->with('arraydata', $arraydata);
    }
  }

  public function detailAsset($id)
  {
    $alat = ManajemenAsset::find($id);
    return view('manajemenasset.list.asset_detail')->with('alat', $alat);
  }

  public function update(Request $req)
  {
    $alert = "Berhasil mengubah status!";

      $filename = '';
      if($req->hasFile('fotoaset'))
      {
        $file = $req->fotoaset;
        $filename = str_random(25).'-'.$file->getClientOriginalName();

        $destinationPath = 'imgaset/';
        $file->move($destinationPath, $filename);
      }

      $alat = ManajemenAsset::find($req->alatId);
      $statusawal = $alat->status;
      $alat->status = $req->status;
      $alat->keterangan = $req->keterangan;
      $alat->foto = $filename;
      $alat->user_last_updated = Auth::user()->id;
      $alat->updated_at = date('Y-m-d H:i:s');
      $alat->save();


      /////LogModel
      $log = new LogModel;
      $log->id_aset = $req->alatId;
      $log->id_user = Auth::user()->id;
      $log->waktu = date('Y-m-d H:i:s');
      $log->status_awal = $statusawal;
      $log->status_akhir = $req->status;
      $log->log = "Status aset diperbarui oleh ".Auth::user()->name." pada ".date('Y-m-d H:i:s');
      $log->save();

      if($alat->asset=="0"){
        return redirect(url('list/asset/'.$alat->id))
            ->with('alert', $alert);
      } else {
        return redirect(url('list/asset/'.$req->parentId))
        ->with('alert', $alert);
      }
  }

  public function detailaset($id)
  {
    $alat = ManajemenAsset::find($id);
    return view('manajemenasset.list.aset_realdetail')->with('alat', $alat);
  }

  // public function detailfoto($id)
  // {
  //   $alat = ManajemenAsset::find($id);
  //
  //   $storagePath = public_path('imgaset/'.$alat->foto);
  //
  //   return Image::make($storagePath)->response();
  //
  //   //echo '<img src=\'imgaset/'.$alat->foto.'\' style="width:100%;height:100%;">';
  //   //echo '<td>'.$row->perkiraan['kode_akun'].'</td>';
  // }
}
