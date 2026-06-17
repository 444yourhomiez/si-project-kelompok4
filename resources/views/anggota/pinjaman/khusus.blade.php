@extends('layouts.app')
@section('title', 'Pinjaman Khusus')
@section('menuAnggotaPinjaman', 'active')
@section('menuAnggotaPinjamanKhusus', 'active')
@section('menuAnggotaPinjamanOpen', 'menu-open')
@section('content')
    @livewire('anggota.pinjaman.khusus')
@endsection