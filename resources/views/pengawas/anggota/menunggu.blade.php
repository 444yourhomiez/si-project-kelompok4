@extends('layouts.app')

@section('title', 'Anggota Menunggu Verifikasi')

@section('menuPengawasAnggota', 'active')
@section('menuPengawasAnggotaMenunggu', 'active')
@section('menuPengawasAnggotaOpen', 'menu-open')

@section('content')
    @livewire('pengawas.anggota.menunggu')
@endsection