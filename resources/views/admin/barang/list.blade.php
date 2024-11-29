@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Gambar </th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Keterangan</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('uploads/' . $barang->gambar) }}"
                                            alt="{{ $barang->nama_barang }}" width="100px"></td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>Rp. {{ number_format($barang->harga) }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>{{ $barang->keterangan }}</td>
                                    <td>{{ $barang->kategori->kategori }}</td>
                                    <td>
                                        <a href="{{ url('admin/barang') }}/{{ $barang->id }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ url('admin/barang', $barang->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Anda yakin ingin menghapus data?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
        {{-- sweet alert --}}
        @include('sweetalert::alert')
    @endsection
