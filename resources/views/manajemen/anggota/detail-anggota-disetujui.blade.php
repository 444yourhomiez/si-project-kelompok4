@extends('layouts.app')
@section('title', 'Data Lengkap Anggota Disetujui')
@section('menuManajemenAnggota', 'active')
@section('menuManajemenAnggotaDisetujui', 'active')
@section('menuManajemenAnggotaOpen', 'menu-open')
@section('content')
    @livewire('manajemen.anggota.detail-anggota-disetujui', ['id' => request()->route('id')])
@endsection
