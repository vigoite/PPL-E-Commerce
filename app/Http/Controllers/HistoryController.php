<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isMember');
    }

    public function index( Request $request)
    {
        $data =
            [
                'title' => 'History',
            ];
            $datass = [
                'biaya_ongkir' => $request->query('biaya_ongkir'),
            ];
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();

        return view('history.index', compact('pesanans','datass'), $data);
    }

    public function detail($id, Request $request)
    {
        $data =
            [
                'title' => 'History',
            ];

            $datass = [
                'biaya_ongkir' => $request->query('biaya_ongkir'),
            ];
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        $pesanan->kurir = $request->courier; // Menyimpan kurir saat konfirmasi
        $pesanan->update();


        return view('history.detail', compact('pesanan', 'pesanan_details', 'datass'), $data);
    }
}
