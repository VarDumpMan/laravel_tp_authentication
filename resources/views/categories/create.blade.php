@extends('dashboard')
@section('content')
    <h1>Ajouter une catégorie</h1>

    <form method="POST" action="{{ route('categorie.store') }}">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
