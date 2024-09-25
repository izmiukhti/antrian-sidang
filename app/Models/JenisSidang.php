<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JenisSidang extends Model
{
    use HasFactory;

    protected $table = 'jenis_sidangs';
    protected $primaryKey = 'jenis_sidang_id';
    protected $fillable = [
        'jenis_sidang_id',
        'nama_jenis_sidang'
    ];

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'jenis_sidang_id', 'jenis_sidang_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
}