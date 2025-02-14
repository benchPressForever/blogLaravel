<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Symfony\Component\Console\Input\Input;

class AdminUsersController extends Controller{

    public function index()
    {
        $users = User::query()->orderBy('is_admin','desc')->paginate(5);

        return view('admin.users.index',['users' => $users]);

    }

    public function edit(User $user)
    {
        return view('admin.users.edit',['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if(!$request->get('is_admin')){
            $data['is_admin'] = 0;
        }

        try{
            $user->update($data);
        }
        catch(\Exception $e){
            return redirect()->route('admin.users.index')->with('error',"Не удалось обновить пользователя!");
        }
        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлён!');

    }

    public function delete(User $user)
    {
        try{
            $user->delete();
        }
        catch(\Exception $e){
            return redirect()->route('admin.users.index')->with('error',"Не удалось удалить пользователя!");
        }
        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удалён!');
    }

    public function changeAdmin(User $user){
        try{
            if($user->is_admin){
                $user->update(['is_admin' => 0]);
            }
            else{
                $user->update(['is_admin' => 1]);
            }

        }catch (
            \Exception $e
        ){
            return redirect()->route('admin.users.index')->with('error',"Не удалось изменить роль пользователя!");
        }
        return redirect()->route('admin.users.index')->with('success', 'Успешно изменёна роль пользователя!');
    }

}
