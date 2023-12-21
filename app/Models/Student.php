<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'students';

    public function rayon(){
        return $this->belongsTo(Rayon::class);
    }

    public function rombel(){
        return $this->belongsTo(Rombel::class);
    }

    public function late(){
        return $this->hasMany(Late::class);
    }
}
