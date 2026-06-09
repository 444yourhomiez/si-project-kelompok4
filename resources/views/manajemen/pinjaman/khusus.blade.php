@extends('layouts.app')

@section('title', 'Pinjaman')

@section('menuManajemenPinjaman', 'active')
@section('menuManajemenPinjamanKhusus', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')

@section('content')
    @livewire('manajemen.pinjaman.khusus')
@endsection