@extends('layouts.app')

@section('title', 'Daftar Pinjaman')

@section('menuManajemenPinjamanSemua', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')
@section('menuManajemenPinjaman', 'active')

@section('content')
    @livewire('manajemen.pinjaman.index')
@endsection