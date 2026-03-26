<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TK extends Model
{
    use HasFactory, Sortable;

    protected $table = 'tk';



    protected $fillable = [
          
      
        'created_at' //must be present
]  ;



 

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    
}
