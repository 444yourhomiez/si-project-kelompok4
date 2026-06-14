@extends('layouts.app')

@section('title', 'Daftar Cicilan Khusus')

@section('menuAnggotaCicilan', 'active')
@section('menuAnggotaCicilanKhusus', 'active')
@section('menuAnggotaCicilanOpen', 'menu-open')

@section('content')
    @livewire('anggota.cicilan.khusus')
@endsection