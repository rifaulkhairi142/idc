<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'kode_universitas', 'kode_idc', 'kode_jenis_surat', 'bulan_tahun'];

    protected $table = 'sertifikat_tbl';
}
