<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class brand extends Model
{
    use HasFactory;
    
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    public $timestamps = true;
    protected $fillable = [
        'brand_id',
        'nama_brand'
    ];

    public function products()
    {
        return $this->hasMany(product::class, 'brand_id', 'brand_id');
    }
}
