<?php

namespace App\Http\Controllers\API;

use App\School\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentLogin extends Controller
{
    public $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Student::login($request);
    }

    public function passwordReset(Request $request)
    {
        $response = [
            'message' => false,
            'status' => 500
        ];
        $currentPassword = Student::findById($request->id)->pluck('password')->first();
        if (Hash::check($request->currentpassword, $currentPassword)) {
            if (Student::findById($request->id)->update([
                'password' => Hash::make($request->newpassword),
            ])) {
                $response = [
                    'message' => true,
                    'status' => 200
                ];
            }
        }
        return response($response, 200);
    }
}
