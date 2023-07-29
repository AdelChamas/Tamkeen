<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $table = 'discussion';
    protected $guarded = ['id'];

    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
}
