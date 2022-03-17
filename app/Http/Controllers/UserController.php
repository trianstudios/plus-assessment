<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        try{
            $this->authorize('index', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }
        $users = User::whereKeyNot(auth()->id())->latest()->with('roles')->paginate(8);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        try{
            $this->authorize('create', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(RegistrationRequest $request)
    {
        try{
            $this->authorize('store', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }

        if(!$user = User::create($request->validated())){
            notify()->error('User could not be registered. Please check your information and try again.');
            return back();
        }

        $user->roles()->attach($request->roles);

        event(new Registered($user));

        notify()->success('User has been registered.');

        return $this->returnHome();
    }

    public function show(User $user)
    {
        try{
            $this->authorize('show', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        try{
            $this->authorize('update', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(RegistrationRequest $request, User $user)
    {
        try{
            $this->authorize('update', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }

        $data = $request->validated();

        $user->roles()->detach();

        if($data['password'] !== null){
            $postData = collect($data)->except('email');
        }else{
            $postData = collect($data)->except(['email', 'password']);
        }

        if(!$user->update($postData->toArray())){
            notify()->error('User could not be updated. Please check your information and try again.');
            return back();
        }

        $user->roles()->attach($request->roles);

        notify()->success('User details were updated.');

        return $this->returnHome();
    }

    public function destroy(User $user)
    {
        try{
            $this->authorize('destroy', auth()->user());
        }catch(\Exception $e){
            notify()->error($e->getMessage());
            return back();
        }
    }

    private function returnHome(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }
}
