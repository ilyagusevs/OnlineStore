@extends('user.account.account-layout')

@section('title', 'JUST SPORT')
@section('profile')
    <p>Name <span>{{Auth::user()->firstname}}</span></p>
    <hr class="my-4"> 
    <p>Surname <span>{{Auth::user()->lastname}}</span></p>
    <hr class="my-4">
    <p>Email <span>{{Auth::user()->email}}</span></p>
    <hr class="my-4">  
@endsection
