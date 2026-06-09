@extends('layouts.app')

@section('title', 'Dashboard')
@section('menuPengawasDashboard', 'active')

@section('content')
    @livewire('pengawas.dashboard')
@endsection