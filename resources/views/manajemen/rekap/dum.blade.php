@extends('layouts.app')

@section('title', 'Daftar DUM')

@section('menuManajemenRekap', 'active')
@section('menuManajemenRekapDum', 'active')
@section('menuManajemenRekapOpen', 'menu-open')

@section('content')
    @livewire('manajemen.rekap.dum')
@endsection