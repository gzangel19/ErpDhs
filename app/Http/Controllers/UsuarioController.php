<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Deposito;
use App\Cajas;
use App\Unidad_Negocio;
use App\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request)
    {
        
        $searchText = $request->searchText;

        $status = $request->status;

        if($searchText):

                if($status):

                        $usuarios = User::where('estado',$status)->orderBy('apellido', 'ASC')->paginate(100);
                         
                else:
                    
                        $usuarios = User::where('apellido',$searchText)->orderBy('apellido', 'ASC')->paginate(25);

                endif;
        else:

            if($status):

                    $usuarios = User::where('estado',$status)->orderBy('apellido', 'ASC')->paginate(100);
                   
            else:
                    
                    $usuarios = User::orderBy('apellido', 'ASC')->paginate(25);
            endif;

        endif;

        return view('usuarios.index',compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::get();
        $unidadNegocios = Unidad_Negocio::All();
        return view('usuarios.create',compact('roles','unidadNegocios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->username = $request->username;
        $user->password =bcrypt($request->password);
        $user->email = $request->email;
        $user->tipo = $request->tipo;
       // $user->telefono_celular = $request->telefono_celular;
       // $user->telefono_fijo = $request->telefono_fijo;
       // $user->domicilio = $request->domicilio;
        $user->pagina_principal = 'home';
        $user->save();

        //$rolUser = new RoleUser();
        //$rolUser->role_id = $request->rol;
        //$rolUser->user_id = $user->id;
        //$rolUser->save();

        if (isset($request->rol) && $request->rol != 0) {
           // $user->assignRole('Super Administrador');
           $user->assignRole('vendedor');
        }

        if( count($request->unidadnegocio_id)  > 0 ){
            foreach ($request->unidadnegocio_id as $value) {
                $user->unidades_negocios()->attach($value);
            }
        }

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function editPerfil()
    {
        $usuario = User::find(auth()->id());

        return view('usuarios.editPerfil', compact('usuario'));
    }

    public function updatePerfil(Request $request)
    {
        $usuario = User::find(auth()->id());
        
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->username = $request->username;
        $usuario->email = $request->email;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $usuario->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/perfil');
            $request->img->move($destino,$uniqueFileName);         
            $usuario->imagen_perfil = $uniqueFileName;
       }

       $usuario->save();

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        
        $roles = Role::get();
        
        $unidadNegocios = Unidad_Negocio::All();

        $userUnidadNegocios = $usuario->unidades_negocios;//trae desde el metodo de la relacion

        return view('usuarios.edit',compact('usuario','roles','unidadNegocios','userUnidadNegocios'));
        
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->nombre = $request->name;
        $usuario->email = $request->email;
        if (isset($request->password) && $request->password != "") {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();

        $asignacionRol = RoleUser::where('user_id',$usuario->id)->first();

        if($request->rol != 0){
            
            $asignacionRol->role_id = $request->rol;
            $asignacionRol->user_id = $usuario->id;
            $asignacionRol->save();
        }
    
        return redirect()->route('usuarios.index')->with('success','Usuario Editado correctamente');
    }

    public function inactivo($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = 'baja';
        $usuario->save();
    
        return redirect()->route('usuarios.index')->with('success','Usuario Editado correctamente');
    }

    public function activo($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = 'activo';
        $usuario->save();
    
        return redirect()->route('usuarios.index')->with('success','Usuario Editado correctamente');
    }

    public function getPermisos($id){
        
        $user = User::findOrFail($id);

        $data = ['user' => $user];

        return view('usuarios.permisos', $data);

    }

    public function postPermisos(Request $request,$id){

        $user = User::findOrFail($id);

        $user->permisosERP = $request->except(['_token']);

        if($user->save()):
                    
            return back()->with('message','Los Permisos del Usuario fueron actualizados')->with('typealert','success');
        
        endif;
    }
    
    public function seleccionarDeposito()
    {
        $cajas = Cajas::orderBy('id', 'DESC')->paginate(10);

        return view('usuarios.cambiarDeposito',compact('cajas'));
    }

    public function updateDeposito($id)
    {

        $usuario = User::findOrFail(Auth::user()->id);
        $usuario->caja_id = $id;
        $usuario->save();
        return redirect()->route('home');
    
    }




}
