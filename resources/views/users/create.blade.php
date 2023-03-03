@extends('dashboard')
@section('content')
    <h1>Ajouter un utilisateur</h1>

    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nom">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nom">Role</label>
            <select name="role" id="role" class="form-control">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nom }}</option>
                @endforeach
            </select>

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
