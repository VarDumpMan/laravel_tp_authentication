<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

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
        $categorie = new Categorie;
        $categorie->nom = $request->input('nom');
        $categorie->save();
        
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
        $category =Categorie::findOrFail($id);

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
    //     // Valide les données envoyées par le formulaire
    //     $request->validate([
    //     'nom' => 'required|string|max:255'
    // ]);

    // Met à jour les données de la catégorie
    $category = Categorie::findOrFail($id);
    $category->nom = $request->input('nom');
    $category->save();

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
    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();
       
    
        return redirect()->route('categorie.index')->with('success', 'Category deleted!');
    }
}
