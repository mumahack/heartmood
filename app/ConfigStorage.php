<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigStorage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','value'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['name','value'];
}
