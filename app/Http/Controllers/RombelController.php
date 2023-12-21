<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Rombel;
use Throwable;

class RombelController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Rombel';
        $data['rombel'] = Rombel::all();
        $data['page'] = 'rombel';
        return view('pages.rombel.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Rombel';
        $data['page'] = 'rombel';
        return view('pages.rombel.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'rombel'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Rombel::create($data);
            DB::commit();
            return redirect()->route('rombel.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('RombelController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['title'] = 'Detail Rombel';
        $data['rombel'] = Rombel::find($id);
        $data['page'] = 'rombel';
        return view('pages.rombel.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Rombel';
        $data['rombel'] = Rombel::find($id);
        $data['page'] = 'rombel';
        return view('pages.rombel.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'rombel'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Rombel::find($id)->update($data);
            DB::commit();
            return redirect()->route('rombel.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('RombelController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Rombel::find($id)->delete();
            DB::commit();
            return redirect()->route('rombel.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('RombelController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}