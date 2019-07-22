<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index(){
        $data['pengaturan'] = \DB::table('pengaturan')->where('id',1)->first(); 
        return view('pengaturan',$data);
    }

    function save(request $request){

        if($request->hasFile('logo')){
            //upload foto
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $destionationPath = 'uploads';
            $file->move($destionationPath,$fileName);

            $data = [
                'nama_perusahaan'   => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'email'             => $request->email,
                'no_telepon'        => $request->no_telepon,
                'logo'              => $fileName
            ];

        }else{
            //tidak upload foto
            $data = [
                'nama_perusahaan'   => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'email'             => $request->email,
                'no_telepon'        => $request->no_telepon,
            ];
        }

        \DB::table('pengaturan')->where('id',1)->update($data);
        return redirect('pengaturan')->with('message','Berhasil Edit Profil Instansi..!!');
    }
}
