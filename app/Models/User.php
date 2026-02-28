<?php

namespace App\Models;

// Import class yang dibutuhkan untuk Autentikasi
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Pastikan mengarah ke tabel kustom kamu
    protected $table = 'tuser';

    /**
     * Atribut yang dapat diisi (Mass Assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi (Keamanan)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+ otomatis menghandle hashing
    ];
}