@extends('layouts.app')

@section('title', 'Daftar Cicilan')

@section('menuAnggotaCicilanSemua', 'active')
@section('menuAnggotaCicilanOpen', 'menu-open')
@section('menuAnggotaCicilan', 'active')

@section('content')
    @livewire('anggota.cicilan.index')
@endsection
