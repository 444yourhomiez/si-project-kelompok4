@extends('layouts.app')

@section('title', 'Daftar Rekap')

@section('menuManajemenRekapSemua', 'active')
@section('menuManajemenRekapOpen', 'menu-open')
@section('menuManajemenRekap', 'active')

@section('content')
    @livewire('manajemen.rekap.index')
@endsection