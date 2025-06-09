import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

Chart.register(ChartDataLabels);

window.chartData = null;

document.addEventListener("livewire:init", () => {
    // Listen untuk event chartDataWarga dari Livewire
    Livewire.on("chartDataWarga", (data) => {
        console.log("Data diterima dari Livewire:", data);

        // Simpan data ke window object
        window.chartData = data[0]; // Livewire mengirim array, ambil elemen pertama

        // Render charts setelah data tersedia
        if (window.chartData) {
            renderchartWargaWNA();
            renderchartWargaWNI();
            renderTotalWarga();
        }
    });
});

function renderchartWargaWNA() {
    const ctx = document.getElementById("chartWargaWNA");
    if (!ctx) return;

    const data = [window.chartData?.WNA?.L ?? 0, window.chartData?.WNA?.P ?? 0];

    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [
                {
                    label: "Jumlah Warga WNA",
                    data: data,
                    backgroundColor: [
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(255, 99, 132, 0.7)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                datalabels: {
                    color: "#000",
                    anchor: "end",
                    align: "end",
                    formatter: (value) => `${value}`,
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                },
            },
        },
        plugins: [ChartDataLabels],
    });

    document.getElementById("wna-male").textContent = data[0];
    document.getElementById("wna-female").textContent = data[1];
    document.getElementById("summary-wna").textContent = data[0] + data[1];
}

function renderchartWargaWNI() {
    const ctx = document.getElementById("chartWargaWNI");
    if (!ctx) return;

    const data = [window.chartData?.WNI?.L ?? 0, window.chartData?.WNI?.P ?? 0];
    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [
                {
                    label: "Jumlah Warga WNI",
                    data: data,
                    backgroundColor: [
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(255, 99, 132, 0.7)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                datalabels: {
                    color: "#000",
                    anchor: "end",
                    align: "end",
                    formatter: (value) => `${value}`,
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                },
            },
        },
        plugins: [ChartDataLabels],
    });

    document.getElementById("wni-male").textContent = data[0];
    document.getElementById("wni-female").textContent = data[1];
    document.getElementById("summary-wni").textContent = data[0] + data[1];
}

function renderTotalWarga() {
    const ctx = document.getElementById("chartTotalWarga");
    if (!ctx) return;

    const data = [
        window.chartData?.TOTAL?.L ?? 0,
        window.chartData?.TOTAL?.P ?? 0,
    ];
    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [
                {
                    label: "Total Warga",
                    data: data,
                    backgroundColor: [
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(255, 99, 132, 0.7)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                datalabels: {
                    color: "#000",
                    anchor: "end",
                    align: "end",
                    formatter: (value) => `${value}`,
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                },
            },
        },
        plugins: [ChartDataLabels],
    });

    document.getElementById("total-male").textContent = data[0];
    document.getElementById("total-female").textContent = data[1];
    document.getElementById("summary-total").textContent = data[0] + data[1];
}

// function renderChartKelahiran() {
//     const ctx = document.getElementById("chartKelahiran");
//     if (!ctx) return;

//     const years = ["2020", "2021", "2022", "2023", "2024", "2025"];
//     const maleData = [15, 21, 26, 19, 24, 26];
//     const femaleData = [19, 17, 20, 16, 29, 29];

//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: years,
//             datasets: [
//                 {
//                     label: "Laki-laki",
//                     data: maleData,
//                     backgroundColor: "rgba(34, 211, 238, 0.8)",
//                     borderColor: "rgba(34, 211, 238, 1)",
//                     borderWidth: 1,
//                 },
//                 {
//                     label: "Perempuan",
//                     data: femaleData,
//                     backgroundColor: "rgba(244, 114, 182, 0.8)",
//                     borderColor: "rgba(244, 114, 182, 1)",
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             indexAxis: "y",
//             scales: {
//                 x: {
//                     beginAtZero: true,
//                     max: 30,
//                 },
//             },
//             plugins: {
//                 legend: {
//                     display: false,
//                 },
//                 datalabels: {
//                     anchor: "end",
//                     align: "end",
//                     color: "#000",
//                     font: {
//                         weight: "bold",
//                         size: 10,
//                     },
//                     formatter: (value) => value,
//                 },
//             },
//         },
//         plugins: [ChartDataLabels],
//     });
// }

// function renderChartKematian() {
//     const ctx = document.getElementById("chartKematian");
//     if (!ctx) return;

//     const years = ["2020", "2021", "2022", "2023", "2024", "2025"];
//     const maleData = [10, 18, 13, 12, 21, 9];
//     const femaleData = [9, 7, 10, 19, 22, 14];

//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: years,
//             datasets: [
//                 {
//                     label: "Laki-laki",
//                     data: maleData,
//                     backgroundColor: "rgba(34, 211, 238, 0.8)",
//                     borderColor: "rgba(34, 211, 238, 1)",
//                     borderWidth: 1,
//                 },
//                 {
//                     label: "Perempuan",
//                     data: femaleData,
//                     backgroundColor: "rgba(244, 114, 182, 0.8)",
//                     borderColor: "rgba(244, 114, 182, 1)",
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             indexAxis: "y",
//             scales: {
//                 x: {
//                     beginAtZero: true,
//                     max: 30,
//                 },
//             },
//             plugins: {
//                 legend: {
//                     display: false,
//                 },
//                 datalabels: {
//                     anchor: "end",
//                     align: "end",
//                     color: "#000",
//                     font: {
//                         weight: "bold",
//                         size: 10,
//                     },
//                     formatter: (value) => value,
//                 },
//             },
//         },
//         plugins: [ChartDataLabels],
//     });
// }

// function renderChartGenerasi() {
//     const ctx = document.getElementById("chartGenerasi");
//     if (!ctx) return;

//     const generations = [
//         "Gen Alpha 2013-2024",
//         "Gen Z 1997-2012",
//         "Milenial 1981-1996",
//         "Gen X",
//         "Baby Boomer 1946-1964",
//         "Silent Generation 1928-1945",
//         "Lainnya",
//     ];

//     const data = [5936, 8553, 8431, 7139, 3456, 296, 4];

//     const colors = [
//         "rgba(34, 211, 238, 0.8)",
//         "rgba(59, 130, 246, 0.8)",
//         "rgba(99, 102, 241, 0.8)",
//         "rgba(139, 92, 246, 0.8)",
//         "rgba(168, 85, 247, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(239, 68, 68, 0.8)",
//     ];

//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: generations,
//             datasets: [
//                 {
//                     data: data,
//                     backgroundColor: colors,
//                     borderColor: colors.map((color) =>
//                         color.replace("0.8", "1")
//                     ),
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             indexAxis: "y",
//             scales: {
//                 x: {
//                     beginAtZero: true,
//                     max: 10000,
//                 },
//             },
//             plugins: {
//                 legend: {
//                     display: false,
//                 },
//                 datalabels: {
//                     anchor: "end",
//                     align: "end",
//                     color: "#000",
//                     font: {
//                         weight: "bold",
//                         size: 10,
//                     },
//                     formatter: (value) => value,
//                 },
//             },
//         },
//         plugins: [ChartDataLabels],
//     });
// }

// function renderChartPerkawinan() {
//     const ctx = document.getElementById("chartPerkawinan");
//     if (!ctx) return;

//     const categories = ["Belum Kawin", "Kawin", "Cerai Mati", "Cerai Hidup"];
//     const data = [16759, 14483, 1786, 790];

//     const colors = [
//         "rgba(34, 211, 238, 0.8)",
//         "rgba(37, 99, 235, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(79, 70, 229, 0.8)",
//     ];

//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: categories,
//             datasets: [
//                 {
//                     data: data,
//                     backgroundColor: colors,
//                     borderColor: colors.map((color) =>
//                         color.replace("0.8", "1")
//                     ),
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                     max: 20000,
//                 },
//             },
//             plugins: {
//                 legend: {
//                     display: false,
//                 },
//                 datalabels: {
//                     anchor: "end",
//                     align: "end",
//                     color: "#000",
//                     font: {
//                         weight: "bold",
//                         size: 10,
//                     },
//                     formatter: (value) => value,
//                 },
//             },
//         },
//         plugins: [ChartDataLabels],
//     });
// }

// function renderChartAgama() {
//     const ctx = document.getElementById("chartAgama");
//     if (!ctx) return;

//     const categories = [
//         "Islam",
//         "Kristen",
//         "Katolik",
//         "Hindu",
//         "Buddha",
//         "Konghucu",
//         "Lainnya",
//     ];
//     const data = [262, 143, 148, 119, 96, 104, 4];

//     const colors = [
//         "rgba(34, 211, 238, 0.8)",
//         "rgba(59, 130, 246, 0.8)",
//         "rgba(99, 102, 241, 0.8)",
//         "rgba(139, 92, 246, 0.8)",
//         "rgba(168, 85, 247, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(239, 68, 68, 0.8)",
//     ];

//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: categories,
//             datasets: [
//                 {
//                     data: data,
//                     backgroundColor: colors,
//                     borderColor: colors.map((color) =>
//                         color.replace("0.8", "1")
//                     ),
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                 },
//             },
//             plugins: {
//                 legend: {
//                     display: false,
//                 },
//                 datalabels: {
//                     anchor: "end",
//                     align: "end",
//                     color: "#000",
//                     font: {
//                         weight: "bold",
//                         size: 10,
//                     },
//                     formatter: (value) => value,
//                 },
//             },
//         },
//         plugins: [ChartDataLabels],
//     });
// }

// function renderChartPendidikan() {
//     const ctx = document.getElementById("chartPendidikan");
//     if (!ctx) return;

//     const generations = [
//         "S3",
//         "S2",
//         "S1",
//         "D4",
//         "D3",
//         "D2",
//         "D1",
//         "SMA",
//         "SMP",
//         "SD",
//         "Tidak Sekolah",
//     ];

//     const data = [25, 78, 423, 34, 359, 91, 84, 1723, 2710, 911, 182]; // lengkap dan urut

//     const colors = [
//         "rgba(30, 64, 175, 0.8)", // S3 - biru tua
//         "rgba(37, 99, 235, 0.8)", // S2 - biru
//         "rgba(59, 130, 246, 0.8)", // S1
//         "rgba(96, 165, 250, 0.8)", // D4
//         "rgba(129, 140, 248, 0.8)", // D3
//         "rgba(139, 92, 246, 0.8)", // D2
//         "rgba(168, 85, 247, 0.8)", // D1
//         "rgba(236, 72, 153, 0.8)", // SMA
//         "rgba(239, 68, 68, 0.8)", // SMP
//         "rgba(234, 179, 8, 0.8)", // SD
//         "rgba(107, 114, 128, 0.8)", // Tidak Sekolah
//     ];

//     new Chart(ctx, {
//         type: "bar",
//         data: {
//             labels: generations,
//             datasets: [
//                 {
//                     data,
//                     backgroundColor: colors,
//                     borderColor: colors.map((c) => c.replace("0.8", "1")),
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             indexAxis: "y",
//             scales: {
//                 x: {
//                     beginAtZero: true,
//                     max: 3000, // Sesuaikan jika jumlah data besar
//                     ticks: {
//                         stepSize: 500,
//                     },
//                 },
//             },
//             plugins: {
//                 legend: { display: false },
//                 datalabels: {
//                     anchor: "end",
//                     align: "end",
//                     color: "#000",
//                     font: {
//                         weight: "bold",
//                         size: 10,
//                     },
//                     formatter: (value) => value,
//                 },
//             },
//         },
//         plugins: [ChartDataLabels],
//     });
// }
