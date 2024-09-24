@extends('layouts.dashboardlayout')
@section('title', 'Profile')
@section('breadcrumb1', 'User Management')
@section('breadcrumb', 'Profile')
@section('pageTitle', 'Profiles')
@section('content')
    <x-slot name="header">
        <h2 class="h4 mb-4 text-primary">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4">
            <!-- Update Profile Information Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Update Profile Information') }}</h5>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Update Password') }}</h5>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Delete Account') }}</h5>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    @endsection
