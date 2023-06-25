@extends('layouts.auth')

@section('content')
    <section class="add-course">
        <div class="add-course__block">
            <div class="add-course__block-header">
                <h1>Edit course</h1>
            </div>
        </div>

        <div class="add-course__form">
            <form action="/course/manage" method="POST">
                @csrf

                <input type="hidden" name="course_id" value="{{ $course->id }}" />

                <div class="form-group">
                    <label for="course_name">Course name</label>
                    <input type="text" id="course_name"
                           value="{{ $course->title }}"
                           name="course_name" class="input"/>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description">
                        {{ $course->description }}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location"
                           value="{{ $course->location }}"
                           class="input"/>
                </div>

                <div class="form-group">
                    <label for="date_time">Starting Date & Time</label>
                    <input type="datetime-local" id="date_time" name="date_time"
                           value="{{ $course->date_time }}"
                           class="input"/>
                </div>

                <div class="form-group">
                    <label for="seats">Capacity</label>
                    <input type="number" id="seats" name="seats"
                           value="{{ $course->seats }}"
                           class="input"/>
                </div>

                <div class="form-group">
                    <label for="duration_days">Duration days</label>
                    <input type="number" id="duration_days" name="duration_days"
                           value="{{ $course->duration_days }}"
                           class="input"/>
                </div>

                <div class="form-group">
                    <label for="instructor_name">Instructor's name</label>
                    <input type="text" id="instructor_name" name="instructor_name"
                           value="{{ $course->instructor_name }}"
                           class="input"/>
                </div>

                <div class="form-button">
                    <button type="submit" class="btn">
                        Edit course
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
