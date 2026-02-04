@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($pet->image)
                        <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="img-thumbnail w-100">
                    @else
                        <div class="bg-light border rounded text-center p-5">
                            <i class="bi bi-image" style="font-size:3rem; color:#ccc;"></i>
                            <p class="text-muted mt-2">Sin imagen</p>
                        </div>
                    @endif
                </div>
                
                <div class="col-md-8">
                    <h1>{{ $pet->name }}</h1>
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Especie</h6>
                            <p class="fs-5">{{ $pet->species }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Raza</h6>
                            <p class="fs-5">{{ $pet->breed ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Edad</h6>
                            <p class="fs-5">{{ $pet->age ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Sexo</h6>
                            <p class="fs-5">
                                @if($pet->sex == 'male')
                                    🐕 Macho
                                @elseif($pet->sex == 'female')
                                    🐩 Hembra
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    @if($pet->description)
                        <div class="mb-3">
                            <h6 class="text-muted">Descripción</h6>
                            <p>{{ $pet->description }}</p>
                        </div>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ route('pets.edit', $pet) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta mascota?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection