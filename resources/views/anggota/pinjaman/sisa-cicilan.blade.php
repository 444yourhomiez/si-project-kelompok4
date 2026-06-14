@extends('layouts.app')

@section('title', 'Sisa Cicilan Pinjaman')

@section('menuAnggotaPinjaman', 'active')
@section('menuAnggotaSisaCicilan', 'active')
@section('menuAnggotaPinjamanOpen', 'menu-open')

@section('content')
    @livewire('anggota.pinjaman.sisa-cicilan')
@endsection