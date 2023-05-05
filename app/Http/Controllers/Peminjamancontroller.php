<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Peminjamancontroller extends Controller
{
    // get id
    public function getPeminjamanId(Request $req, $id_peminjaman)
    {
        $dt_peminjaman = peminjaman::select('nama_siswa', 'nama_kelas', 'judul_buku')
            ->join('siswa', 'siswa.id_siswa', '=', 'peminjaman.id_siswa')
            ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->where('peminjaman.id_peminjaman', '=', $id_peminjaman)
            ->get();
        return response()->json($dt_peminjaman);
    }
    // get all
    public function getpeminjaman()
    {
        $dt_pinjam = peminjaman::
        // select('nama_siswa', 'nama_kelas', 'judul_buku')
            // ->
            join('siswa', 'siswa.id_siswa', '=', 'peminjaman.id_siswa')
            ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->get();
        return response()->json($dt_pinjam);
    }

    public function getid(){
        $get = peminjaman::select('id_peminjaman')->orderBy('id_peminjaman','desc')->first();
            return response()->json($get);
    }
    // add
    public function createPeminjaman(Request $req)
    {
        $validator = Validator::make($req->All(), [
            // 'id_siswa' => 'required',
            'id_buku' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = Peminjaman::create([
            'id_siswa' => $req->get('id_siswa'),
            'id_buku' => $req->get('id_buku'),
        ]);
        if ($save) {
            return response()->json(['status' => true, 'massage' => 'Sukses Pinjam']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Pinjam']);
        }
    }
    // delete
    public function deletePeminjaman($id_peminjaman)
    {
        $hapus = peminjaman::where('id_peminjaman', $id_peminjaman)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'massage' => 'Sukses Delete buku']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal Delete buku']);
        }
    }
}
