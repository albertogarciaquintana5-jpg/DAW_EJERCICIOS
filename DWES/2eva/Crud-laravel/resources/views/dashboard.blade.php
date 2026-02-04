@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="h2 mb-4">
            <i class="bi bi-house"></i> Inicio - Gestor de Mascotas
        </h2>
        <div class="mb-5 text-center">
            <h1 class="mb-2">¡Bienvenido, {{ Auth::user()->name }}! 🐾</h1>
            <p class="lead text-muted">Aquí puedes gestionar a todos tus amigos animales</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card text-center shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <i class="bi bi-heart-fill text-danger" style="font-size:3rem;"></i>
                        <h5 class="card-title mt-3 mb-2">Mis Mascotas</h5>
                        <p class="text-muted small">Visualiza todas tus mascotas registradas</p>
                        <a href="{{ route('pets.index') }}" class="btn btn-primary btn-sm mt-3">
                            <i class="bi bi-arrow-right"></i> Ir
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card text-center shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <i class="bi bi-plus-circle text-success" style="font-size:3rem;"></i>
                        <h5 class="card-title mt-3 mb-2">Registrar Mascota</h5>
                        <p class="text-muted small">Añade una nueva mascota a tu colección</p>
                        <a href="{{ route('pets.create') }}" class="btn btn-success btn-sm mt-3">
                            <i class="bi bi-plus"></i> Ir
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card text-center shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <i class="bi bi-person-circle text-info" style="font-size:3rem;"></i>
                        <h5 class="card-title mt-3 mb-2">Mi Perfil</h5>
                        <p class="text-muted small">Gestiona tu información personal</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-info btn-sm mt-3">
                            <i class="bi bi-pencil"></i> Ir
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-primary border-0 rounded-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-3" style="font-size:1.5rem;"></i>
                <div>
                    <strong>💡 Consejo:</strong> Comienza registrando a tu primer amigo animal. Puedes subir una foto, especificar la raza, edad y más detalles de tu mascota.
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-effect {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
        }
    </style>
@endsection
