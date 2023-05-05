<?php

namespace App\Http\Controllers;

use App\models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Siswacontroller extends Controller
{
    // get all
    public function getSiswa()
    {
        $dt_siswa=Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')->get();
        return response()->json($dt_siswa);
    }
    // get id
    public function getSiswaId($id_siswa)
    {
        $dt_siswa=Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->where('siswa.id_siswa','=',$id_siswa)
        ->get();
        return response()->json($dt_siswa);
    }
    // create/add
    public function createSiswa(Request $req)
    {
        $validator = Validator::make($req->All(), [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'id_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = siswa::create([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'id_kelas' => $req->get('id_kelas'),
        ]);
        if ($save) {
            return response()->json(['status' => true, 'massage' => 'Sukses Menambahkan Siswa']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Menambahkan Siswa']);
        }
    }
    // update
    public function updateSiswa(Request $req, $id_siswa)
    {
        $validator = Validator::make($req->all(), [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'id_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = siswa::where('id_siswa', $id_siswa)->update([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'id_kelas' => $req->get('id_kelas'),
        ]);
        if ($ubah) {
            return response()->json(['status' => true, 'massage' => 'Sukses Mengubah Data Siswa']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Mengubah Data Siswa']);
        }
    }
    // delete
    public function deletesiswa($id_siswa)
    {
        $hapus = siswa::where('id_siswa', $id_siswa)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'massage' => 'Sukses Delete Siswa']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Delete Siswa']);
        }
    }
}
