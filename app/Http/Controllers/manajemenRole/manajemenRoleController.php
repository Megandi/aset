<?php

namespace App\Http\Controllers\manajemenRole;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\levelType;
use App\levelAkses;
use View;

class manajemenRoleController extends Controller
{
    public function __construct()
    {
      View::share(['menu' => '4']);
    }

    public function index()
    {
      $level = levelType::all();
      return view('manajemenrole.index')->with('level', $level);
    }

    public function add()
    {
      return view('manajemenrole.tambah');
    }

    public function save(Request $req)
    {
      $alert = "Berhasil disimpan!";
      $type = new levelType;
      $type->name = $req->nama;
      $type->save();

      for($i=1;$i<=7;$i++){
        $level = new levelAkses;
        $level->id_level = $type->id;
        $level->id_menu = $i;
        $level->r = '0';
        $level->save();
      }

      return redirect(url('manajemenrole'))
          ->with('alert', $alert);
    }

    public function delete($id)
    {
      levelAkses::where('id_level', $id)->delete();
      levelType::destroy($id);
      $alert = "Berhasil menghapus!";

      return redirect(url('manajemenrole'))
          ->with('alert', $alert);

    }

    public function setmenu($id)
    {
      $leveltype = leveltype::find($id);
      $levelakses = levelakses::where('id_level', $id)->get();
      return view('manajemenrole.setmenu')->with('levelakses', $levelakses)
                                          ->with('id_level', $id)
                                          ->with('leveltype', $leveltype);
    }

    public function ubahnama(Request $req)
    {
      $leveltype = leveltype::find($req->id);
      $leveltype->name = $req->nama;
      $leveltype->save();
      $alert = "Berhasil mengubah!";

      return redirect(url('manajemenrole'))
          ->with('alert', $alert);

    }

    public function update(Request $req)
    {
      $alert = "Berhasil disimpan!";
      $levelakses = levelakses::where('id_level', $req->id_level)->get();
      levelakses::where('id_level',$req->id_level)->delete();

      foreach ($levelakses as $item) {
        $level = new levelAkses;
        $level->id_level = $req->id_level;
        $level->id_menu = $item->id_menu;
        $level->r = $req->has('read_'.$item->id_menu)?1:0;
        $level->save();
      }

      return redirect(url('manajemenrole'))
          ->with('alert', $alert);

    }


}
