<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class DataSignatures extends Model
{
    use HasFactory, Sortable;

      protected $table = 'data_signatures';

      

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }



    protected $fillable = [
          
      
        'created_at' //must be present
]  ;





}
