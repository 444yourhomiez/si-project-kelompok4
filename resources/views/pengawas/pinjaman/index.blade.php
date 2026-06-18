@extends('layouts.app')
@section('title', 'Daftar Pinjaman')
@section('menuPengawasPinjamanSemua', 'active')
@section('menuPengawasPinjamanOpen', 'menu-open')
@section('menuPengawasPinjaman', 'active')
@section('content')
    @livewire('pengawas.pinjaman.index')
@endsection