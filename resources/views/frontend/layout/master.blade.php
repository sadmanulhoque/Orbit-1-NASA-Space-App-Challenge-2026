<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NASA | Astronaut Biometric & Mission Readiness Telemetry</title>

    <!-- Google Fonts: Orbitron, Rajdhani, Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@600;700;800;900&family=Rajdhani:wght@500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])
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

        <!-- ===================== QUESTIONNAIRE MODAL ===================== -->
        @include('frontend.modals.ques-modal')

        <!-- Flight Surgeon Modal -->
        @include('frontend.modals.surgeon-modal')


        <!-- Hazards Details Modal -->
        @include('frontend.modals.hazards-modal')

        <!-- Footer -->
        @include('frontend.layout.footer')
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div class="toast-container" id="toast-container"></div>

    <!-- Libraries -->
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Logic -->
    @vite(['resources/js/app.js'])
</body>

</html>
