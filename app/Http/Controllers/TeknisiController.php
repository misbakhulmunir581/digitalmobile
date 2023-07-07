<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TeknisiController extends Controller
{
    function store(Request $request)
    {
        $data = $request->all();

        //cek email 
        $teknisi = Teknisi::where('nik', $request->nik)->first();

        if ($teknisi != null) {
            $response = [
                'message' => 'NIK sudah terdaftar',
                'status' => 501
            ];

            return response()->json($response, 200);
        }
        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $post = Teknisi::create($data);

        $response = [
            'message' => 'Daftar teknisi berhasil',
            'status' => 1,
            'data' => $post
        ];

        return response()->json($response, 200);
    }

    function index(Request $request) {
        $data = Teknisi::all();
        $response = [
            'message' => 'data berhasil',
            'status' => 1,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    function update(Request $request)
    {
        $data = $request->except('id','foto','oldImage');

        //cek email 
        $teknisi = Teknisi::where('id', $request->id)->first();
        if ($teknisi->nik == $request->nik && $teknisi->id!= $request->id) {
                $response = [
                    'message' => 'NIK sudah terdaftar',
                    'status' => 2
                ];
    
                return response()->json($response, 200);
            
    
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');

            //delete
            $delete = Storage::delete($request->oldImage);
        }

        $post = Teknisi::where('id',$request->id)->update($data);

        $response = [
            'message' => 'Daftar teknisi berhasil',
            'status' => 1
        ];

        return response()->json($response, 200);
    }


    public function delete(Request $request)
    {
        $update = Teknisi::where('id', $request->id)->delete();
        //delete
        $delete = Storage::delete($request->oldImage);
        
        $response = [
            'message' => 'delete berhasil',
            'status' => 1
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

}
