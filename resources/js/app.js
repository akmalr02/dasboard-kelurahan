import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

Chart.register(ChartDataLabels);

window.chartData = null;

document.addEventListener("livewire:init", () => {
    Livewire.on("chartDataWarga", (data) => {
        console.log("Data diterima dari Livewire:", data);

        window.chartData = data[0];

        if (window.chartData) {
            renderchartWargaWNA();
            renderchartWargaWNI();
            renderTotalWarga();
            renderChartKelahiran();
            renderChartKematian();
            renderChartGenerasi();
            renderChartPerkawinan();
            renderChartAgama();
            renderChartPendidikan();
        }
    });
});

function renderchartWargaWNA() {
    const ctx = document.getElementById("chartWargaWNA");
    if (!ctx) return;

    const dataWNA = [
        window.chartData?.WNA?.L ?? 0,
        window.chartData?.WNA?.P ?? 0,
    ];

    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [
                {
                    label: "Jumlah Warga WNA",
                    data: dataWNA,
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

    document.getElementById("wna-male").textContent = dataWNA[0];
    document.getElementById("wna-female").textContent = dataWNA[1];
    document.getElementById("summary-wna").textContent =
        dataWNA[0] + dataWNA[1];
}

function renderchartWargaWNI() {
    const ctx = document.getElementById("chartWargaWNI");
    if (!ctx) return;

    const dataWNI = [
        window.chartData?.WNI?.L ?? 0,
        window.chartData?.WNI?.P ?? 0,
    ];

    // console.log(dataWNI);
    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [
                {
                    label: "Jumlah Warga WNI",
                    data: dataWNI,
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

    document.getElementById("wni-male").textContent = dataWNI[0];
    document.getElementById("wni-female").textContent = dataWNI[1];
    document.getElementById("summary-wni").textContent =
        dataWNI[0] + dataWNI[1];

    // console.log("wni", dataWNI[0] + dataWNI[1]);
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

function renderChartKelahiran() {
    const ctx = document.getElementById("chartKelahiran");
    if (!ctx) return;

    const years = Object.keys(window.chartData?.dataKelahiran || {});

    const kelahiranL = [
        window.chartData?.dataKelahiran?.[2021]?.L ?? 0,
        window.chartData?.dataKelahiran?.[2022]?.L ?? 0,
        window.chartData?.dataKelahiran?.[2023]?.L ?? 0,
        window.chartData?.dataKelahiran?.[2024]?.L ?? 0,
        window.chartData?.dataKelahiran?.[2025]?.L ?? 0,
    ];
    const kelahiranP = [
        window.chartData?.dataKelahiran?.[2021]?.P ?? 0,
        window.chartData?.dataKelahiran?.[2022]?.P ?? 0,
        window.chartData?.dataKelahiran?.[2023]?.P ?? 0,
        window.chartData?.dataKelahiran?.[2024]?.P ?? 0,
        window.chartData?.dataKelahiran?.[2025]?.P ?? 0,
    ];

    // console.log("laki-laki", kelahiranL);
    // console.log("perempuan", kelahiranP);

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["2021", "2022", "2023", "2024", "2025"],
            datasets: [
                {
                    label: years,
                    data: kelahiranL,
                    backgroundColor: "rgba(34, 211, 238, 0.8)",
                    borderColor: "rgba(34, 211, 238, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Perempuan",
                    data: kelahiranP,
                    backgroundColor: "rgba(244, 114, 182, 0.8)",
                    borderColor: "rgba(244, 114, 182, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: "y",
            scales: {
                x: {
                    beginAtZero: true,
                    max: 30,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: "end",
                    align: "end",
                    color: "#000",
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                    formatter: (value) => `${value}`,
                },
            },
        },
        plugins: [ChartDataLabels],
    });
}

function renderChartKematian() {
    const ctx = document.getElementById("chartKematian");
    if (!ctx) return;

    const years = Object.keys(window.chartData?.dataKematian || {});

    const kematianL = [
        window.chartData?.dataKematian?.[2021]?.L ?? 0,
        window.chartData?.dataKematian?.[2022]?.L ?? 0,
        window.chartData?.dataKematian?.[2023]?.L ?? 0,
        window.chartData?.dataKematian?.[2024]?.L ?? 0,
        window.chartData?.dataKematian?.[2025]?.L ?? 0,
    ];
    const kematianP = [
        window.chartData?.dataKematian?.[2021]?.P ?? 0,
        window.chartData?.dataKematian?.[2022]?.P ?? 0,
        window.chartData?.dataKematian?.[2023]?.P ?? 0,
        window.chartData?.dataKematian?.[2024]?.P ?? 0,
        window.chartData?.dataKematian?.[2025]?.P ?? 0,
    ];

    // console.log("laki-laki", kematianL);
    // console.log("perempuan", kematianP);

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: years,
            datasets: [
                {
                    label: "Laki-laki",
                    data: kematianL,
                    backgroundColor: "rgba(34, 211, 238, 0.8)",
                    borderColor: "rgba(34, 211, 238, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Perempuan",
                    data: kematianP,
                    backgroundColor: "rgba(244, 114, 182, 0.8)",
                    borderColor: "rgba(244, 114, 182, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: "y",
            scales: {
                x: {
                    beginAtZero: true,
                    max: 30,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: "end",
                    align: "end",
                    color: "#000",
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                    formatter: (value) => `${value}`,
                },
            },
        },
        plugins: [ChartDataLabels],
    });
}

function renderChartGenerasi() {
    const ctx = document.getElementById("chartGenerasi");
    if (!ctx) return;

    const generations = [
        "Pre-Boomer",
        "Baby Boomer",
        "Generasi Alpha",
        "Generasi Beta",
        "Generasi X",
        "Generasi Y",
        "Generasi Z",
    ];

    const dataGenerasi = [
        window.chartData?.generasi?.["Pre-Boomer"] ?? 0,
        window.chartData?.generasi?.["Baby Boomer"] ?? 0,
        window.chartData?.generasi?.["Generasi Alpha"] ?? 0,
        window.chartData?.generasi?.["Generasi Beta"] ?? 0,
        window.chartData?.generasi?.["Generasi X"] ?? 0,
        window.chartData?.generasi?.["Generasi Y"] ?? 0,
        window.chartData?.generasi?.["Generasi Z"] ?? 0,
    ];

    // console.log(dataGenerasi);

    // console.log("Baby Boomer:", window.chartData?.generasi?.["Baby Boomer"]);
    // console.log(
    //     "Generasi Alpha:",
    //     window.chartData?.generasi?.["Generasi Alpha"]
    // );
    // console.log(
    //     "Generasi Beta:",
    //     window.chartData?.generasi?.["Generasi Beta"]
    // );
    // console.log("Generasi X:", window.chartData?.generasi?.["Generasi X"]);
    // console.log("Generasi Y:", window.chartData?.generasi?.["Generasi Y"]);
    // console.log("Generasi Z:", window.chartData?.generasi?.["Generasi Z"]);
    // console.log("Pre-Boomer:", window.chartData?.generasi?.["Pre-Boomer"]);

    const colors = [
        "rgba(34, 211, 238, 0.8)",
        "rgba(59, 130, 246, 0.8)",
        "rgba(99, 102, 241, 0.8)",
        "rgba(139, 92, 246, 0.8)",
        "rgba(168, 85, 247, 0.8)",
        "rgba(236, 72, 153, 0.8)",
        "rgba(239, 68, 68, 0.8)",
    ];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: generations,
            datasets: [
                {
                    data: dataGenerasi,
                    backgroundColor: colors,
                    borderColor: colors.map((color) =>
                        color.replace("0.8", "1")
                    ),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: "y",
            scales: {
                x: {
                    beginAtZero: true,
                    max: 200,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: "end",
                    align: "end",
                    color: "#000",
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                    formatter: (value) => `${value}`,
                },
            },
        },
        plugins: [ChartDataLabels],
    });
}

function renderChartPerkawinan() {
    const ctx = document.getElementById("chartPerkawinan");
    if (!ctx) return;

    const categories = ["Belum Kawin", "Kawin", "Cerai Mati", "Cerai Hidup"];
    const dataPerkawinan = [
        window.chartData?.perkawinan?.["Belum Kawin"] ?? 0,
        window.chartData?.perkawinan?.["Cerai Hidup"] ?? 0,
        window.chartData?.perkawinan?.["Cerai Mati"] ?? 0,
        window.chartData?.perkawinan?.["Kawin"] ?? 0,
    ];

    // console.log(dataPerkawinan);
    const colors = [
        "rgba(34, 211, 238, 0.8)",
        "rgba(37, 99, 235, 0.8)",
        "rgba(236, 72, 153, 0.8)",
        "rgba(79, 70, 229, 0.8)",
    ];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: categories,
            datasets: [
                {
                    data: dataPerkawinan,
                    backgroundColor: colors,
                    borderColor: colors.map((color) =>
                        color.replace("0.8", "1")
                    ),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1000,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: "end",
                    align: "end",
                    color: "#000",
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                    formatter: (value) => `${value}`,
                },
            },
        },
        plugins: [ChartDataLabels],
    });
}

function renderChartAgama() {
    const ctx = document.getElementById("chartAgama");
    if (!ctx) return;

    const categories = [
        "Islam",
        "Kristen",
        "Katolik",
        "Hindu",
        "Buddha",
        "Konghucu",
        "Lainnya",
    ];
    const dataAgama = [
        window.chartData?.agama?.["Islam"] ?? 0,
        window.chartData?.agama?.["Kristen"] ?? 0,
        window.chartData?.agama?.["Katolik"] ?? 0,
        window.chartData?.agama?.["Hindu"] ?? 0,
        window.chartData?.agama?.["Buddha"] ?? 0,
        window.chartData?.agama?.["Konghucu"] ?? 0,
        window.chartData?.agama?.["Lainnya"] ?? 0,
    ];

    // console.log(
    //     "Islam",
    //     window.chartData?.agama?.["Islam"] ?? 0,
    //     "Kristen",
    //     window.chartData?.agama?.["Kristen"] ?? 0,
    //     "Katolik",
    //     window.chartData?.agama?.["Katolik"] ?? 0,
    //     "Hindu",
    //     window.chartData?.agama?.["Hindu"] ?? 0,
    //     "Buddha",
    //     window.chartData?.agama?.["Buddha"] ?? 0,
    //     "Konghucu",
    //     window.chartData?.agama?.["Konghucu"] ?? 0,
    //     "Lainnya",
    //     window.chartData?.agama?.["Lainnya"] ?? 0
    // );

    const colors = [
        "rgba(34, 211, 238, 0.8)",
        "rgba(59, 130, 246, 0.8)",
        "rgba(99, 102, 241, 0.8)",
        "rgba(139, 92, 246, 0.8)",
        "rgba(168, 85, 247, 0.8)",
        "rgba(236, 72, 153, 0.8)",
        "rgba(239, 68, 68, 0.8)",
    ];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: categories,
            datasets: [
                {
                    data: dataAgama,
                    backgroundColor: colors,
                    borderColor: colors.map((color) =>
                        color.replace("0.8", "1")
                    ),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                datalabels: {
                    anchor: "end",
                    align: "end",
                    color: "#000",
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                    formatter: (value) => `${value}`,
                },
            },
        },
        plugins: [ChartDataLabels],
    });
}

function renderChartPendidikan() {
    const ctx = document.getElementById("chartPendidikan");
    if (!ctx) return;

    const tingkatan = [
        "S3",
        "S2",
        "S1",
        "D4",
        "D3",
        "D2",
        "D1",
        "SMA",
        "SMP",
        "SD",
        "Tidak Sekolah",
    ];

    const dataPendidikan = [
        window.chartData?.pendidikan?.["S3"] ?? 0,
        window.chartData?.pendidikan?.["S2"] ?? 0,
        window.chartData?.pendidikan?.["S1"] ?? 0,
        window.chartData?.pendidikan?.["D4"] ?? 0,
        window.chartData?.pendidikan?.["D3"] ?? 0,
        window.chartData?.pendidikan?.["D2"] ?? 0,
        window.chartData?.pendidikan?.["D1"] ?? 0,
        window.chartData?.pendidikan?.["SMA"] ?? 0,
        window.chartData?.pendidikan?.["SMP"] ?? 0,
        window.chartData?.pendidikan?.["SD"] ?? 0,
        window.chartData?.pendidikan?.["Tidak Sekolah"] ?? 0,
    ];

    // console.log(dataPendidikan);

    const colors = [
        "rgba(30, 64, 175, 0.8)",
        "rgba(37, 99, 235, 0.8)",
        "rgba(59, 130, 246, 0.8)",
        "rgba(96, 165, 250, 0.8)",
        "rgba(129, 140, 248, 0.8)",
        "rgba(139, 92, 246, 0.8)",
        "rgba(168, 85, 247, 0.8)",
        "rgba(236, 72, 153, 0.8)",
        "rgba(239, 68, 68, 0.8)",
        "rgba(234, 179, 8, 0.8)",
        "rgba(107, 114, 128, 0.8)",
    ];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: tingkatan,
            datasets: [
                {
                    data: dataPendidikan,
                    backgroundColor: colors,
                    borderColor: colors.map((c) => c.replace("0.8", "1")),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: "y",
            scales: {
                x: {
                    beginAtZero: true,
                    max: 1000,
                    ticks: {
                        stepSize: 500,
                    },
                },
            },
            plugins: {
                legend: { display: false },
                datalabels: {
                    anchor: "end",
                    align: "end",
                    color: "#000",
                    font: {
                        weight: "bold",
                        size: 10,
                    },
                    formatter: (value) => `${value}`,
                },
            },
        },
        plugins: [ChartDataLabels],
    });
}
