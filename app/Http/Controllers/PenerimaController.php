<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Penerima::all();
        return view('penerima')->with('students', $students);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerima $penerima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerima $penerima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerima $penerima)
    {
        //
    }
}
