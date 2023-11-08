<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswaData extends Model
{
    use HasFactory;
    protected $fillable = ['nim', 'nama', 'alamat', 'email', 'jurusan'];
    protected $table = 'mahasiswa_data';
    public $timestamps = false;
}
