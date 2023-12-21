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
<form action="{{ route('late.update',$late->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-lg-2">
                                
                <div class="col">
                    <div class="mb-3">
                        <label for="date_time_late" class="form-label">date_time_late <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('date_time_late') is-invalid @enderror" name="date_time_late" id="date_time_late" placeholder="Masukkan date_time_late" value="{{ old('date_time_late') ? old('date_time_late') : $late->date_time_late }}">
                        @error('date_time_late')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="information" class="form-label">information <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="8" placeholder="Masukkan information">{{ old('information') ? old('information') : $late->information }}</textarea>
                        @error('information')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>                <div class="col">
                    <div class="mb-3">
                        <label for="bukti" class="form-label">bukti <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('bukti') is-invalid @enderror" name="bukti" id="bukti" rows="8" placeholder="Masukkan bukti">{{ old('bukti') ? old('bukti') : $late->bukti }}</textarea>
                        @error('bukti')<span class="text-danger d-block">{{ $message }}</span>@enderror
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