@extends('layouts.app')

@section('title', 'Anggota Menunggu Verifikasi')

@section('menuManajemenAnggota', 'active')
@section('menuManajemenAnggotaMenunggu', 'active')
@section('menuManajemenAnggotaOpen', 'menu-open')

@section('content')
    
    {{-- INDEX MENUNGGU --}}
    @livewire('manajemen.anggota.menunggu')
    
    {{-- EDIT MODAL --}}
    @livewire('manajemen.anggota.edit')

    {{-- DELETE MODAL --}}
    @livewire('manajemen.anggota.delete')

    {{-- CLOSE MODAL --}}
    <script>
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
    </script>

@endsection