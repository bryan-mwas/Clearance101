<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    protected $table = 'students';

    protected $fillable = ['studentNo','sname','fname','lname','email','postal_address','tel_no','status'];
}
