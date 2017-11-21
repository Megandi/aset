<?php

namespace App\Http\Controllers\manajemenAsset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManajemenAsset;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class manajemenAssetController extends Controller
{
    public function dashboard()
    {
      $perbaikanAlat = ManajemenAsset::where('status', '2')->count();
      $totalAlat = ManajemenAsset::count();
      $alatRusak = ManajemenAsset::where('status', '0')->count();
      $alatBaik = ManajemenAsset::where('status', '1')->count();
      return view('manajemenasset.dashboard')->with('perbaikanAlat', $perbaikanAlat)
                            ->with('totalAlat', $totalAlat)
                            ->with('alatRusak', $alatRusak)
                            ->with('alatBaik', $alatBaik);
    }

    public function index()
    {
      $asset = ManajemenAsset::where('parent', '0')->where('asset', '0')->get();

      return view('manajemenasset.manajemen.index')->with('asset', $asset);
    }

    public function load($id)
    {
      $asset = manajemenAsset::find($id);
      $peralatan = ManajemenAsset::where('parent', $id)->where('asset', '1')->get();
      return view('manajemenasset.manajemen.tableperalatan')->with('peralatan', $peralatan)
                                                        ->with('asset', $asset);
    }

    public function add()
    {
      return view('manajemenasset.manajemen.tambah');
    }

    public function save(Request $req)
    {
      $alert = "Berhasil menambahkan!";

      $kelas = new ManajemenAsset;
      $kelas->nama = $req->nama;
      $kelas->keterangan = $req->keterangan;
      $kelas->status = $req->status;
      $kelas->asset = $req->asset;
      if($req->inputIdDibawah=='Top'){
        $kelas->parent = '0';
      } else {
        $kelas->parent = $req->inputIdDibawah;
      }
      $kelas->save();

      return redirect(url('manajemenasset'))
          ->with('alert', $alert);
    }

    public function hapus($id)
    {
      $alert = "Berhasil menghapus!";

      $alat = ManajemenAsset::where('parent', $id)->delete();
      ManajemenAsset::destroy($id);

      return redirect(url('manajemenasset'))
          ->with('alert', $alert);
    }

    public function jscari()
    {
      $row_set = [];
      $term = strip_tags(trim($_GET['q']));


      $lantai = DB::table('manajemen_asset')->where('nama', 'like', '%'.$term.'%')->where('asset', '0')->get();

      $query = $lantai;

      if(sizeof($query) > 0){
          foreach ($query as $row){
            $parent = ManajemenAsset::find($row->parent);

            $new_row['id']=htmlentities(stripslashes($row->id));
            if($parent){
              $new_row['text']=htmlentities(stripslashes($row->nama . " - ". $parent->nama));
            } else {
              $new_row['text']=htmlentities(stripslashes($row->nama . " - TOP"));
            }
            $row_set[] = $new_row; //build an array
          }

      }

      $new_row['id']="Top";
      $new_row['text']="Top";
      $row_set[] = $new_row;

      return json_encode($row_set); //format the array into json data

    }

    public function edit($id)
    {
      $asset = ManajemenAsset::find($id);
      if($asset->parent==0){
        $parent = "TOP";
      } else {
        $parent = ManajemenAsset::find($asset->parent);
        $parentlagi = ManajemenAsset::find($parent->parent);
        if($parentlagi){
          $parent = $parent->nama ." - ".$parentlagi->nama;
        } else {
          $parent = $parent->nama;
        }
      }

      return view('manajemenasset.manajemen.edit')->with('asset', $asset)
                                                  ->with('parent', $parent);
    }

    public function editsave(Request $req)
    {
      $alert = "Berhasil mengubah!";

      $kelas = ManajemenAsset::find($req->id);
      $kelas->nama = $req->nama;
      $kelas->keterangan = $req->keterangan;
      $kelas->status = $req->status;
      $kelas->asset = $req->asset;
      if($req->inputIdDibawah=='Top'){
        $kelas->parent = '0';
      } else {
        $kelas->parent = $req->inputIdDibawah;
      }
      $kelas->save();

      return redirect(url('manajemenasset'))
          ->with('alert', $alert);
    }

    public function import()
    {
      return view('manajemenasset.manajemen.import');
    }

    public function importsample()
    {
      Excel::create("import_aset_sample", function($result)
      {
        $result->sheet('aset', function($sheet)
        {
          $sheet->fromArray(array(
              array('1', '0', 'GRIYA LEGITA', '1', 'keterangan aset', '0'),
              array('2', '0', 'REKTORAT', '1', 'keterangan aset', '0'),
              array('3', '1', 'Lantai 1 GL', '1', 'keterangan aset', '0'),
              array('4', '1', 'Lantai 2 GL', '1', 'keterangan aset', '0'),
              array('5', '2', 'Lift Rektorat', '1', 'keterangan aset', '1'),
              array('6', '3', 'AC LOBBY GL', '1', 'keterangan aset', '1'),
          ), null, 'A2', false, false);
          $sheet->row(1, array('ID', 'PARENT', 'NAMA', 'STATUS', 'KETERANGAN', 'JENIS_ASET'));

          $sheet->setBorder('A1:F1', 'thin');
          $sheet->cells('A1:F1', function($cells){
              $cells->setBackground('#0070c0');
              $cells->setFontColor('#ffffff');
              $cells->setValignment('center');
              $cells->setAlignment('center');
              $cells->setFontSize('11');
          });
          $sheet->setHeight(array(
              '1' => '20',
              '2' => '15',
              '3' => '15',
              '4' => '15',
              '5' => '15',
              '6' => '15',
              '7' => '15',
          ));
          $sheet->setWidth('A', '5');
          $sheet->setWidth('B', '7');
          $sheet->setWidth('C', '20');
          $sheet->setWidth('D', '7');
          $sheet->setWidth('E', '20');
          $sheet->setWidth('F', '10');
        });
        return redirect(url('manajemenasset/import'));
      })->download('xls');
    }

    public function importsave(Request $request)
    {
      if ($request->hasFile('import'))
        {
            $file     = $request->import;
            $filename = $file->getClientOriginalName();

            $destinationPath = 'imgaset/';
            $file->move($destinationPath, $filename);

        }

        $xls = explode(".", $filename);

        if ($xls[1] == "xls" || $xls[1] == "csv") {
          ManajemenAsset::truncate();
          $result = Excel::load('public/imgaset/'.$filename)->get();
          foreach ($result as $row) {
            $aset = new manajemenAsset;
            $aset->id = $row->id;
            $aset->parent = $row->parent;
            $aset->nama = $row->nama;
            $aset->status = $row->status;
            $aset->keterangan = $row->keterangan;
            $aset->asset = $row->jenis_aset;
            $aset->user_last_updated = Auth::user()->id;
            $aset->updated_at = date('Y-m-d H:i:s');
            $aset->save();
          }


          $alert = "Berhasil dalam import data!";
        } else {
          $alert = "Gagal dalam import data!";
        }
        unlink('imgaset/'.$filename);
        return redirect(url('manajemenasset/import'))
            ->with('alert', $alert);
    }

    public function export()
    {
      $date = date('Y-m-d H:i:s');
      $aset = ManajemenAsset::all();
      Excel::create("Export_Asset-".$date, function($result) use($aset)
      {
        $result->sheet('aset', function($sheet) use($aset)
        {
          $i = 0;
          foreach ($aset as $asset) {
            if($asset->parent=='0'){
              $parent = '0';
            } else {
              $parent = $asset->parent;
            }

            if($asset->status=='0'){
              $status = '0';
            } else {
              $status = $asset->status;
            }

            if($asset->asset=='0'){
              $jenis = '0';
            } else {
              $jenis = $asset->asset;
            }
            $data=[];
            array_push($data, array(
                $asset->id,
                $parent,
                $asset->nama,
                $status,
                $asset->keterangan,
                $jenis
            ));
            $sheet->fromArray($data, null, 'A2', false, false);
            $i++;
          }
          $sheet->row(1, array('ID', 'PARENT', 'NAMA', 'STATUS', 'KETERANGAN', 'JENIS_ASET'));

          $sheet->setBorder('A1:F1', 'thin');
          $sheet->cells('A1:F1', function($cells){
              $cells->setBackground('#0070c0');
              $cells->setFontColor('#ffffff');
              $cells->setValignment('center');
              $cells->setAlignment('center');
              $cells->setFontSize('11');
          });
          $sheet->setHeight(array(
              '1' => '20',
          ));
          for($k=1;$k<=$i;$k++){
            $sheet->setHeight(array(
                $k+1 => '15',
            ));
          }
          $sheet->setWidth('A', '5');
          $sheet->setWidth('B', '7');
          $sheet->setWidth('C', '20');
          $sheet->setWidth('D', '7');
          $sheet->setWidth('E', '20');
          $sheet->setWidth('F', '10');
        });
        return redirect(url('manajemenasset/import'));
      })->download('xls');
    }
}
