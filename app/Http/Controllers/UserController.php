<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            "items" => User::all(),
        ];

        return view("users.index", $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            "items" => Role::all(),
        ];

        return view("users.create", $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
            "name" => "required|string|max:100",
            "email" => "required|string|max:100",
            "role" => "required|string|max:100",
        ]);

        $user_exists = User::where("email", $request["email"])->count() == 0;

        if ($user_exists) {

            $user = new User();
            $user->name = $request["name"];
            $user->email = $request["email"];

            $role = Role::where("id", $request['role']);

            $isRole = $role->count() == 1;

            if ($isRole) {
                
                if ($user->save()) {

                    $user_role = new RoleUser();
                    $user_save = User::where("email", $request["email"]);

                    $user_role->user_id = ($user_save->count() > 0) ? $user_save->get()[0]->id : 0;
                    $user_role->role_id = $role->get()[0]->id;

                    // Enregistrement des roles
                    $user_role->save();

                    $datas = [

                        "admin" => $request->user()->email,
                        "encryption_id" => Crypt::encrypt($user->id),
                        "email" => $user->email 

                    ];

                    //Mail::to($user->email)->send(new ContactMail($datas));

                    $status = Password::sendResetLink(
                        $request->only('email')
                    );

                    if($status == Password::RESET_LINK_SENT)
                    {
                        return back()->with("success", "Utilisateur " . $user->name . " enregistré avec succès ! Le mail de réinitialisation de mot de passe lui a été envoyé !");
                    }
                }
            }
        }

        return back()->with("danger", "Nous n'avons pas pu enregistrer cet utilisateur !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $encryption_id
     * @return \Illuminate\Http\Response
     */
    public function edit($encryption_id, $email)
    {
        $id = $encryption_id;

        $email = $email;//$request->input("email");

        return view("users.edit", compact("id", "email"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route("user.index")->with("success", "Suppression effectuée avec succès !");
    }
}
