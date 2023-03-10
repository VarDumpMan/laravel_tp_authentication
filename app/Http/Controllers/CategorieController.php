<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $category = Categorie::all();
        return view('categories.index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = $request->user();

        $type_role_user = $user->role->where('nom', 'user');
        $type_role_admin = $user->role->where('nom', 'admin');
        $type_role_moderateur = $user->role->where('nom', 'moderateur');

        $isAdmin = $type_role_admin->count() > 0;
        $isUser = $type_role_user->count() > 0;
        $isModerateur = $type_role_moderateur->count() > 0;


        if ($isAdmin) {
            $categorie = new Categorie;
            $categorie->nom = $request->input('nom');
            $categorie->save();
        } else {
            return redirect()->route('categorie.index')->with('danger', 'Seul un admin peut créer de catégories.');;
        }

        return redirect()->route('categorie.index')->with('success', 'Catégorie creé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categorie::findOrFail($id);

        return view('categories.edit', ['category' => $category]);
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
        $user = $request->user();

        $type_role_user = $user->role->where('nom', 'user');
        $type_role_admin = $user->role->where('nom', 'admin');
        $type_role_moderateur = $user->role->where('nom', 'moderateur');

        $isAdmin = $type_role_admin->count() > 0;
        $isUser = $type_role_user->count() > 0;
        $isModerateur = $type_role_moderateur->count() > 0;

        if ($isAdmin) {
            // Met à jour les données de la catégorie
            $category = Categorie::findOrFail($id);
            $category->nom = $request->input('nom');
            $category->save();
        } else {
            return redirect()->route('categorie.index')
                ->with('danger', 'Seuls les admins peuvent mettre à jour.');
        }

        // Redirige vers la vue index avec un message de succès
        return redirect()->route('categorie.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        $type_role_user = $user->role->where('nom', 'user');
        $type_role_admin = $user->role->where('nom', 'admin');
        $type_role_moderateur = $user->role->where('nom', 'moderateur');

        $isAdmin = $type_role_admin->count() > 0;
        $isUser = $type_role_user->count() > 0;
        $isModerateur = $type_role_moderateur->count() > 0;

        if ($isAdmin) {
            // Met à jour les données de la catégorie
            $category = Categorie::findOrFail($id);
            $category->delete();
        } else {
            return redirect()->route('categorie.index')
                ->with('danger', 'Seuls les admins peuvent supprimer des catégories.');
        }

        return redirect()->route('categorie.index')->with('success', 'Category deleted!');
    }
}
