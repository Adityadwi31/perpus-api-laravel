<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Bukucontroller extends Controller
{
    // get id
    public function getBukuId(Request $req, $id_buku)
    {
        $dt_buku = buku::
            where('id_buku', '=', $id_buku)
            ->get();
        return response()->json($dt_buku);
    }
    // get all
    public function getBuku()
    {
        $dt_buku = buku::get();
        return response()->json($dt_buku);
    }
    // add
    public function createBuku(Request $req)
    {
        $validator = Validator::make($req->All(), [
            'judul_buku' => 'required',
            'pengarang' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = buku::create([
            'judul_buku' => $req->get('judul_buku'),
            'pengarang' => $req->get('pengarang'),
        ]);
        if ($save) {
            return response()->json(['status' => true, 'massage' => 'Sukses Menambahkan Buku']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Menambahkan Buku']);
        }
    }
    // update
    public function updateBuku(Request $req, $id_buku)
    {
        $validator = Validator::make($req->all(), [
            'judul_buku' => 'required',
            'pengarang' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = buku::where('id_buku', $id_buku)->update([
            'judul_buku' => $req->get('judul_buku'),
            'pengarang' => $req->get('pengarang'),
        ]);
        if ($ubah) {
            return response()->json(['status' => true, 'massage' => 'Sukses Mengubah Data Buku']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Mengubah Data Buku']);
        }
    }
    // delete
    public function deleteBuku($id_buku)
    {
        $hapus = buku::where('id_buku', $id_buku)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'massage' => 'Sukses Delete buku']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Delete buku']);
        }
    }
}
