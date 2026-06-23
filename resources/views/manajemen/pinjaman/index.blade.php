@extends('layouts.app')
@section('title', 'Daftar Pinjaman')
@section('menuManajemenPinjamanSemua', 'active')
@section('menuManajemenPinjamanOpen', 'menu-open')
@section('menuManajemenPinjaman', 'active')
@section('content')
    @livewire('manajemen.pinjaman.index')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeShowModal', () => {
                $('#showModalPinjaman').modal('hide');
                Swal.fire({
                    title: 'Sukses',
                    text: 'Status pinjaman berhasil diperbarui',
                    icon: 'success'
                });
            });
        });
    </script>
@endsection
