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
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap">Tanggal</th>
                            <th class="text-nowrap">Informasi</th>
                            <th class="text-nowrap" style="width: 100px">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($late as $item)
                            <tr>
                                <td class="text-nowrap">{{ $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $item->student->nis }} {{ $item->student->name }}</td>
                                <td class="text-nowrap text-truncate" style="max-width:300px">{{ $item->date_time_late }}</td>
                                <td class="text-nowrap text-truncate" style="max-width:300px">{{ $item->information }}</td>
                                {{-- @if ($item->bukti)
                                <td class="text-nowrap text-truncate" style="max-width:300px">
                                    <img src="{{ asset('images/bukti_images/' . $item->bukti) }}" alt="Bukti Image"
                                    style="max-width: 200px;"></td>
                                @else
                                <td class="text-nowrap text-truncate" style="max-width:300px">No Image Available</td>
                                @endif --}}
                                <td class="text-nowrap">
                                    <div class="d-flex">
                                        <a href="{{ route('late.edit', $item->id) }}" class="btn btn-warning me-2">Edit</a>
                                        <form action="{{ route('late.destroy', $item->id) }}" method="post"
                                            id="delete_form{{ $item->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger"
                                                onclick="delete_item('delete_form{{ $item->id }}')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
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
