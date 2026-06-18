@extends('layouts.app')
@section('title', 'Anggota Disetujui')
@section('menuPengawasAnggota', 'active')
@section('menuPengawasAnggotaDisetujui', 'active')
@section('menuPengawasAnggotaOpen', 'menu-open')
@section('content')
    @livewire('pengawas.anggota.disetujui')
@endsection