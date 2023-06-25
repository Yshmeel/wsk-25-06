@extends('layouts.auth')

@section('content')
    <section class="manage-courses">
        <div class="manage-courses__block">
            <div class="manage-courses__block-header">
                <h1>Attendee list for {{ $course->title }}</h1>
            </div>

            <div class="manage-courses__list">
                <div class="manage-courses__list-header">
                    <div class="manage-courses__list-header-item small-block">First name</div>
                    <div class="manage-courses__list-header-item small-block">Last name</div>
                    <div class="manage-courses__list-header-item medium-block">Email</div>
                    <div class="manage-courses__list-header-item small-block">Photo</div>
                </div>

                <div class="manage-courses__list-items">
                    @foreach($registrations as $r)
                        <div class="manage-courses__list-item">
                            <div class="manage-courses__list-item-block small-block">
                                {{ $r->member->firstname }}
                            </div>

                            <div class="manage-courses__list-item-block small-block">
                                {{ $r->member->lastname }}
                            </div>

                            <div class="manage-courses__list-item-block medium-block">
                                {{ $r->member->email }}
                            </div>

                            <div class="manage-courses__list-item-block small-block">
                                <img src="data:image/png;base64,{{ $r->member->photo }}"/>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
