@extends('layouts.app')
@section('title', 'Data Lengkap Anggota Menunggu Verifikasi')
@section('menuPengawasAnggota', 'active')
@section('menuPengawasAnggotaMenunggu', 'active')
@section('menuPengawasAnggotaOpen', 'menu-open')
@section('content')
    @livewire('pengawas.anggota.detail-anggota-menunggu', ['id' => request()->route('id')])
@endsection