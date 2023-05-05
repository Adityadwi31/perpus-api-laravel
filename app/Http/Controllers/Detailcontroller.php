<?php

namespace App\Http\Controllers;

use App\Models\detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class Detailcontroller extends Controller
{
    // get id
    public function getDetailId(Request $req, $id_detail)
    {
        $dt_detail = detail::
        // select('nama_siswa', 'nama_kelas', 'judul_buku', 'tgl_pinjam', 'tgl_kembali', 'status')
        //     ->
            join('peminjaman', 'peminjaman.id_peminjaman', '=', 'detail_peminjaman.id_peminjaman')
            ->join('siswa', 'siswa.id_siswa', '=', 'peminjaman.id_siswa',)
            ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->where('detail_peminjaman.id_detail', '=', $id_detail)
            ->get();
        return response()->json($dt_detail);
    }
    // get all
    public function getDetail()
    {
        $dt_detail = detail::   join('peminjaman', 'peminjaman.id_peminjaman', '=', 'detail_peminjaman.id_peminjaman')
            ->join('siswa', 'siswa.id_siswa', '=', 'peminjaman.id_siswa',)
            ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->
            get();
        return response()->json($dt_detail);
    }
    // add
    public function createDetail(Request $req)
    {
        $validator = Validator::make($req->All(), [
            'id_peminjaman' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $pinjam = carbon::now();
        $kembali = carbon::now()->addDay(5);

        $save = detail::create([
            'id_peminjaman' => $req->get('id_peminjaman'),
            'tgl_pinjam' => $pinjam,
            'tgl_kembali' => $kembali,
            'status' => 'dipinjam'
        ]);
        if ($save) {
            return response()->json(['status' => true, 'massage' => 'Sukses menambahkan Detail Peminjaman']);
        } else {
            return response()->json(['status' => true, 'massage' => 'Gagal menambahkan Detail Peminjaman']);
        }
    }
    public function updateDetail($id)
    {
        $kembali = detail::where('id_detail','=', $id)
        ->update([
            'status' => 'kembali',
        ]);
        if ($kembali) {
            return response()->json(['status' => true, 'massage' => 'Sukses ubah status']);
        } else {
            return response()->json(['status' => false, 'massage' => 'Gagal,cek id lagi bro']);
        }
    }
}
