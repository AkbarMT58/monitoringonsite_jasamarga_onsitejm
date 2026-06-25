<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Existing extends Model
{
    use HasFactory, Sortable;

    protected $table = 'v_backup_database_jm';



    protected $casts = [
        'backup_started_at' => 'datetime',
        'backup_completed_at' => 'datetime'
    ];
}