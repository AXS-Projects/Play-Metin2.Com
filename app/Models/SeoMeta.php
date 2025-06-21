<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'seo_meta';

    protected $fillable = ['page', 'title', 'description', 'keywords'];
}
