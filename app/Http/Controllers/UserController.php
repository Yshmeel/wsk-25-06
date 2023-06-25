<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postLogin(LoginRequest $request) {
        $username = $request->get('username');
        $password = $request->get('password');

        try {
            $user = Admin::query()->where('username', $username)->firstOrFail();

            if($user->password != $password) {
                throw new \Exception("invalid password");
            }

            Auth::login($user);
            return redirect('/');
        } catch(\Exception $e) {
            return redirect('/login')->with('error', 'User or password not correct');
        }
    }

    public function members() {
        $members = Member::all();

        return view('manage-members', [
            'members' => $members
        ]);
    }

    public function toggleMembership(int $id) {
        try {
            $member = Member::query()->where('id', $id)->firstOrFail();
            $member->is_activated = !$member->is_activated;
            $member->save();
        } catch(\Exception $e) {

        } finally {
            return redirect('/members');
        }
    }
}
