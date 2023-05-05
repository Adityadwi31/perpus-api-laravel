<?php

namespace App\Http\Controllers;

use App\models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Kelascontroller extends Controller
{
    // get id
    public function getKelasId(Request $req, $id_kelas)
    {
        $dt_kelas = kelas::
            where('kelas.id_kelas', '=', $id_kelas)
            ->get();
        return response()->json($dt_kelas);
    }
    // get all
    public function getKelas()
    {
        $dt_kelas = kelas::get();
        return response()->json($dt_kelas);
    }
    // create/add
    public function createKelas(Request $req)
    {
        $validator = Validator::make($req->All(), [
            'nama_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = kelas::create([
            'nama_kelas' => $req->get('nama_kelas'),
        ]);
        if ($save) {
            return response()->json(['status' => true, 'massage' => 'Sukses Menambahkan Kelas']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Menambahkan Kelas']);
        }
    }
    // update
    public function updateKelas(Request $req, $id_kelas)
    {
        $validator = Validator::make($req->all(), [
            'nama_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = kelas::where('id_kelas', $id_kelas)->update([
            'nama_kelas' => $req->get('nama_kelas'),
        ]);
        if ($ubah) {
            return response()->json(['status' => true, 'massage' => 'Sukses Mengubah Data Kelas']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Mengubah Data Kelas']);
        }
    }
    // delete
    public function deleteKelas($id_Kelas)
    {
        $hapus = Kelas::where('id_kelas', $id_Kelas)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'massage' => 'Sukses Delete Kelas']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Delete Kelas']);
        }
    }
}
