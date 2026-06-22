@extends('layouts.app')
@section('title', 'Rekapitulasi Harian')
@section('menuManajemenRekap', 'active')
@section('content')
    @livewire('manajemen.rekap.index')
    @livewire('manajemen.rekap.create')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeCreateRekapModal', () => {
                $('#createRekapModal').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Rekapitulasi berhasil ditambahkan",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        });
    </script>
@endsection
