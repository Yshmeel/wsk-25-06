@extends('layouts.auth')

@section('content')
    <section class="manage-courses">
        <div class="manage-courses__block">
            <div class="manage-courses__block-header">
                <h1>Course rating {{ $course->title }}</h1>
            </div>

            <div class="manage-courses__list">
                Rate 0 - {{ $data['0'] ?? 0 }}
                Rate 1 - {{ $data['1'] ?? 0 }}
                Rate 2 - {{ $data['2'] ?? 0 }}
            </div>
        </div>
    </section>
@endsection
