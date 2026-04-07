<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mockery\Undefined;

class category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
    protected $fillable = [
        'category_id', 
        'category_name'
        ];

public function products()
{
    return $this->hasMany(product::class, 'category_id', 'category_id'); 
}

}