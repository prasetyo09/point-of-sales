<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Cloudinary;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directInfo = 'user';
        $btnTitle = "Add New User";
        $btnUrl = route('user.create');
        $subtitle = "information regarding users";
        $title = "User";
        $users = User::with('role')->orderBy('id', 'ASC')->get();
        return view('user.index', compact('users', 'title', 'btnTitle', 'btnUrl', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        $title = "Add User";
        $subtitle = "Add user in accordance with the rules.";
        return view('user.create', compact('title', 'subtitle', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,',
            'role_id'  => 'required',
            'password' => 'nullable|min:6',
            'user_photo' => 'nullable|image|max:5120'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password,
        ];

        if ($request->hasFile('user_photo')) {
            // $data['user_photo'] = $request->file('user_photo')->store('users', 'public');
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('user_photo')->getRealPath(),
                [
                    'folder' => 'users',
                    'public_id' => 'user_' . $user->id . '_' . Str::uuid(),
                    'resource_type' => 'image',
                ]
            );

            $data['user_photo'] = $upload['secure_url'];
            $data['user_photo_public_id'] = $upload['public_id'];

            $newPublicId = $upload['public_id'];
        }

        User::create($data);
        return redirect()->to('user')->with('success', 'User successfully saved!');

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role_id' => $request->role_id,
        //     'password' => $request->password
        // ]);

        // return redirect()->to('user')->with('success', 'User successfully saved!');
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
    public function edit(string $id)
    {
        $roles = Role::get();
        $users = User::find($id);
        $title = "Edit User";
        $subtitle = "Edit the user in accordance with the rules.";
        return view('user.edit', compact('users', 'title', 'subtitle', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role_id'  => 'required',
            'password' => 'nullable|min:6',
            'user_photo' => 'nullable'
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'role_id' => $request->role_id
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $cloudinary = new Cloudinary();
        $newPublicId = null;

        if ($request->hasFile('user_photo'))
        {
            // if ($user->user_photo) {
            //     Storage::disk('public')->delete($user->user_photo);
            // }

            // $data['user_photo'] = $request->file('user_photo')->store('users', 'public');
            
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('user_photo')->getRealPath(),
                [
                    'folder' => 'users',
                    'public_id' => 'user_' . $user->id . '_' . Str::uuid(),
                    'resource_type' => 'image',
                ]
            );

            $data['user_photo'] = $upload['secure_url'];
            $data['user_photo_public_id'] = $upload['public_id'];

            $newPublicId = $upload['public_id'];
        }

        // $user->update($data);

        $oldPublicId = $user->user_photo_public_id;

        try {
            // Perbarui data user di database Aiven
            $user->update($data);

        } catch (\Throwable $e) {

            // Jika update database gagal, hapus foto baru
            if ($newPublicId) {
                $cloudinary->uploadApi()->destroy($newPublicId);
            }

            throw $e;
        }

        // Hapus foto lama setelah database berhasil diperbarui
        if ($newPublicId && $oldPublicId) {
            $cloudinary->uploadApi()->destroy($oldPublicId);
        }

        return redirect()->to('user')->with('success', 'User successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->to('user')->with('success', 'User successfully deleted!');
    }
}
