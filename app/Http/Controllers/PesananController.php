<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    function store(Request $request)
    {
        $data = $request->all();
        $post = Pesanan::create($data);

        $response = [
            'message' => 'Pesanan',
            'status' => 1,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    function pesanan_user(Request $request)
    {
        $data = Pesanan::where('id_user', $request->input('id_user'))
            ->with('user')
            ->orderBy('created_at', 'DESC')->get();

        $response = [
            'message' => 'Pesanan',
            'status' => 1,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    function pesanan_admin(Request $request)
    {
        $data = Pesanan::with('user')
            ->orderBy('created_at', 'DESC')->get();

        $response = [
            'message' => 'Pesanan',
            'status' => 1,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    function konfirmasi(Request $request)
    {
        $update = Pesanan::where('id', $request->id)->update([
            'tanggal_deadline' => $request->tanggal_deadline,
            'link_whimsical' => $request->link_whimsical,
            'keterangan' => $request->keterangan,
            'pembayaran_total' => $request->pembayaran_total,
            'pembayaran_dp' => $request->pembayaran_dp,
            'pembayaran_sisa' => $request->pembayaran_sisa,
            'is_status' => 1
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function bayardp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bukti_dp' => 'required|image:jpeg,png,jpg,gif,svg',
            'id' => ['required']
        ]);

        $data = [
            'bukti_dp' => $request->bukti_dp,
            'is_status' => 2
        ];
        if ($request->file('bukti_dp')) {
            $data['bukti_dp'] = $request->file('bukti_dp')->store('foto', 'public');
        }

        $update = Pesanan::where('id', $request->id)->update([
            'bukti_dp' => $data['bukti_dp'],
            'is_status' => 2
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function konfirmasidp(Request $request)
    {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 3
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function pekerjaanselesai(Request $request)
    {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 4,
            'tanggal_selesai' => Carbon::now(),
            'link_youtube' => $request->link_youtube
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function revisi(Request $request)
    {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 5,
            'tanggal_revisi' => Carbon::now(),
            'keterangan' => $request->keterangan
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function revisi_selesai(Request $request)
    {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 4,
            'tanggal_revisi' => Carbon::now(),
            'keterangan' => $request->keterangan,
            'link_youtube' => $request->link_youtube
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function selesaikan_project(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bukti_sisa' => 'required|image:jpeg,png,jpg,gif,svg',
            'id' => ['required']
        ]);

        $data = [
            'bukti_sisa' => $request->bukti_sisa
        ];
        if ($request->file('bukti_sisa')) {
            $data['bukti_sisa'] = $request->file('bukti_sisa')->store('foto', 'public');
        }

        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 6,
            'bukti_sisa' => $data['bukti_sisa']
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function selesaikanprojectadmin(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 7
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function konfirmasi_service(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 1
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function jemput_pesanan(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 2
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function kerjakan_service(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 3,
            'pembayaran_total' => $request->pembayaran_total
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function pekerjaan_selesai(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 4,
            'link_youtube' => $request->link_youtube,
            'keterangan' => $request->keterangan
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function antar_pesanan(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 5
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }

    function selesaikan_service(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 6,
            'tanggal_selesai' => Carbon::now()
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }
    function batalkan_service(Request $request) {
        $update = Pesanan::where('id', $request->id)->update([
            'is_status' => 7
        ]);

        $response = [
            'message' => 'Pesanan',
            'status' => 1
        ];

        return response()->json($response, 200);
    }
}
