<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use App\Lantai;
use App\Alat;
use App\Kelas;
use Illuminate\Support\Facades\DB;

class masterController extends Controller
{
    public function indexGedung()
    {
      $gedungs = Gedung::all();
      return view('master.gedung')->with('gedungs', $gedungs);
    }

    public function saveGedung(Request $req)
    {
      $alert = "Berhasil menambahkan gedung!";

      $gedung = new Gedung;
      $gedung->nama = $req->namaGedung;
      $gedung->save();

      return redirect(url('master/gedung'))
          ->with('alert', $alert);
    }

    public function hapusGedung($id)
    {
      $alert = "Berhasil menghapus gedung!";

      $gedung = Gedung::find($id);
      $lantai = Lantai::where('id_gedung', $gedung->id)->get();
      foreach ($lantai as $lantaii) {
        $kelas = Kelas::where('id_lantai', $lantaii->id)->get();
        foreach ($kelas as $kelass) {
          $alat = Alat::where('id_kelas', $kelass->id)->delete();
        }
        Kelas::where('id_lantai', $lantaii->id)->delete();
      }
      Lantai::where('id_gedung', $gedung->id)->delete();
      Gedung::destroy($id);

      return redirect(url('master/gedung'))
          ->with('alert', $alert);
    }




    public function indexLantai()
    {
      $gedungs = Gedung::all();
      $lantais = lantai::all();
      return view('master.lantai')->with('lantais', $lantais)
                                  ->with('gedungs', $gedungs);
    }

    public function saveLantai(Request $req)
    {
      $alert = "Berhasil menambahkan lantai!";

      $lantai = new Lantai;
      $lantai->nama = $req->namaLantai;
      $lantai->id_gedung = $req->idGedung;
      $lantai->save();

      return redirect(url('master/lantai'))
          ->with('alert', $alert);
    }

    public function hapusLantai($id)
    {
      $alert = "Berhasil menghapus gedung!";

      $lantai = Lantai::find($id);
      $kelas = Kelas::where('id_lantai', $lantai->id)->get();
      foreach ($kelas as $kelass) {
        $alat = Alat::where('id_kelas', $kelass->id)->delete();
      }
      Kelas::where('id_lantai', $lantai->id)->delete();
      Lantai::destroy($id);

      return redirect(url('master/lantai'))
          ->with('alert', $alert);
    }



    public function indexKelas()
    {
      $gedungs = Gedung::all();
      $lantais = lantai::all();
      $kelass = Kelas::all();
      return view('master.kelas')->with('lantais', $lantais)
                                  ->with('kelass', $kelass)
                                  ->with('gedungs', $gedungs);
    }

    public function carilantai()
    {
      $row_set = [];
      $term = strip_tags(trim($_GET['q']));
      $idgedung = strip_tags(trim($_GET['idgedung']));


      $lantai = DB::table('lantai')->where('id_gedung',$idgedung)->where('nama', 'like', '%'.$term.'%')->get();

      $query = $lantai;

      if(sizeof($query) > 0){
          foreach ($query as $row){
            $new_row['id']=htmlentities(stripslashes($row->id));
              $new_row['text']=htmlentities(stripslashes($row->id ." - ".$row->nama));
              $row_set[] = $new_row; //build an array
          }

      }
      return json_encode($row_set); //format the array into json data

    }

    public function saveKelas(Request $req)
    {
      $alert = "Berhasil menambahkan kelas!";

      $kelas = new Kelas;
      $kelas->nama = $req->namaKelas;
      $kelas->id_lantai = $req->inputIdLantai;
      $kelas->save();

      return redirect(url('master/kelas'))
          ->with('alert', $alert);
    }

    public function hapusKelas($id)
    {
      $alert = "Berhasil menghapus kelas!";

      $kelas = Kelas::find($id);
      $alat = Alat::where('id_kelas', $kelass->id)->delete();
      Kelas::destroy($id);

      return redirect(url('master/kelas'))
          ->with('alert', $alert);
    }




    public function indexAsset()
    {
      $gedungs = Gedung::all();
      $lantais = lantai::all();
      $kelass = Kelas::all();
      $assets = Alat::all();
      return view('master.asset')->with('lantais', $lantais)
                                  ->with('kelass', $kelass)
                                  ->with('assets', $assets)
                                  ->with('gedungs', $gedungs);
    }

    public function carikelas()
    {
      $row_set = [];
      $term = strip_tags(trim($_GET['q']));
      $idlantai = strip_tags(trim($_GET['idlantai']));


      $kelas = DB::table('kelas')->where('id_lantai',$idlantai)->where('nama', 'like', '%'.$term.'%')->get();

      $query = $kelas;

      if(sizeof($query) > 0){
        foreach ($query as $row){
          $new_row['id']=htmlentities(stripslashes($row->id));
          $new_row['text']=htmlentities(stripslashes($row->id ." - ".$row->nama));
          $row_set[] = $new_row; //build an array
        }
      }

      return json_encode($row_set); //format the array into json data

    }

    public function saveAsset(Request $req)
    {
      $alert = "Berhasil menambahkan asset!";

      $kelas = new Alat;
      $kelas->nama = $req->namaAsset;
      $kelas->id_kelas = $req->inputIdKelas;
      $kelas->keterangan = '';
      $kelas->status = '1';
      $kelas->save();

      return redirect(url('master/asset'))
          ->with('alert', $alert);
    }

    public function hapusAsset($id)
    {
      $alert = "Berhasil menghapus asset!";

      Alat::destroy($id);

      return redirect(url('master/asset'))
          ->with('alert', $alert);
    }
}
