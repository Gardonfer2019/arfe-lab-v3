<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARFE Lab - Laboratorio Clínico</title>
    <!-- Importación de la tipografía Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos Personalizados -->
    <link rel="stylesheet" href="{{ asset('css/portal/styles.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/microscope.png') }}" type="image/png">

</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('images/Logo2 sin fondo.png') }}" alt="Logo de ARFE Lab" width="50" height="auto"> ARFE Lab
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/laboratorio')}}">ERP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Bienvenido a ARFE Lab</h1>
            <p class="lead">Tu laboratorio clínico confiable y de alta precisión</p>
            <a href="#servicios" class="btn btn-light btn-lg mt-3">Ver Servicios</a>
        </div>
    </header>

    <!-- Sección de Servicios -->
<section id="servicios" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Nuestros Servicios</h2>
        <div class="row text-center">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-vial fa-2x text-primary mb-3"></i>
                        <h5 class="card-title fw-bold">Hemogramas</h5>
                        <p class="card-text">Realizamos hemogramas completos para detectar cualquier anomalía en tu salud.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-syringe fa-2x text-success mb-3"></i>
                        <h5 class="card-title fw-bold">Pruebas de Glucosa</h5>
                        <p class="card-text">Monitoreamos tu nivel de glucosa para una mejor prevención de la diabetes.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-heartbeat fa-2x text-danger mb-3"></i>
                        <h5 class="card-title fw-bold">Perfil Lipídico</h5>
                        <p class="card-text">Controla tus niveles de colesterol y triglicéridos con nuestro perfil lipídico detallado.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-flask fa-2x text-warning mb-3"></i>
                        <h5 class="card-title fw-bold">Exámenes de Uroanálisis</h5>
                        <p class="card-text">Detecta posibles infecciones o condiciones en tu sistema urinario.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-baby fa-2x text-pink mb-3"></i>
                        <h5 class="card-title fw-bold">Pruebas de Embarazo</h5>
                        <p class="card-text">Realizamos pruebas de embarazo confiables y de alta precisión.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-dna fa-2x text-info mb-3"></i>
                        <h5 class="card-title fw-bold">Exámenes de Tiroides</h5>
                        <p class="card-text">Controla el funcionamiento de tu tiroides con nuestras pruebas específicas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Sección de Contacto -->
<section id="contacto" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Contacto</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" placeholder="Ingresa tu nombre">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" rows="3" placeholder="Tu mensaje aquí"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
                </form>
            </div>
        </div>
        <!-- Sección para WhatsApp -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 text-center">
                <p class="fw-bold">También puedes contactarnos a través de WhatsApp:</p>
                <a href="https://wa.me/50498237300" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp"></i> Contactar vía WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 ARFE Lab - Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
