<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "course";

    public static function validasiIdCourse($id)
    {
        return Course::where('id', $id)
            ->first();
    }
}
