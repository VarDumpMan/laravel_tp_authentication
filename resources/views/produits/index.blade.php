@extends('dashboard')
@section('content')
<h1>Liste des produits</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('produit.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Categorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produits as $produit)
    <tr>
        <td>{{ $produit->id }}</td>
        <td>{{ $produit->nom }}</td>
        <td>{{ $produit->description }}</td>
        <td>{{ $produit->prix }}</td>
        <td>{{ $produit->categorie->nom }}</td>
        <td>
            <a href="{{ route('produit.edit', $produit->id) }}" class="btn btn-secondary">Modifier</a>
            <form  id ="delete_form" action="{{ route('produit.destroy', $produit->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button onclick="confirmDelete()" class="btn btn-danger">Supprimer</button>
            </form>
            
        </td>
    </tr>
@endforeach
    </tbody>
</table>
@endsection
<script>
                function confirmDelete() {
                    if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
                        document.getElementById('delete-form').submit();
                    }
                }
            </script>