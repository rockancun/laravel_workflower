<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    protected $fillable = [
        'title',
        'merged',
        'approved',
        'state',
        'serialized_workflow',
    ];
}
