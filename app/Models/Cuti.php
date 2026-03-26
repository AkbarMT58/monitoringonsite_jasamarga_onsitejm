<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Cuti extends Model
{
    use HasFactory, Sortable;

      protected $table = 'pengajuan_cuti_onsite';

      

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }



    protected $fillable = [
          
      
        'created_at' //must be present
]  ;





}
