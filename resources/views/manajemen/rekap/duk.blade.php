@extends('layouts.app')

@section('title', 'Daftar DUK')

@section('menuManajemenRekap', 'active')
@section('menuManajemenRekapDuk', 'active')
@section('menuManajemenRekapOpen', 'menu-open')

@section('content')
    @livewire('manajemen.rekap.duk')
@endsection