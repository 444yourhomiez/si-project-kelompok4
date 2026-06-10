@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('menuPengawasAnggota', 'active')
@section('menuPengawasAnggotaSemua', 'active')
@section('menuPengawasAnggotaOpen', 'menu-open')

@section('content')
    @livewire('pengawas.anggota.index')
@endsection
