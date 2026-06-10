@extends('layouts.app')

@section('title', 'Simpanan Wajib')

@section('menuPengawasSimpanan', 'active')
@section('menuPengawasSimpananWajib', 'active')
@section('menuPengawasSimpananOpen', 'menu-open')

@section('content')
    @livewire('pengawas.simpanan.wajib')
@endsection