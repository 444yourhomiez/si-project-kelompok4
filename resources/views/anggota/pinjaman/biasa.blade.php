@extends('layouts.app')
@section('title', 'Pinjaman Biasa')
@section('menuAnggotaPinjaman', 'active')
@section('menuAnggotaPinjamanBiasa', 'active')
@section('menuAnggotaPinjamanOpen', 'menu-open')
@section('content')
    @livewire('anggota.pinjaman.biasa')
@endsection