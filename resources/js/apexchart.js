import ApexCharts from "apexcharts";

function initializeHealthTrendsChart() {
    const chartElement = document.getElementById("healthTrendsChart");

    if (!chartElement) {
        return;
    }

    const chartData = JSON.parse(chartElement.dataset.chart || "{}");

    if (!chartData.labels?.length) {
        chartElement.textContent = "Submit an assessment to see health trends.";
        return;
    }

    const chart = new ApexCharts(chartElement, {
        chart: {
            type: "line",
            height: "100%",
            toolbar: { show: false },
            zoom: { enabled: false },
            animations: { enabled: false },
            background: "transparent",
        },
        series: chartData.series,
        colors: ["#e879f9", "#38bdf8", "#22d3ee", "#34d399"],
        stroke: {
            curve: "smooth",
            width: 2,
        },
        markers: {
            size: 3,
            strokeWidth: 0,
            hover: { size: 5 },
        },
        grid: {
            borderColor: "rgba(148, 163, 184, 0.16)",
            strokeDashArray: 4,
            padding: { top: 4, right: 8, bottom: 0, left: 8 },
        },
        xaxis: {
            categories: chartData.labels,
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: [
            { min: 40, max: 100, show: false },
            { min: 0, max: 10, show: false },
            { min: 60, max: 100, show: false },
            { min: 36, max: 37.2, show: false },
        ],
        legend: { show: false },
        tooltip: {
            theme: "dark",
            shared: false,
        },
        noData: {
            text: "Submit an assessment to see health trends.",
        },
    });

    chart.render();
}

initializeHealthTrendsChart();
