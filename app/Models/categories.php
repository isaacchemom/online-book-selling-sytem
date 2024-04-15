<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    
    protected $table='categories';
    protected $primaryKey='id';
    protected $fillable = [
        'name',
        'description',
         
        // Add more columns here...
    ];


    public function items()
{
    return $this->hasMany(items::class,'id');
}


}
