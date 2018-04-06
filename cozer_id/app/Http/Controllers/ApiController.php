<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseEnroll;
use App\Http\Requests\CoursePost;
use App\Http\Requests\UsersPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(UsersPost $request)
    {
        if(!empty(User::validasiFieldUsers("email", $request->email)))
        {
            return response()->json(['status' => 400, 'msg' => "Email users sudah digunakan"]);
        }

        $simpan = new User;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->password = Hash::make($request->password);
        $simpan->telepon = $request->telepon;
        $simpan->save();

        if($simpan == true)
        {
            return response()->json(['status' => 200, 'msg' => "User berhasil tersimpan..."]);
        }else{
            return response()->json(['status' => 400, 'msg' => "Sepertinya terjadi kesalahan..."]);
        }
    }

    public function getDataUsers()
    {
        $data = User::orderBy('id', 'desc')
            ->get();

        if(!empty($data))
        {
            return response()->json(['status' => 200, 'data' => $data]);
        }else{
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    public function courseInsert(CoursePost $request)
    {
        $simpan = new Course;
        $simpan->title = $request->title;
        $simpan->description = $request->description;
        $simpan->save();

        if($simpan == true)
        {
            return response()->json(['status' => 200, 'msg' => "Course berhasil tersimpan..."]);
        }else{
            return response()->json(['status' => 400, 'msg' => "Sepertinya terjadi kesalahan..."]);
        }
    }

    public function courseDeleteId($id)
    {
        if(empty(Course::validasiIdCourse($id)))
        {
            return response()->json(['status' => 400, 'msg' => "Course ID tidak ditemukan"]);
        }

        $data = Course::where('id', $id)->delete();
        if($data == true)
        {
            return response()->json(['status' => 200, 'msg' => "Course dengan ID ".$id." berhasil terhapus"]);
        }else{
            return response()->json(['status' => 400, 'msg' => "Sepertinya terjadi kesalahan..."]);
        }
    }

    public function getDataCourse()
    {
        $data = Course::orderBy('id', 'desc')
            ->get();

        if(!empty($data))
        {
            return response()->json(['status' => 200, 'data' => $data]);
        }else{
            return response()->json(['status' => 400, 'data' => []]);
        }
    }

    public function courseId($id)
    {
        if(empty(Course::validasiIdCourse($id)))
        {
            return response()->json(['status' => 400, 'msg' => "Course ID tidak ditemukan", 'data' => null]);
        }

        $data = Course::where('id', $id)->first();
        return response()->json(['status' => 200, 'msg' => "Course ID ".$id." berhasil ditemukan", 'data' => $data]);
    }

    public function courseEnrollInsert($course_id, $users_id)
    {
        if(empty(Course::validasiIdCourse($course_id)))
        {
            return response()->json(['status' => 400, 'msg' => "Course ID tidak ditemukan"]);
        }

        if(empty(User::validasiFieldUsers("id", $users_id)))
        {
            return response()->json(['status' => 400, 'msg' => "Users ID tidak ditemukan"]);
        }

        $simpan = new CourseEnroll;
        $simpan->users_id = $users_id;
        $simpan->course_id = $course_id;
        $simpan->enrolled_at = date('Y-m-d H:i:s');
        $simpan->save();

        if($simpan == true)
        {
            return response()->json(['status' => 200, 'msg' => "Course Enroll berhasil tersimpan..."]);
        }else{
            return response()->json(['status' => 400, 'msg' => "Sepertinya terjadi kesalahan..."]);
        }
    }

    public function courseEnrollUsersId($users_id)
    {
        if(empty(CourseEnroll::validasiUsersId($users_id)))
        {
            return response()->json(['status' => 400, 'msg' => "Users ID Course Enroll tidak ditemukan", 'data' => null]);
        }

        $data = CourseEnroll::where('users_id', $users_id)->first();
        return response()->json(['status' => 200, 'msg' => "Users ID Course Enroll ".$users_id." berhasil ditemukan", 'data' => $data]);
    }
}
