<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    protected $table = 'document_serialNo';

    protected $fillable =['students_studentNo', 'serialNo'];

}
