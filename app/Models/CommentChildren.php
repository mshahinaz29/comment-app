<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentChildren extends Model
{
    // use HasFactory;

    protected $guarded = [];

    protected $table = 'comments_children';

    // public function children_comment(){
    //     return $this->belongsTo('App\Models\Comment', 'child_id', 'id');
    // }
}
