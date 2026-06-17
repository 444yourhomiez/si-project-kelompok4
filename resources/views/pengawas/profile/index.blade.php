@extends('layouts.app')
@section('title', 'Profile')
@section('menuPengawasProfile', 'active')
@section('content')
    {{-- INDEX PROFILE --}}
    @livewire('pengawas.profile.index')
    {{-- MODAL UBAH PASSWORD --}}
    @livewire('pengawas.profile.ubah-password')
    {{-- CLOSE MODAL --}}
    <script>
        window.addEventListener(
            'closeUbahPasswordPengawasModal',
            () => {
                $('#ubahPasswordPengawasModal').modal('hide');
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Password berhasil diperbarui',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        );
    </script>
@endsection