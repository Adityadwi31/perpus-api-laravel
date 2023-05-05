<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "peminjaman";
    protected $primaryKey = "id_peminjaman";
    protected $fillable = ['id_siswa','id_buku'];
}
