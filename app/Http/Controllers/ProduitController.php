<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits =Produit::all();

    return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        ['nom' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'prix' => 'required|string|max:255']
    );
    
    // Create a new produits in the database
    $produits = new Produit;
    $produits->nom = $request->nom;
    $produits->description = $request->description;
    $produits->prix = $request->prix;
    $produits->categorie_id = $request->categorie;
    $produits->save();

    return redirect()->route('produit.index')->with('success', 'Produit creé avec succès.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produit =Produit::findorfail($id);
        $categories = Categorie::all();
        return view('produits.edit', ['produit' => $produit, 'categories' => $categories]);    

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
        $this->validate($request,
        ['nom' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'prix' => 'required|string|max:255']
    );
    
    // Create a new produits in the database
    $produits = Produit::find($id);
    $produits->nom = $request->nom;
    $produits->description = $request->description;
    $produits->prix = $request->prix;
    $produits->categorie_id = $request->categorie;
    $produits->save();
    
    return redirect()->route('produit.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produits = Produit::find($id);
    $produits->delete();

    return redirect()->route('produit.index')->with('success', 'Produit supprimé avec succès.');

    }
}
