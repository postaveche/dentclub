@extends('layouts.dentclub')

@section('title', 'DentClub.MD')

@section('content')
    <div class="main">
        <div class="container">
            {{\App\Http\Controllers\MainController::productatori_rand()}}
        </div>
    </div>
@endsection
