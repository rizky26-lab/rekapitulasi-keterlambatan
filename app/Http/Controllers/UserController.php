<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Throwable;

class UserController extends Controller
{
    public function index()
    {

        $data['title'] = 'Daftar User';
        $data['page'] = 'user';
        $data['user'] = User::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('pages.user.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah User';
        $data['page'] = 'user';
        return view('pages.user.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
                'role' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

        // Extract words from name and email
        $password = bcrypt(substr($data['name'], 0, 3) . substr($data['email'], 0, 3));

        $data['password'] = $password;

            User::create($data);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('UserController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['page'] = 'user';
        $data['title'] = 'Detail User';
        $data['user'] = User::find($id);
        return view('pages.user.index', $data);
    }

    public function edit($id)
    {
        $data['page'] = 'user';
        $data['title'] = 'Edit User';
        $data['user'] = User::find($id);
        return view('pages.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
                'password' => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            
            $data = $request->only(['name', 'email']); 

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            User::find($id)->update($data);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('UserController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            User::find($id)->delete();
            DB::commit();
            return redirect()->route('pages.user.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('UserController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
