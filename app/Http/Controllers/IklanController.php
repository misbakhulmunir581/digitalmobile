<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class IklanController extends Controller
{
    function store(Request $request)
    {
        $data = $request->all();

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $post = Iklan::create($data);

        $response = [
            'message' => 'Daftar iklan berhasil',
            'status' => 1,
            'data' => $post
        ];

        return response()->json($response, 200);
    }

    function index(Request $request) {
        $data = Iklan::all();
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

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');

            //delete
            $delete = Storage::delete($request->oldImage);
        }

        $post = Iklan::where('id',$request->id)->update($data);

        $response = [
            'message' => 'Daftar teknisi berhasil',
            'status' => 1
        ];

        return response()->json($response, 200);
    }


    public function delete(Request $request)
    {
        $update = Iklan::where('id', $request->id)->delete();
        //delete
        $delete = Storage::delete($request->oldImage);
        
        $response = [
            'message' => 'delete berhasil',
            'status' => 1
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

}
