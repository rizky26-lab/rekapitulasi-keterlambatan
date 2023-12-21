@extends('layout.master')
@section('navbar-sidebar')
@include('component._navbar')
@include('component._sidebar')
@endsection
@section('content')
@if (session('error'))
    <div class="alert alert-danger pb-0" role="alert">
        <h4 class="alert-heading">Terjadi Masalah</h4>
        <p>{{ session('error') }}</p>
    </div>
@endif
<form action="{{ route('user.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="row row-cols-1 row-cols-lg-2">            
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Name" value="{{ old('name') }}">
                        @error('name')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                        @error('email')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

                <div class="row row-cols-1 row-cols-lg-2">     
                <div class="col">
                    <div class="mb-3">
                        <select class="form-select form-control"  name="role" id="role">
                            <option value="" selected disabled>Select an role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error('role')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
                </div>
            
            
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
