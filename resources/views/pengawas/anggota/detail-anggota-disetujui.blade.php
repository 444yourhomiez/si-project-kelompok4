@extends('layouts.app')
@section('title', 'Data Lengkap Anggota Disetujui')
@section('menuPengawasAnggota', 'active')
@section('menuPengawasAnggotaDisetujui', 'active')
@section('menuPengawasAnggotaOpen', 'menu-open')
@section('content')
    @livewire('pengawas.anggota.detail-anggota-disetujui', ['id' => request()->route('id')])
@endsection
