<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NASA | Astronaut Biometric & Mission Readiness Telemetry</title>

    <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css" />

    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <!-- Google Fonts: Orbitron, Rajdhani, Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@600;700;800;900&family=Rajdhani:wght@500;600;700&display=swap"
        rel="stylesheet"
    />

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Custom CSS -->

    @vite([
        'resources/css/app.css',
        'resources/css/tabler.css',
        'resources/css/tabler.min.css',
    ])
</head>

<body class="space-theme">
    <!-- Cosmic Background Layers -->
    <div class="space-bg-layer" id="space-bg" style="background-image: url('{{ asset('assets/back.png') }}');"></div>
    <div class="space-vignette"></div>
    <div class="stars-canvas-container">
        <canvas id="stars-canvas"></canvas>
    </div>

    <!-- Main Dashboard App Container -->
    <div class="app-layout">
        <!-- TOP HEADER -->
        @include('frontend.layout.header')

        <!-- MAIN 3-COLUMN DASHBOARD GRID -->
        <main class="hud-main-grid">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('frontend.layout.footer')
    </div>

    <!-- Global AJAX Modal (used by hazards, questionnaire, surgeon) -->
    <div class="modal fade" id="modal-global" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content glass-modal-content">
                <div class="modal-body py-5 text-center">
                    <div class="spinner-border text-info" role="status" aria-label="Loading"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div class="toast-container" id="toast-container"></div>

    <!-- Libraries -->
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (used by the shared modal and form handlers) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <!-- Custom Logic -->
    @vite(['resources/js/app.js', 'resources/js/apexchart.js'])
</body>
</html>
