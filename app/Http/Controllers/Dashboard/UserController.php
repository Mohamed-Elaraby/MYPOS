<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\addUpdateUsersRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\ImageFacades\Image;


class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:create_users')->only('create');
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:update_users')->only('edit');
        $this->middleware('permission:delete_users')->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request){

                return $q->when($request->search, function ($query) use ($request){

                    return $query->where('first_name', "like", "%" . $request->search . "%")

                        ->orWhere('last_name', "like", "%" . $request->search . "%");

                });
        })->latest()->paginate(3);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            "first_name" => 'required|string',
            "last_name" => 'required|string',
            "email" => 'required|email',
            "password" => 'required|confirmed',
            "image" => 'image',
            "permissions" => 'array|required|min:1'
        ]);
        $validatedData = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $validatedData['password'] = bcrypt($request->password);

        if ($request->image){
            $imageName = $request->image->getClientOriginalName();
            Image::make($request->file('image'))
                ->resize(300, null, function ($comprission){
                    $comprission->aspectRatio();
                })
                ->insert(public_path('images/watermark.png'), 'center')
                ->save(public_path('images/'.$imageName),100);
                $validatedData['image'] = $imageName;
        }


        $user = User::create($validatedData);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        return redirect(route('dashboard.user.index'))->with('success', 'Added Successfully');

    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(addUpdateUsersRequest $request, User $user)
    {
//        $request->validate([
//            "first_name" => 'required|string',
//            "last_name" => 'required|string',
//            "email" => ['required', Rule::unique('users')->ignore($user->id)],
//            "image" => 'image',
//            "permissions" => 'array|required|min:1'
//        ]);

        $validatedData = $request->except(['permissions', 'image']);
        if ($request->image){
            if ($user->image != 'default.png'){
                Storage::disk('public_images')->delete($user->image);
            }
            $imageName = $request->image->getClientOriginalName();
            Image::make($request->file('image'))
                ->resize(300, null, function ($comprission){
                    $comprission->aspectRatio();
                })
                ->insert(public_path('images/watermark.png'), 'center')
                ->save(public_path('images/'.$imageName),100);
            $validatedData['image'] = $imageName;
        }
//        $validatedData['image'] = $request->image == '' ? $user->image : $imageName;
//        dd($validatedData);
        $user->update($validatedData);
        $user->syncPermissions($request->permissions);
        return redirect(route('dashboard.user.index'))->with('info', 'Edit Successfully');
    }

    public function downloadImage(Request $request)
    {
//        dd($request->imageName);
        return Storage::disk('public_images')->download($request->imageName);
    }

    public function destroy(User $user)
    {
        if ($user->image != 'default.png'){
            Storage::disk('public_images')->delete($user->image);
        }
        $user->delete();
        return redirect()->back();
    }


}
