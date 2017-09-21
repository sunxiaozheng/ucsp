<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Controller
{

    /**
     * backend homepage
     * @param Request $request
     * @return mix
     * @version 1.0.0.0921
     */
    public function index()
    {
        return view('backend.index', ['captcha' => captcha_src()]);
    }

    /**
     * @param Request $request
     * @return type
     * @version 1.0.0.0921
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => ':attribute 不能为空',
                'alpha' => ':attribute 必须包含字母',
                'between' => ':attribute 长度为6-12位',
                'captcha' => ':attribute 错误',
            ];

            $rules = [
                'captcha' => 'required|captcha',
                'username' => 'required|alpha_num|min:2',
                'password' => 'required|alpha_num|between:6,12',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect('/admin')->withErrors($validator)->withInput();
            } else {
//                $username = $request->input('username');
//                $password = $request->input('password');
//                // 获取用户token
//                $token = User::where('name', $username)->value('remember_token');
//                $pwd = sha1($password . $token);

                // 用户验证
//                if (Auth::attempt(['name' => $username, 'password' => $pwd])) {
////                    return redirect('/');
//                    echo 111;
//                    exit(0);
//                }
            }
        } else {
            return view('backend.login');
        }
    }

}
