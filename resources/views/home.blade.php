@extends('layouts.app')

@php
    $pageTitle = "Dashboard: All Tasks";
@endphp

@section('content')
    @include('includes.tasks.taskList')
@endsection
