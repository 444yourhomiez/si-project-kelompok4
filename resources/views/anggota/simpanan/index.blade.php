@extends('layouts.app')
@section('title', 'Daftar Simpanan')
@section('menuAnggotaSimpanan', 'active')
@section('menuAnggotaSimpananSemua', 'active')
@section('menuAnggotaSimpananOpen', 'menu-open')
@section('content')
    @livewire('anggota.simpanan.index')
@endsection