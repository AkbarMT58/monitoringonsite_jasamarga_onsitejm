<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class List_Absent extends Model
{
    use HasFactory, Sortable;

    protected $table = 'v_list_absent';

    protected $fillable = [
       
        'date',
        'waktu_cetak'
    ];

   
 

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'date';
    }
}
