<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            if (!Session::has('usuario')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return datatables()->of(Usuario::all())
                ->addColumn('option', function ($usuario) {
                    return view('usuarios.option', compact('usuario'));
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $perfiles = Perfil::all();
        return view('usuarios.index', compact('perfiles'));
    }

    public function store(Request $request)
    {
        $usuarioId = $request->id;

        $datosUsuario = [
            'dni' => $request->dni,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'celular' => $request->celular,
            'perfil_id' => $request->perfil,
        ];

        if ($request->password != null) {
            $datosUsuario['password'] = Hash::make($request->password);
        }

        $usuario = Usuario::updateOrCreate(
            ['id' => $usuarioId],
            $datosUsuario
        );

        return response()->json($usuario);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $usuario  = Usuario::where($where)->first();

        return Response()->json($usuario);
    }

    public function destroy(Request $request)
    {
        $usuario = Usuario::where('id', $request->id)->delete();

        return Response()->json($usuario);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $usuario = Usuario::where('correo', $email)->first();
        if ($usuario) {
            if (Hash::check($password, $usuario->password)) {
                Session::put('usuario', $usuario->toArray());

                return Response()->json('success');
            }
        }
        return Response()->json('error');
    }

    public function logout()
    {
        Session::forget('usuario');
        return redirect('/iniciar-sesion');
    }
}
