@extends('layouts.app')

@section('title', 'Daftar Pinjaman Pribadi')

@section('menuManajemenPinjaman', 'active')
@section('menuManajemenPinjamanPribadi', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')

@section('content')
    @livewire('manajemen.pinjaman.pribadi')
@endsection