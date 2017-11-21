<?php

namespace App\Http\Controllers\manajemenUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\levelType;
use Auth;

class manajemenUserController extends Controller
{
    public function index()
    {
      $user = User::all();
      return view('manajemenuser.index')->with('user', $user);
    }

    public function add()
    {
      $leveltype = leveltype::all();
      return view('manajemenuser.tambah')->with('leveltype', $leveltype);
    }

    public function save(Request $req)
    {
      $alert = "Berhasil menambahkan!";
      $user = new User;
      $user->name = $req->nama;
      $user->username = $req->emailinput;
      $user->email = $req->username;
      $user->password = bcrypt($req->passwordinput);
      $user->status = '1';
      $user->id_level = $req->level;
      $user->save();
      return redirect(url('manajemenuser'))
          ->with('alert', $alert);
    }

    public function delete($id)
    {
      User::destroy($id);
      $alert = "Berhasil menghapus!";

      return redirect(url('manajemenuser'))
          ->with('alert', $alert);

    }

    public function edit($id)
    {
      $leveltype = leveltype::all();
      $user = User::find($id);
      return view('manajemenuser.edit')->with('user', $user)
                                      ->with('leveltype', $leveltype);
    }

    public function ubahsave(Request $req)
    {
      $alert = "Berhasil mengubah!";
      $user = User::find($req->id);
      $user->name = $req->nama;
      $user->username = $req->emailinput;
      $user->email = $req->username;
      if($req->passwordinput!="megandi"){
        $user->password = bcrypt($req->passwordinput);
      }
      $user->status = '1';
      $user->id_level = $req->level;
      $user->save();
      return redirect(url('manajemenuser'))
          ->with('alert', $alert);
    }

    public function ubahsendiri()
    {
      //$leveltype = leveltype::all();
      $user = User::find(Auth::user()->id);
      return view('manajemenuser.edititself')->with('user', $user);
    }

    public function ubahsaveitself(Request $req)
    {
      $alert = "Berhasil mengubah!";
      $user = User::find($req->id);
      $user->name = $req->nama;
      $user->username = $req->emailinput;
      $user->email = $req->username;
      if($req->passwordinput!="megandi"){
        $user->password = bcrypt($req->passwordinput);
      }
      $user->status = '1';
      $user->save();
      return redirect(url('/'))
          ->with('alert', $alert);
    }
}
