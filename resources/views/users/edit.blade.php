@extends('dashboard')
@section('content')
    <h1>Ajouter un utilisateur</h1>

    <form method="POST" action="{{ route('user.update', $encryption_id) }}">
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
            <label for="nom">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ $email }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $email }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nom">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                value="" required>
            @error('password')
                <div class="invalid-feedback"></div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nom">Confirm Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                value="" required>
            @error('password')
                <div class="invalid-feedback"></div>
            @enderror
        </div>

    

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
