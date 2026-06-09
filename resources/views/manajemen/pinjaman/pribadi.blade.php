@extends('layouts.app')

@section('title', 'Pinjaman')

@section('menuManajemenPinjaman', 'active')
@section('menuManajemenPinjamanPribadi', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')

@section('content')
    @livewire('manajemen.pinjaman.pribadi')
@endsection