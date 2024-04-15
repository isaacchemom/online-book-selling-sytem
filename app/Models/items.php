<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;



    protected $table='items';
    protected $primaryKey='id';
    protected $fillable = ['title','class','price','category_id','file_path','desc','file_name'];

    

    // Item.php
public function categories()
{
    return $this->belongsTo(categories::class,'category_id');
}



public function transactions()
{
    return $this->hasMany(transactions::class,'id');
}

}
