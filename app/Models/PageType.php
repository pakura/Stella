<?php

namespace Models;

use Exception;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use Models\Abstracts\Model;

class PageType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type'
    ];

}
