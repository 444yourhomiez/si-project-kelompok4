@extends('layouts.app')

@section('title', 'Pinjaman Pribadi')

@section('menuAnggotaPinjaman', 'active')
@section('menuAnggotaPinjamanPribadi', 'active')
@section('menuAnggotaPinjamanOpen', 'menu-open')

@section('content')
    @livewire('anggota.pinjaman.pribadi')
@endsection