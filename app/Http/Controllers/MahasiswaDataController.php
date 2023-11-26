<?php

namespace App\Http\Controllers;

use App\Models\mahasiswaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MahasiswaDataController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kata_kunci = $request->kata_kunci;
        $jumlah_baris = 6;
        if (strlen($kata_kunci)){
            $data = mahasiswaData::where('nim', 'like', "%$kata_kunci%")
                ->orWhere('nama', 'like', "%$kata_kunci%")
                ->orWhere('alamat', 'like', "%$kata_kunci%")
                ->orWhere('email', 'like', "%$kata_kunci%")
                ->orWhere('jurusan', 'like', "%$kata_kunci%")
                ->paginate($jumlah_baris);
        } else {
            $data = mahasiswaData::orderBy('nim', 'desc')->paginate($jumlah_baris);
        }
        return view('mahasiswaData.index')->with('data', $data)->with('jumlahbaris', $jumlah_baris);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswaData.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);
        Session::flash('email', $request->email);
        Session::flash('jurusan', $request->jurusan);

        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa_data,nim',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM wajib dalam angka',
            'nim.unique' => 'NIM yang diisikan sudah ada di dalam database',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',

        ]);
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];
        mahasiswaData::insert($data);

        Session::forget(['nim', 'nama', 'alamat', 'email', 'jurusan']);

        return redirect()->to('mahasiswaData')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mahasiswaData::where('nim', $id)->first();
        return view('mahasiswaData.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa_data,nim,' . $id,
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];
        mahasiswaData::where('nim', $id)->update($data);

        Session::forget(['nim', 'nama', 'alamat', 'email', 'jurusan']);

        return redirect()->to('mahasiswaData')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mahasiswaData::where('nim', $id)->delete();
        return redirect()->route('mahasiswaData.index')->with('success', 'Data berhasil dihapus!');
    }
}
