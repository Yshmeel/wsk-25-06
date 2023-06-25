<?php

namespace App\Http\Controllers;

use App\Http\Requests\APIRegistrationRatingRequest;
use App\Http\Requests\APIRegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Member;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAPIController extends Controller
{
    public function register(RegisterRequest $request) {
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $teacherID = $request->get('teacher_id');

        $existMember = Member::query()->where('username', $username)->orWhere('email', $email)->first();

        if($existMember) {
            return response()->json([
                'message' => 'Member email or username already registered'
            ])->setStatusCode(422);
        }

        if(!Member::checkTeacherID($teacherID)) {
            return response()->json([
                'message' => 'Wrong teacher ID'
            ])->setStatusCode(422);
        }

        $member = new Member();
        $member->setRawAttributes($request->validationData());
        $member->token = md5($username);
        $member->password = md5($password);
        $member->is_activated = true;
        $member->save();

        return response()->json([
            'token' => $member->token
        ])->setStatusCode(200);
    }

    public function login(LoginRequest $request) {
        $username = $request->get('username');
        $password = $request->get('password');

        try {
            $member = Member::query()->where('username', $username)->firstOrFail();

            if($member->password != md5($password)) {
                throw new \Exception('invalid password');
            }

            $member->token = md5($member->username);
            $member->save();

            return response()->json([
                'token' => $member->token
            ])->setStatusCode(200);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Invalid login'
            ])->setStatusCode(401);
        }
    }

    public function logout() {
        Auth::logout();

        $member = Auth::user();
        $member->token = '';
        $member->save();

        return response()->json([
            'message' => 'Logout success'
        ])->setStatusCode(200);
    }

    public function courses() {
        $courses = Course::query()->orderBy('date_time', 'DESC')->get();
        return response()->json($courses)->setStatusCode(200);
    }

    public function viewRegistrations() {
        $member = Auth::user();

        $courseIDs = Registration::query()->where('member_id', $member->id)->get()->map(function($e) { return $e->id; });
        $courses = Course::query()->orderBy('date_time', 'DESC')->whereIn("id", $courseIDs)->get();

        return response()->json($courses)->setStatusCode(200);
    }

    public function registration(APIRegistrationRequest $request) {
        $courseID = $request->get('course_id');
        $course = Course::query()->where('id', $courseID)->first();

        if(!$course) {
            return response()->json([
                'message' => 'Not found'
            ])->setStatusCode(404);
        }

        $reservedSeatsCount = Registration::query()->where('course_id', $courseID)->count();

        if($reservedSeatsCount >= $course->seats) {
            return response()->json([
                'message' => 'No available seat'
            ])->setStatusCode(406);
        }

        $member = Auth::user();
        $existRegistration = Registration::query()->where('member_id', $member->id)
            ->where('course_id', $courseID)->first();

        if($existRegistration) {
            return response()->json([
                'message' => 'Member already registered'
            ])->setStatusCode(406);
        }

        $registration = new Registration();
        $registration->course_id = $courseID;
        $registration->member_id = $member->id;
        $registration->registration_date = Carbon::now();
        $registration->rate = -1;
        $registration->save();

        return response()->json([
            'message' => 'Registration success'
        ])->setStatusCode(200);
    }

    public function rate(APIRegistrationRatingRequest $request, int $id) {
        $courseID = $request->get('course_id');
        $course = Course::query()->where('id', $id)->first();

        if(!$course) {
            return response()->json([
                'message' => 'Bad request'
            ])->setStatusCode(400);
        }

        $rate = $request->get('course_rating');

        if(!in_array($rate, [0, 1, 2])) {
            return response()->json([
                'message' => 'Bad request'
            ])->setStatusCode(400);
        }

        $member = Auth::user();
        $existRegistration = Registration::query()->where('member_id', $member->id)->first();

        if(!$existRegistration) {
            return response()->json([
                'message' => 'Bad request'
            ])->setStatusCode(400);
        }

        $existRegistration->rate = $rate;
        $existRegistration->save();

        return response()->json([
            'message' => 'Rating success'
        ])->setStatusCode(200);
    }
}
