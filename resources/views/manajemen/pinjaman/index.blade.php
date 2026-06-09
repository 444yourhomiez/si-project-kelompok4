@extends('layouts.app')

@section('title', 'Pinjaman')

@section('menuManajemenPinjamanSemua', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')
@section('menuManajemenPinjaman', 'active')

@section('content')
    @livewire('manajemen.pinjaman.index')
@endsection