@extends('dashboard')
@section('content')
    <h1>Liste des catégories</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categorie.create') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
            
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->nom }}</td>
                 
                    <td>
                        <a href="{{ route('categorie.edit', $category->id) }}" class="btn btn-secondary">Modifier</a>
                        <form action="{{ route('categorie.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
