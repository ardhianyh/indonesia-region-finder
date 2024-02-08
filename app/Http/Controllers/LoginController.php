<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index()
   {
      return view('login');
   }

   public function login(Request $request)
   {
      try {
         $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
         ]);

         if (!Auth::attempt($credentials)) {
            return $this->responseJson(
               'error',
               401,
               'Invalid Credentials',
               null
            );
         }

         $request->session()->regenerate();
         return response()->redirectTo('/')->cookie('data-source', 'local', 60);
      } catch (\Throwable $th) {
         return $this->responseJSON(
            'error',
            500,
            $th->getMessage(),
            null
         );
      }
   }
}
