<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = User::all();
        return view('home', compact('users'));
    }

    public function add(Request $request)
    {

        $fecha_nacimiento = Carbon::parse($request['birthday']);
        $edad = $fecha_nacimiento->diffInYears(Carbon::now());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->age = $edad;
        $user->save();


        return back()->with('success', '¡Usuario creado con exito!');
    }

    public function edit(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->age = Carbon::parse($user->birthday)->diffInYears(Carbon::now());
        $user->save();
        return back()->with('success', '¡El registro ha sido modificado con exito!');
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id)->delete();

        return back()->with('success', '¡El registro ha sido eliminado con exito!');
    }
}
