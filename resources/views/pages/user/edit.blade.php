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
<form action="{{ route('user.update',$user->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
            
            <div class="row row-cols-1 row-cols-lg-2">           
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Name" value="{{ old('name') ? old('name') : $user->name }}">
                        @error('name')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') ? old('email') : $user->email }}">
                        @error('email')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
                
            </div>                    
            
            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan Password">
                        @error('password')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="" selected disabled>Select Role</option>
                            <option value="admin" {{ old('role') == 'admin' || $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="ps" {{ old('role') == 'ps' || $user->role == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
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
