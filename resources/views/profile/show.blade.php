@extends('layouts.app')

@section('title', 'Profile Details')

@section('content')
    <h1>Profile Details</h1>
     <table>
        <tr>
        <td>Name:</td>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>Joined:</td>
        <td>{{ $user->created_at }}</td>
    </tr>
</table>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile0.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection