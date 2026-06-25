<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class BackupHistory extends Model
{
    use HasFactory, Sortable;

    protected $table = 'backup_histories';


    protected $fillable = [
        'app_id',
        'backup_name',
        'backup_path',
        'file_size',
        'status',
        'error_message',
        'backup_started_at',
        'backup_completed_at',
        'backup_duration_seconds'
    ];

    protected $casts = [
        'backup_started_at' => 'datetime',
        'backup_completed_at' => 'datetime'
    ];
}