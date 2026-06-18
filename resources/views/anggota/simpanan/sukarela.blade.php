@extends('layouts.app')
@section('title', 'Simpanan Sukarela')
@section('menuAnggotaSimpanan', 'active')
@section('menuAnggotaSimpananSukarela', 'active')
@section('menuAnggotaSimpananOpen', 'menu-open')
@section('content')
    @livewire('anggota.simpanan.sukarela')
@endsection