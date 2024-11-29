@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-2">
                <a href="{{ url('history') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-4">
                @if ($pesanan->status == 1)
                    <div class="alert alert-success" role="alert">
                        <h3>Check Out Sukses</h3>
                        <h5>Pesanan anda sudah berhasil di check out, selanjutnya untuk pembayaran silahkan transfer ke
                            rekening : </h5>
                        <h5><strong>Bank BRI : 12345678 - a/n B-craft </strong> dengan nominal : <strong>Rp.
                                {{ number_format($pesanan->jumlah_harga + $pesanan->ongkir) }}</strong></h5>
                        <h5></h5>
                    </div>
                @elseif ($pesanan->status == 2)
                    <div class="alert alert-success" role="alert">
                        <h3>Pesanan Diproses</h3>
                        <h5>Pembayaran sudah kami terima, selanjutnya anda tinggal menunggu pesanan anda dikirim ke
                            alamat anda</h5>
                    </div>
                @endif
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>
                        @if (!empty($pesanan))
                            <div class="alert alert-secondary" role="alert">
                                @if ($pesanan->status == 1)
                                    Tanggal Pesan: <strong>{{ $pesanan->tanggal }}</strong>
                                @elseif ($pesanan->status == 2)
                                    Tanggal Bayar: <strong>{{ $pesanan->updated_at }}</strong>
                                @elseif ($pesanan->status == 4)
                                    Diterima pada: <strong>{{ $pesanan->updated_at }}</strong>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th class="text-end">Jumlah</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($pesanan_details as $pesanan_detail)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <img src="{{ url('uploads') }}/{{ $pesanan_detail->barang->gambar }}"
                                                        width="100" alt="barang">
                                                </td>
                                                <td>{{ $pesanan_detail->barang->nama_barang }}</td>
                                                <td align="left">Rp.
                                                    {{ number_format($pesanan_detail->barang->harga) }}
                                                </td>
                                                <td align="right">{{ $pesanan_detail->jumlah }} Barang</td>
                                                <td align="right">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}
                                                </td>
                                            </tr>
                                                                                     
                                        @endforeach

                                        <tr>
                                            <td colspan="5" align="right"><strong>Total Harga : </strong></td>
                                            <td align="right"><strong>Rp.               
                                                    {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="right"><strong>Ongkir : </strong></td>
                                            <td align="right"><strong>Rp.
                                                    {{ number_format($pesanan->ongkir) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="right"><strong>Kode Unik : </strong></td>
                                            <td align="right"><strong># {{ number_format($pesanan->kode) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="right"><strong>Kurir : </strong></td>
                                            <td align="right"><strong><pre>{{ var_dump($pesanan->kurir) }}</pre>                                            </strong></td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" align="right"><strong>Total Yang Harus Ditransfer :
                                                </strong>
                                            </td>
                                            <td align="right"><strong>Rp.
                                                    {{ number_format($pesanan->jumlah_harga + $pesanan->ongkir) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($pesanan->status == 2 || $pesanan->status == 4)
                                    <hr style="height:1px;border:none;color:#6a6a6a;background-color:#6a6a6a;">
                                    <div class="pl-4">
                                        <h5><i class="fa fa-user"></i> Informasi Penerima</h5>
                                        <br>
                                        <p>
                                            <strong>Nama Penerima : </strong>{{ Auth::user()->name }}<br>
                                            <strong>Alamat : </strong>{{ Auth::user()->alamat }}<br>
                                            <strong>No. HP : </strong>{{ Auth::user()->no_hp }}<br>
                                            <strong>Email : </strong>{{ Auth::user()->email }}<br>
                                        </p>
                                    </div>
                                @endif
                            </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('sweetalert::alert')
@endsection
