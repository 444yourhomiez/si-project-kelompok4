@extends('layouts.app')

@section('title', 'Daftar Cicilan Pribadi')

@section('menuManajemenCicilan', 'active')
@section('menuManajemenCicilanPribadi', 'active')
@section('menuManajemenCicilanOpen', 'menu-open')

@section('content')
    @livewire('manajemen.cicilan.pribadi')
@endsection