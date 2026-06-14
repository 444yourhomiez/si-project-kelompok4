@extends('layouts.app')

@section('title', 'Simpanan Pokok')

@section('menuAnggotaSimpanan', 'active')
@section('menuAnggotaSimpananPokok', 'active')
@section('menuAnggotaSimpananOpen', 'menu-open')

@section('content')
    @livewire('anggota.simpanan.pokok')
@endsection