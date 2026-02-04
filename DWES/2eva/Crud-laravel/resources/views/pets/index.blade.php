@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Mis Mascotas</h1>
        <a href="{{ route('pets.create') }}" class="btn btn-primary">+ Registrar mascota</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pets->count())
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Edad</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td style="width:100px">
                                @if($pet->image)
                                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="img-thumbnail" style="max-width:80px">
                                @endif
                            </td>
                            <td>{{ $pet->name }}</td>
                            <td>{{ $pet->species }}</td>
                            <td>{{ $pet->age ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('pets.show', $pet) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('pets.edit', $pet) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta mascota?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pets->links() }}
    @else
        <div class="text-center py-5">
            <div style="font-size:4rem; margin-bottom:20px;">🐾</div>
            <h3 class="text-muted mb-2">Aún no tienes mascotas registradas</h3>
            <p class="text-muted mb-4">¡Registra a tu primer amigo animal ahora!</p>
            <a href="{{ route('pets.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> Registrar tu primera mascota
            </a>
        </div>
    @endif
</div>
@endsection