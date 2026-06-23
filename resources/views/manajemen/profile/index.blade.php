@extends('layouts.app')
@section('title', 'Profile')
@section('menuManajemenProfile', 'active')
@section('content')
    {{-- INDEX PROFILE --}}
    @livewire('manajemen.profile.index')
    {{-- MODAL UBAH PASSWORD --}}
    @livewire('manajemen.profile.ubah-password')
    {{-- CLOSE MODAL --}}
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeUbahPasswordManajemenModal', () => {
                $('#ubahPasswordManajemenModal').modal('hide');
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Password berhasil diperbarui',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endsection