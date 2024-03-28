<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Quy uoc ten table 
    // Ten model là Post => ten table laf posts
    // Ten model là ProductCategory => ten table la product_categories

    
    protected $table = 'posts';
//Quy uoc khoa chinh, mac dinh laravel se lay field id lam khoa chinh
    protected $primaryKey = 'id';
    
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = true;
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    protected $attribute = [
        'status' => 0
    ];
}
