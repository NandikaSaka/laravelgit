<?php

namespace App\Http\Controllers;

use App\Models\mahasiswaData;
use Illuminate\Http\Request;

class MahasiswaDataApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return mahasiswaData::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswaData = new mahasiswaData();
        $mahasiswaData->fill($request->all())->save();
        return $mahasiswaData;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return mahasiswaData::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswaData = mahasiswaData::find($id);
        $mahasiswaData->fill($request->all())->save();
        return $mahasiswaData;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswaData = mahasiswaData::find($id);
        $mahasiswaData->delete();
    }
}
