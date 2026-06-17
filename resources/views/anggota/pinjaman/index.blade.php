@extends('layouts.app')
@section('title', 'Daftar Pinjaman')
@section('menuAnggotaPinjamanSemua', 'active')
@section('menuAnggotaPinjamanOpen', 'menu-open')
@section('menuAnggotaPinjaman', 'active')
@section('content')
    {{-- INDEX --}}
    @livewire('anggota.pinjaman.index')
    {{-- AJUKAN PINJAMAN --}}
    @livewire('anggota.pinjaman.create')
    {{-- CLOSE MODAL --}}
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeCreateModal', () => {
                $('#createModalPinjaman').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Pengajuan Pinjaman Berhasil Diajukan",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
            // Livewire.on('closeEditModal', () => {
            //     $('#editModalSimpanan').modal('hide');
            //     Swal.fire({
            //         title: "Sukses",
            //         text: "Simpanan Berhasil Diperbarui",
            //         icon: "success",
            //         confirmButtonText: "OK"
            //     });
            // });
            // Livewire.on('closeDeleteModal', () => {
            //     $('#deleteModalSimpanan').modal('hide');
            //     Swal.fire({
            //         title: "Sukses",
            //         text: "Simpanan Berhasil Dihapus",
            //         icon: "success",
            //         confirmButtonText: "OK"
            //     });
            // });
        });
    </script>
@endsection