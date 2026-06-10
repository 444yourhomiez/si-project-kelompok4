@extends('layouts.app')

@section('title', 'Daftar Pinjaman Pribadi')

@section('menuPengawasPinjaman', 'active')
@section('menuPengawasPinjamanPribadi', 'active')
@section('menuPengawasPinjamanOpen', 'menu-open')

@section('content')
    @livewire('pengawas.pinjaman.pribadi')
@endsection