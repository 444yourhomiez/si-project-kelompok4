@extends('layouts.app')
@section('title', 'Daftar Pinjaman Khusus')
@section('menuPengawasPinjaman', 'active')
@section('menuPengawasPinjamanKhusus', 'active')
@section('menuPengawasPinjamanOpen', 'menu-open')
@section('content')
    @livewire('pengawas.pinjaman.khusus')
@endsection