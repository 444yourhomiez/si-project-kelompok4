@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('menuManajemenAnggota', 'active')
@section('menuManajemenAnggotaSemua', 'active')
@section('menuManajemenAnggotaOpen', 'menu-open')

@section('content')

    {{-- INDEX --}}
    @livewire('manajemen.anggota.index')
    
    {{-- EDIT MODAL --}}
    @livewire('manajemen.anggota.edit')

    {{-- DELETE MODAL --}}
    @livewire('manajemen.anggota.delete')

    {{-- CLOSE MODAL --}}
    <script>
        document.addEventListener('livewire:init', () => {

            // EDIT
            Livewire.on('closeEditModal', () => {

                $('#editModalAnggota').modal('hide');

                Swal.fire({
                    title: "Sukses",
                    text: "Data Anggota Berhasil Diedit",
                    icon: "success",
                    confirmButtonText: "OK"
                });

            });

            // DELETE
            Livewire.on('closeDeleteModal', () => {

                $('#deleteModalAnggota').modal('hide');

                Swal.fire({
                    title: "Sukses",
                    text: "Data Anggota Berhasil Dihapus",
                    icon: "success",
                    confirmButtonText: "OK"
                });

            });

        });
    </script>

@endsection
