<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return view('akun.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'type' => 'required|in:admin,cashier',
        ]);

        $password = substr($request->email, 0, 3).substr($request->name, 0, 3);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'type' => $request->type,
        ]);

        return redirect()->route('akun.index')->with('success', 'Berhasil mengubah data!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::find($id);
        
        return view('akun.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:admin,cashier',
        ]);

        $password = substr($request->email, 0, 3).substr($request->name, 0, 3);
        if($request->password){
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            
        }
        else{
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }

        return redirect()->route('akun.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'berhasil menghapus data!');
    }
}
