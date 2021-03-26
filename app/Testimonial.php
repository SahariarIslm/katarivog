<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{	protected $table = 'testimonials';

	protected $fillable = [
        'name','department','institute','country','title','image','description','orderBy','status'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
