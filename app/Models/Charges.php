<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    protected $table = 'charge';

    protected $fillable =['cafeteria_value','department_value','library_value','games_value','extra_curricular_value','financial_aid_value','finance_value','total','students_studentNo','status'];
}
