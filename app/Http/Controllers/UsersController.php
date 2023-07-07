<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        //status
        //501 = email sudah terdaftar
        //1 = berhasil daftar
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => ['required'],
            'alamat' => ['required'],
            'tanggal_lahir' => ['required'],
            'nomor' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $email = $request->email;
        //cek email 
        $data = User::where('email', $email)->first();

        if ($data != null) {
            $response = [
                'message' => 'Email sudah terdaftar',
                'status' => 501
            ];

            return response()->json($response, 200);
        }


        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor' => $request->nomor,
            'password' => Hash::make($request->password),
             'role' =>1
        ]);


        $response = [
            'message' => 'Daftar user berhasil',
            'status' => 1,
            'data' => $user
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        //status
        //0 = berhasil login admin
        //1 = berhasil login pekerja
        //100 = password salah
        //200 = Belum daftar
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $email = $request->email;
        $password = $request->password;
        //cek user
        $ceklogin = User::where('email', $email)->first();
        if ($ceklogin != null) {
            $password = Hash::check($password, $ceklogin['password']);
            if ($password == true) {
                //CEK ROLE
                if ($ceklogin->role == 1) {
                    $response = [
                        'message' => 'login sebagai mahasiswa',
                        'status' => 1,
                        'data' => $ceklogin
                    ];
                    return response()->json($response, Response::HTTP_OK);

                } else if ($ceklogin->role == 0) {
                    $response = [
                        'message' => 'login sebagai admin',
                        'status' => 0,
                        'data' => $ceklogin
                    ];
                    return response()->json($response, Response::HTTP_OK);

                }
            }else {
            //jiika salah
            $response = [
                'message' => 'Password salah',
                'status' => 100,
                'data' => null
            ];

            return response()->json($response, Response::HTTP_OK);

            }
        } else {
            $response = [
                'message' => 'Belum terdaftar',
                'status' => 200,
                'data' => null
            ];

            return response()->json($response, Response::HTTP_OK);
        }
    }
}
