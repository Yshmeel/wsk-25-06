<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageCourseRequest;
use App\Models\Course;
use App\Models\Registration;

class CoursesController extends Controller
{
    /**
     * outputs all courses in desc order by date_time
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function courses() {
        $courses = Course::query()->orderBy('date_time', 'DESC')->get();

        return view('manage-courses', [
            'courses' => $courses
        ]);
    }

    /**
     * renders new course page
     */
    public function newCourse() {
        return view('add-course');
    }

    /**
     * accepts id as parameter to get course and render edit course page
     * @param int $id
     */
    public function editCourse(int $id) {
        try {
            $course = Course::query()->where('id', $id)->firstOrFail();

            return view('edit-course', [
                'course' => $course,
            ]);
        } catch(\Exception $e) {
            return redirect('/courses');
        }
    }

    // accepts managecourserequest, calls from newcourse and edit course
    public function manageCourse(ManageCourseRequest $request) {
        $id = $request->input('course_id');
        $name = $request->get('course_name');
        $description = $request->get('description');
        $location = $request->get('location');
        $dateTime = $request->get('date_time');
        $seats = $request->get('seats');
        $durationDays = $request->get('duration_days');
        $instructorName = $request->get('instructor_name');

        $isNew = $id == '';

        if(!$isNew) {
            $course = Course::query()->where('id', $id)->first();

            if(!$course) {
                return redirect('/courses');
            }
        } else {
            $course = new Course();
        }

        $course->title = $name;
        $course->description = $description;
        $course->location = $location;
        $course->date_time = $dateTime;
        $course->seats = $seats;
        $course->duration_days = $durationDays;
        $course->instructor_name = $instructorName;
        $course->save();

        return redirect('/courses')->with('success',
            $isNew ? 'Course successfully created' : 'Course successfully saved');
    }

    /**
     * outputs attendee list for course
     */
    public function attendeeCourse(int $id) {
        try {
            $course = Course::query()->where('id', $id)->firstOrFail();
            $registrations = Registration::query()->where('course_id', $id)->with(['member'])->get();

            return view('attendee-list', [
                'course' => $course,
                'registrations' => $registrations
            ]);
        } catch(\Exception $e) {
            return redirect('/courses');
        }
    }

    /**
     * outputs rating diagram course
     */
    public function diagramCourse(int $id) {
        try {
            $course = Course::query()->where('id', $id)->firstOrFail();
            $registrations = Registration::query()->where('course_id', $id)->with(['member'])->get();

            $rateData = [];

            foreach($registrations as $i) {
                if(!isset($rateData[$i->rate])) {
                    $rateData[$i->rate] = 0;
                }

                $rateData[$i->rate]++;
            }

            return view('course-rating', [
                'course' => $course,
                'data' => $rateData
            ]);
        } catch(\Exception $e) {
            return redirect('/courses');
        }
    }
}
