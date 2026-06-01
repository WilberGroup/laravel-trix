<?php

namespace Wilber\LaravelTrix\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Wilber\LaravelTrix\Traits\HasTrixRichText;

class Post extends Model
{
    use HasTrixRichText;

    protected $guarded = [];
}
