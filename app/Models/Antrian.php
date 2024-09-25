<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    // Definisikan nama tabel jika berbeda dengan konvensi Laravel

    use HasFactory;
    protected $table = 'antrians';

    protected $primaryKey = 'antrian_id';
    protected $fillable = [
        'nomor_antrian', 
        'status_sidang', 
        'jadwal_sidang', 
        'user_id', 
        'jenis_sidang_id'
    ];

    // Relasi ke model User
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke model JenisSidang
    public function jenis_sidang()
    {
        return $this->belongsTo(JenisSidang::class, 'jenis_sidang_id', 'jenis_sidang_id');
    }
}