@extends('template')

@section('content')

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next home homepage</p>
        </div>
    </div>
</header>
@if(Auth::check())
<h2>Chào mừng bạn {{ Auth::user()->name }} đến với chúng tôi</h2>
{{-- @else
<a href="{{ route('login.index') }}"><h2>Mời bạn đăng nhập !</h2></a> --}}
@endif
{{-- @if (Auth::check())
<div class="container">
    <form action="{{ route('login.logout') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
</div>
    
@endif   --}}

@endsection