<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Throwable;

class StudentController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Student';
        $data['student'] = Student::all();
        $data['page'] = 'student';
        return view('pages.student.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Student';
        $data['page'] = 'student';
        $data['rayons'] = Rayon::all();
        $data['rombels'] = Rombel::all();
        return view('pages.student.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'nis'=>'required',
                'name'=>'required',
                'rayon_id'=>'required',
                'rombel_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Student::create($data);
            DB::commit();
            return redirect()->route('student.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('StudentController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['title'] = 'Detail Student';
        $data['page'] = 'student';
        $data['student'] = Student::find($id);
        return view('pages.tudent.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Student';
        $data['student'] = Student::find($id);
        $data['page'] = 'student';
        $data['rayons'] = Rayon::all();
        $data['rombels'] = Rombel::all();
        return view('pages.student.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'nis'=>'required',
                'name'=>'required',
                'rayon_id'=>'required',
                'rombel_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            Student::find($id)->update($data);
            DB::commit();
            return redirect()->route('student.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('StudentController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Student::find($id)->delete();
            DB::commit();
            return redirect()->route('student.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('StudentController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}