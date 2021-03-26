<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
   	protected $table = 'product_sections';
    protected $fillable = [
        'name','image_width','image_height','content_section','order_by','status'
    ];

   
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
