@extends('dashboard')
@section('content')
    <h1>Ajouter un produit</h1>

<form method="POST" action="{{ route('produit.store') }}">
    @csrf
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
        @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

   

    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control @error('prix') is-invalid @enderror" id="prix" name="prix" value="{{ old('prix') }}" required>
        @error('prix')
                <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="categorie">Catégorie</label>
        <select name="categorie" id="categorie_id" class="form-control @error('categorie') is-invalid @enderror" id="categorie" name="categorie" value="{{ old('categorie') }}" required>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
            @endforeach
        </select>
        @error('categorie')
        <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea  class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required></textarea>
        @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
        
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
