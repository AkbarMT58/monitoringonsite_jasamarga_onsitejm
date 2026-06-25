<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class DaftarWebJM extends Model
{
    use HasFactory, Sortable;

    protected $table = 'daftar_web_jm';

    protected $fillable = [
        'id',
        'name_web',
        'name_database',
        'host',
        'username',
        'port',
        'password',
        'status',
        'created_at',
        'updated_at'
    ];

   protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
   ];
 
}