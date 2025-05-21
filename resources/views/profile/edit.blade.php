@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">Profil</h2>

    <div class="row g-4">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
