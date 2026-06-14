@extends('layouts.app')

@section('title', 'Daftar Cicilan Khusus')

@section('menuManajemenCicilan', 'active')
@section('menuManajemenCicilanKhusus', 'active')
@section('menuManajemenCicilanOpen', 'menu-open')

@section('content')
    @livewire('manajemen.cicilan.khusus')
@endsection