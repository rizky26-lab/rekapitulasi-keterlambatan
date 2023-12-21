@extends('layout.master')
@section('navbar-sidebar')
    @include('component._navbar')
    @include('component._sidebar')
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success pb-0" role="alert">
            <h4 class="alert-heading">Berhasil !</h4>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-lg-end mb-3">
                <a class="btn btn-success" href="{{ route('late.create') }}">Tambah Late</a>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'late' ? 'active' : '' ?>" aria-current="page" href="/late">Keseluruhan Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'rekapitulasi-data' ? 'active' : '' ?>" href="/rekapitulasi-data">Rekapitulasi Data</a>
                </li>
            </ul>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="my_table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-nowrap" style="width:50px">No</th>
                            <th class="text-nowrap">NIS</th>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap">Jumlah keterlambatan</th>
                            <th class="text-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student as $item)
                            <tr>
                                <td class="text-nowrap">{{ $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $item->nis }}</td>
                                <td class="text-nowrap text-truncate" style="max-width:300px">{{ $item->name }}</td>
                                <td class="text-nowrap text-truncate" style="max-width:300px">{{ $item->late->count() }}</td>
                                <td class="text-nowrap text-truncate" style="max-width:300px"><a href="{{ route('late.show', $item->id) }}">Lihat</a></td>
                                {{-- @if ($item->bukti)
                                <td class="text-nowrap text-truncate" style="max-width:300px">
                                    <img src="{{ asset('images/bukti_images/' . $item->bukti) }}" alt="Bukti Image"
                                    style="max-width: 200px;"></td>
                                @else
                                <td class="text-nowrap text-truncate" style="max-width:300px">No Image Available</td>
                                @endif --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function delete_item(form) {
            let cf = confirm('Yakin Menghapus Data ?')
            if (cf) {
                document.getElementById(form).submit();
            }
        }
    </script>
@endsection
