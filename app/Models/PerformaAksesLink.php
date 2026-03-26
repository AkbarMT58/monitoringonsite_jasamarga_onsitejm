<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PerformaAksesLink extends Model
{
    use HasFactory, Sortable;

    protected $table = 'performa_akses_link';


 

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'date';
    }
}
