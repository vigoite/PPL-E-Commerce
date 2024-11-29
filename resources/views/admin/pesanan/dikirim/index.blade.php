@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Tanggal</td>
                                    <td>Status</td>
                                    <td>Jumlah</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pesanan->tanggal }}</td>
                                        <td>
                                            @if ($pesanan->status == 3)
                                                Dikirim
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($pesanan->jumlah_harga + $pesanan->kode+ $pesanan->ongkir) }}</td>
                                        <td>
                                            <a href="{{ url('admin/pesanan-dikirim') }}/{{ $pesanan->id }}"
                                                class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- sweet alert --}}
    @include('sweetalert::alert')
@endsection
