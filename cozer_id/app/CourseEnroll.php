<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseEnroll extends Model
{
    protected $table = "course_enroll";

    public static function validasiUsersId($id)
    {
        return CourseEnroll::where('users_id', $id)
            ->first();
    }
}
