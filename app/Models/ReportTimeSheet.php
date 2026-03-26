<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ReportTimeSheet extends Model
{
    use HasFactory, Sortable;

    protected $table = 'report_timesheet';



    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    
}
