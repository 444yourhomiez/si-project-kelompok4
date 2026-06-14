@extends('layouts.app')

@section('title', 'Daftar Pinjaman')

@section('menuAnggotaPinjamanSemua', 'active')
@section('menuAnggotaPinjamanOpen', 'menu-open')
@section('menuAnggotaPinjaman', 'active')

@section('content')
    @livewire('anggota.pinjaman.index')
@endsection