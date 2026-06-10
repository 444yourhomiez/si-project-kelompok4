@extends('layouts.app')

@section('title', 'Daftar Simpanan')

@section('menuPengawasSimpanan', 'active')
@section('menuPengawasSimpananSemua', 'active')
@section('menuPengawasSimpananOpen', 'menu-open')

@section('content')
    @livewire('pengawas.simpanan.index')
@endsection