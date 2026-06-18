@extends('layouts.app')
@section('title', 'Data Lengkap Anggota Menunggu Verifikasi')
@section('menuManajemenAnggota', 'active')
@section('menuManajemenAnggotaMenunggu', 'active')
@section('menuManajemenAnggotaOpen', 'menu-open')
@section('content')
    @livewire('manajemen.anggota.detail-anggota-menunggu', ['id' => request()->route('id')])
@endsection