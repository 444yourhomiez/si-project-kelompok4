@extends('layouts.app')
@section('title', 'Daftar Pinjaman Biasa')
@section('menuPengawasPinjaman', 'active')
@section('menuPengawasPinjamanBiasa', 'active')
@section('menuPengawasPinjamanOpen', 'menu-open')
@section('content')
    @livewire('pengawas.pinjaman.biasa')
@endsection