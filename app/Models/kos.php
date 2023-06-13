<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class kos extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama_kos',
        'alamat',
        'biaya',
        'nomor',
        'nomor_alt',
        'ukuran',
        'fasilitas',
        'peraturan',
        'penghuni',
        'f_depan',
        'f_samping',
        'f_kamar_1',
        'f_kamar_2',
        'f_kamar_3',
        'status',
        'created_at',
        'updated_at',
    ];
}