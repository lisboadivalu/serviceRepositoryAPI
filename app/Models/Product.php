<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    /**
     * The model table
     */
    protected $table = 'products';


    /**
     * these attributes can be assignable
     * 
     * @var array
     */

    protected $fillable = [
        'title',
        'description'
    ];

    
    /**
     * These attributes are hidden when the $table products are returned in response.
     * 
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
