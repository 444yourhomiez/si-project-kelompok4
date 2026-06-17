@extends('layouts.app')
@section('title', 'Simpanan Wajib')
@section('menuAnggotaSimpanan', 'active')
@section('menuAnggotaSimpananWajib', 'active')
@section('menuAnggotaSimpananOpen', 'menu-open')
@section('content')
    @livewire('anggota.simpanan.wajib')
@endsection