@extends('layouts.app')
@section('title', 'Daftar Pinjaman Biasa')
@section('menuManajemenPinjaman', 'active')
@section('menuManajemenPinjamanBiasa', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')
@section('content')
    @livewire('manajemen.pinjaman.biasa')
@endsection