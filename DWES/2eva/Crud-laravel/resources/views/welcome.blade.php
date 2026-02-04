<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestor de Mascotas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
        <style>
            body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
            .card { border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
            .btn-lg { font-weight: bold; border-radius: 8px; }
            .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
            .btn-primary:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
            .btn-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; }
            .btn-success:hover { background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="bi bi-heart-fill text-danger" style="font-size:3rem;"></i>
                            </div>
                            <h1 class="card-title mb-2">Gestor de Mascotas</h1>
                            <p class="text-muted mb-4">Registra y gestiona a tus amigos animales en un solo lugar</p>

                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-lg btn-primary">Ir al Inicio</a>
                                @else
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary">🔐 Iniciar Sesión</a>
                                        <a href="{{ route('register') }}" class="btn btn-lg btn-success">✨ Registrarse</a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
