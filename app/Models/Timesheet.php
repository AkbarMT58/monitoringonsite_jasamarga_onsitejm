<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Timesheet extends Model
{
    use HasFactory, Sortable;

    protected $table = 'timesheet_work';



    protected $fillable = [
        
        'created_at' //must be present
]  ;



 

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    
}
