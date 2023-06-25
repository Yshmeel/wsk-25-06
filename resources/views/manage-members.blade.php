@extends('layouts.auth')

@section('content')
    <section class="manage-courses">
        <div class="manage-courses__block">
            <div class="manage-courses__block-header">
                <h1>Manage members</h1>

                <a href="/courses">Manage courses</a>
            </div>

            <div class="manage-courses__list">
                <div class="manage-courses__list-header">
                    <div class="manage-courses__list-header-item small-block">First name</div>
                    <div class="manage-courses__list-header-item small-block">Last name</div>
                    <div class="manage-courses__list-header-item medium-block">Email</div>
                    <div class="manage-courses__list-header-item small-block">Photo</div>
                    <div class="manage-courses__list-header-item small-block">Status</div>
                </div>

                <div class="manage-courses__list-items">
                    @foreach($members as $member)
                        <div class="manage-courses__list-item">
                            <div class="manage-courses__list-item-block small-block">
                                {{ $member->firstname }}
                            </div>

                            <div class="manage-courses__list-item-block small-block">
                                {{ $member->lastname }}
                            </div>

                            <div class="manage-courses__list-item-block medium-block">
                                {{ $member->email }}
                            </div>

                            <div class="manage-courses__list-item-block small-block">
                                <img src="data:image/png;base64,{{ $member->photo }}"/>
                            </div>

                            <div class="manage-courses__list-item-block small-block">
                                <a href="/member/{{ $member->id }}/toggle">
                                    {{ $member->is_activated ? "Deactivate" : "Activate" }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
