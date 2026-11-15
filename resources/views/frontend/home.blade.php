@extends('frontend.layout.master')

@section('content')
    <!-- LEFT COLUMN -->
    <section class="grid-col col-left">
        <!-- Card: Mission Readiness -->
        @include('frontend.home-sections.mission-readiness')

        <!-- Card: NASA's 5 Hazards (Dynamic) -->
        @include('frontend.home-sections.hazards')
    </section>

    <!-- CENTER STAGE -->
    <section class="grid-col col-center">
        @include('frontend.home-sections.astronaut')

        <!-- Health Trends (kept mostly static for visual) -->
        @include('frontend.home-sections.health-trends')
    </section>

    <!-- RIGHT COLUMN -->
    <section class="grid-col col-right">
        <!-- Health Status -->
        @include('frontend.home-sections.health-status')

        <!-- Action Guidance -->
        @include('frontend.home-sections.action-guide')
    </section>
@endsection
