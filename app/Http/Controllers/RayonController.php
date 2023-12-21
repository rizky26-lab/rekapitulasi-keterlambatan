<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Rayon;
use App\Models\User;
use Throwable;

class RayonController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Rayon';
        $data['rayon'] = Rayon::all();
        $data['page'] = 'rayon';
        return view('pages.rayon.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Rayon';
        $data['page'] = 'rayon';
        $data['users'] = User::where('role', 'user')->get();
        return view('pages.rayon.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'rayon'=>'required',
                'user_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Rayon::create($data);
            DB::commit();
            return redirect()->route('rayon.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('RayonController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['title'] = 'Detail Rayon';
        $data['rayon'] = Rayon::find($id);
        $data['page'] = 'rayon';
        return view('pages.rayon.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Rayon';
        $data['rayon'] = Rayon::find($id);
        $data['page'] = 'rayon';
        $data['users'] = User::where('role', 'user')->get();
        return view('pages.rayon.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'rayon'=>'required',
                'user_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Rayon::find($id)->update($data);
            DB::commit();
            return redirect()->route('rayon.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('RayonController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Rayon::find($id)->delete();
            DB::commit();
            return redirect()->route('rayon.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('RayonController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}