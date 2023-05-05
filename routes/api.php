<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Siswacontroller;
use App\Http\Controllers\Kelascontroller;
use App\Http\Controllers\Bukucontroller;
use App\Http\Controllers\Peminjamancontroller;
use App\Http\Controllers\Detailcontroller;
use App\Http\Controllers\Usercontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// JWT
Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class,'login']);




Route::group(['middleware' =>['jwt.verify']],function () {
    
    // siswa
    Route::get('/getSiswa',[Siswacontroller::class,'getsiswa']);
    Route::get('/getSiswaId/{id_siswa}',[Siswacontroller::class,'getsiswaId']);
    Route::post('/createSiswa',[Siswacontroller::class , 'createsiswa']);
    Route::put('/updateSiswa/{id_siswa}',[Siswacontroller::class , 'updatesiswa']);
    Route::delete('/deleteSiswa/{id_siswa}',[Siswacontroller::class , 'deletesiswa']);
    
    // kelas
    Route::get('/getKelasId/{id_buku}',[Kelascontroller::class,'getkelasId']);
    Route::get('/getKelas',[kelascontroller::class,'getkelas']);
    Route::post('/createKelas',[kelascontroller::class,'createkelas']);
    Route::put('/updateKelas/{id_kelas}',[Kelascontroller::class , 'updateKelas']);
    Route::delete('/deleteKelas/{id_kelas}',[Kelascontroller::class , 'deleteKelas']);
    
    // buku
    Route::get('/getBukuId/{id_buku}',[Bukucontroller::class,'getbukuId']);
    Route::get('/getBuku',[Bukucontroller::class, 'getBuku']);
    Route::post('/createBuku',[Bukucontroller::class, 'createBuku']);
    Route::put('/updateBuku/{id_buku}',[Bukucontroller::class, 'updateBuku']);
    Route::delete('/deleteBuku/{id_buku}',[Bukucontroller::class , 'deleteBuku']);
    
    // peminjaman
    Route::get('/getPeminjamanId/{id_peminjaman}',[Peminjamancontroller::class,'getpeminjamanId']);
    Route::get('/getPeminjaman',[Peminjamancontroller::class, 'getPeminjaman']);
    Route::post('/createPeminjaman',[Peminjamancontroller::class, 'createPeminjaman']);
    Route::put('/updatePeminjaman/{id_peminjaman}',[Peminjamancontroller::class, 'updatePeminjaman']);
    Route::delete('/deletePeminjaman/{id_peminjaman}',[Peminjamancontroller::class , 'deletePeminjaman']);
    Route::get('/getid',[Peminjamancontroller::class , 'getid']);
    
    // detail_peminjaman
    Route::get('/getDetailId/{id_detail}',[Detailcontroller::class,'getdetailId']);
    Route::get('/getDetail',[Detailcontroller::class, 'getDetail']);
    Route::post('/createDetail',[Detailcontroller::class, 'createDetail']);
    
    // pengembalian
    Route::put('/pengembalian/{id}',[Detailcontroller::class, 'updateDetail']);
    
    
});


?>