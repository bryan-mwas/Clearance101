<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable =['cafeteria','department','library','games','extra_curricular','financial_aid','finance','students_studentNo'];

}
