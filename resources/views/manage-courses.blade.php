@extends('layouts.auth')

@section('content')
    <section class="manage-courses">
        <div class="manage-courses__block">
            <div class="manage-courses__block-header">
                <h1>Manage courses</h1>

                <a href="/members">Manage members</a>

                <div class="manage-courses__block-button">
                    <a href="/courses/new">Create course</a>
                </div>
            </div>

            <div class="manage-courses__list">
                <div class="manage-courses__list-header">
                    <div class="manage-courses__list-header-item medium-block">Course name</div>
                    <div class="manage-courses__list-header-item small-block">Date</div>
                    <div class="manage-courses__list-header-item big-block">Actions</div>
                </div>

                <div class="manage-courses__list-items">
                    @foreach($courses as $course)
                        <div class="manage-courses__list-item">
                            <div class="manage-courses__list-item-block medium-block">
                                {{ $course->title }}
                            </div>

                            <div class="manage-courses__list-item-block small-block">
                                {{ date('d.m.Y', strtotime($course->date_time)) }}
                            </div>

                            <div class="manage-courses__list-item-block big-block">
                                <a href="/course/{{ $course->id }}">
                                    Edit course
                                </a>

                                <a href="/course/{{ $course->id }}/attendee">
                                    Attendee list
                                </a>

                                <a href="/course/{{ $course->id }}/diagram">
                                    Rating Diagram
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
