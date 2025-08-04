console.log("app.js berhasil");
// import Chart from "chart.js/auto";
// import ChartDataLabels from "chartjs-plugin-datalabels";

// Chart.register(ChartDataLabels);

// window.chartData = null;
// window.chartInstances = {};

// function debounce(func, wait) {
//     let timeout;
//     return function executedFunction(...args) {
//         const later = () => {
//             clearTimeout(timeout);
//             func(...args);
//         };
//         clearTimeout(timeout);
//         timeout = setTimeout(later, wait);
//     };
// }

// function destroyChart(chartId) {
//     if (window.chartInstances[chartId]) {
//         window.chartInstances[chartId].destroy();
//         delete window.chartInstances[chartId];
//     }
// }

// function destroyAllCharts() {
//     Object.keys(window.chartInstances).forEach((chartId) => {
//         destroyChart(chartId);
//     });
// }

// async function renderChartsAsync() {
//     if (!window.chartData) return;

//     const visibleCharts = [
//         { func: renderchartWargaWNA, id: "chartWargaWNA" },
//         { func: renderchartWargaWNI, id: "chartWargaWNI" },
//         { func: renderTotalWarga, id: "chartTotalWarga" },
//     ];

//     const backgroundCharts = [
//         { func: renderChartKelahiran, id: "chartKelahiran" },
//         { func: renderChartKematian, id: "chartKematian" },
//         { func: renderChartGenerasi, id: "chartGenerasi" },
//         { func: renderChartPerkawinan, id: "chartPerkawinan" },
//         { func: renderChartAgama, id: "chartAgama" },
//         { func: renderChartPendidikan, id: "chartPendidikan" },
//     ];

//     for (const chart of visibleCharts) {
//         if (document.getElementById(chart.id)) {
//             chart.func();
//         }
//     }

//     for (let i = 0; i < backgroundCharts.length; i++) {
//         const chart = backgroundCharts[i];
//         if (document.getElementById(chart.id)) {
//             setTimeout(() => {
//                 chart.func();
//             }, i * 50);
//         }
//     }
// }

// const debouncedRenderCharts = debounce(renderChartsAsync, 100);

// document.addEventListener("livewire:init", () => {
//     Livewire.on("chartDataWarga", (data) => {
//         window.chartData = Array.isArray(data) ? data[0] : data;
//         console.log("chartDataWarga", data);
//         destroyAllCharts();

//         debouncedRenderCharts();
//     });
// });

// function renderchartWargaWNA() {
//     const ctx = document.getElementById("chartWargaWNA");
//     if (!ctx || !window.chartData?.WNA) return;

//     destroyChart("chartWargaWNA");

//     const dataWNA = [window.chartData.WNA.L ?? 0, window.chartData.WNA.P ?? 0];
//     console.log("chartWNA", dataWNA);

//     try {
//         window.chartInstances["chartWargaWNA"] = new Chart(ctx, {
//             type: "doughnut",
//             data: {
//                 datasets: [
//                     {
//                         label: "Jumlah Warga WNA",
//                         data: dataWNA,
//                         backgroundColor: [
//                             "rgba(54, 162, 235, 0.7)",
//                             "rgba(255, 99, 132, 0.7)",
//                         ],
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 animation: {
//                     duration: 500,
//                 },
//                 plugins: {
//                     datalabels: {
//                         color: "#000",
//                         anchor: "end",
//                         align: "end",
//                         formatter: (value) => `${value}`,
//                         font: {
//                             weight: "bold",
//                             size: 10,
//                         },
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });

//         const elements = {
//             "wna-male": dataWNA[0],
//             "wna-female": dataWNA[1],
//             "summary-wna": dataWNA[0] + dataWNA[1],
//         };

//         Object.entries(elements).forEach(([id, value]) => {
//             const element = document.getElementById(id);
//             if (element) element.textContent = value;
//         });
//     } catch (error) {
//         console.error("Error rendering WNA chart:", error);
//     }
// }

// function renderchartWargaWNI() {
//     const ctx = document.getElementById("chartWargaWNI");
//     if (!ctx || !window.chartData?.WNI) return;

//     destroyChart("chartWargaWNI");

//     const dataWNI = [window.chartData.WNI.L ?? 0, window.chartData.WNI.P ?? 0];
//     console.log("chartWNI", dataWNI);

//     try {
//         window.chartInstances["chartWargaWNI"] = new Chart(ctx, {
//             type: "doughnut",
//             data: {
//                 datasets: [
//                     {
//                         label: "Jumlah Warga WNI",
//                         data: dataWNI,
//                         backgroundColor: [
//                             "rgba(54, 162, 235, 0.7)",
//                             "rgba(255, 99, 132, 0.7)",
//                         ],
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 animation: {
//                     duration: 500,
//                 },
//                 plugins: {
//                     datalabels: {
//                         color: "#000",
//                         anchor: "end",
//                         align: "end",
//                         formatter: (value) => `${value}`,
//                         font: {
//                             weight: "bold",
//                             size: 10,
//                         },
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });

//         const elements = {
//             "wni-male": dataWNI[0],
//             "wni-female": dataWNI[1],
//             "summary-wni": dataWNI[0] + dataWNI[1],
//         };

//         Object.entries(elements).forEach(([id, value]) => {
//             const element = document.getElementById(id);
//             if (element) element.textContent = value;
//         });
//     } catch (error) {
//         console.error("Error rendering WNI chart:", error);
//     }
// }

// function renderTotalWarga() {
//     const ctx = document.getElementById("chartTotalWarga");
//     if (!ctx || !window.chartData?.TOTAL) return;

//     destroyChart("chartTotalWarga");

//     const data = [window.chartData.TOTAL.L ?? 0, window.chartData.TOTAL.P ?? 0];

//     try {
//         window.chartInstances["chartTotalWarga"] = new Chart(ctx, {
//             type: "doughnut",
//             data: {
//                 datasets: [
//                     {
//                         label: "Total Warga",
//                         data: data,
//                         backgroundColor: [
//                             "rgba(54, 162, 235, 0.7)",
//                             "rgba(255, 99, 132, 0.7)",
//                         ],
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 animation: {
//                     duration: 500,
//                 },
//                 plugins: {
//                     datalabels: {
//                         color: "#000",
//                         anchor: "end",
//                         align: "end",
//                         formatter: (value) => `${value}`,
//                         font: {
//                             weight: "bold",
//                             size: 10,
//                         },
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });

//         const elements = {
//             "total-male": data[0],
//             "total-female": data[1],
//             "summary-total": data[0] + data[1],
//         };

//         Object.entries(elements).forEach(([id, value]) => {
//             const element = document.getElementById(id);
//             if (element) element.textContent = value;
//         });
//     } catch (error) {
//         console.error("Error rendering Total chart:", error);
//     }
// }

// function renderChartKelahiran() {
//     const ctx = document.getElementById("chartKelahiran");
//     if (!ctx || !window.chartData?.dataKelahiran) return;

//     destroyChart("chartKelahiran");

//     const kelahiranL = [2021, 2022, 2023, 2024, 2025].map(
//         (year) => window.chartData?.dataKelahiran?.[year]?.L ?? 0
//     );
//     const kelahiranP = [2021, 2022, 2023, 2024, 2025].map(
//         (year) => window.chartData?.dataKelahiran?.[year]?.P ?? 0
//     );

//     try {
//         window.chartInstances["chartKelahiran"] = new Chart(ctx, {
//             type: "bar",
//             data: {
//                 labels: ["2021", "2022", "2023", "2024", "2025"],
//                 datasets: [
//                     {
//                         label: "Laki-laki",
//                         data: kelahiranL,
//                         backgroundColor: "rgba(34, 211, 238, 0.8)",
//                         borderColor: "rgba(34, 211, 238, 1)",
//                         borderWidth: 1,
//                     },
//                     {
//                         label: "Perempuan",
//                         data: kelahiranP,
//                         backgroundColor: "rgba(244, 114, 182, 0.8)",
//                         borderColor: "rgba(244, 114, 182, 1)",
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 animation: {
//                     duration: 300,
//                 },
//                 indexAxis: "y",
//                 scales: {
//                     x: {
//                         beginAtZero: true,
//                         max: 30,
//                     },
//                 },
//                 plugins: {
//                     legend: {
//                         display: false,
//                     },
//                     datalabels: {
//                         anchor: "end",
//                         align: "end",
//                         color: "#000",
//                         font: {
//                             weight: "bold",
//                             size: 10,
//                         },
//                         formatter: (value) => `${value}`,
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });
//     } catch (error) {
//         console.error("Error rendering Kelahiran chart:", error);
//     }
// }

// function renderChartKematian() {
//     const ctx = document.getElementById("chartKematian");
//     if (!ctx || !window.chartData?.dataKematian) return;

//     destroyChart("chartKematian");

//     const kematianL = [2021, 2022, 2023, 2024, 2025].map(
//         (year) => window.chartData?.dataKematian?.[year]?.L ?? 0
//     );
//     const kematianP = [2021, 2022, 2023, 2024, 2025].map(
//         (year) => window.chartData?.dataKematian?.[year]?.P ?? 0
//     );

//     try {
//         window.chartInstances["chartKematian"] = new Chart(ctx, {
//             type: "bar",
//             data: {
//                 labels: ["2021", "2022", "2023", "2024", "2025"],
//                 datasets: [
//                     {
//                         label: "Laki-laki",
//                         data: kematianL,
//                         backgroundColor: "rgba(34, 211, 238, 0.8)",
//                         borderColor: "rgba(34, 211, 238, 1)",
//                         borderWidth: 1,
//                     },
//                     {
//                         label: "Perempuan",
//                         data: kematianP,
//                         backgroundColor: "rgba(244, 114, 182, 0.8)",
//                         borderColor: "rgba(244, 114, 182, 1)",
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 animation: {
//                     duration: 300,
//                 },
//                 indexAxis: "y",
//                 scales: {
//                     x: {
//                         beginAtZero: true,
//                         max: 30,
//                     },
//                 },
//                 plugins: {
//                     legend: {
//                         display: false,
//                     },
//                     datalabels: {
//                         anchor: "end",
//                         align: "end",
//                         color: "#000",
//                         font: {
//                             weight: "bold",
//                             size: 10,
//                         },
//                         formatter: (value) => `${value}`,
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });
//     } catch (error) {
//         console.error("Error rendering Kematian chart:", error);
//     }
// }

// function renderChartGenerasi() {
//     const ctx = document.getElementById("chartGenerasi");
//     if (!ctx || !window.chartData?.generasi) return;

//     destroyChart("chartGenerasi");

//     const generations = [
//         "Pre-Boomer",
//         "Baby Boomer",
//         "Generasi Alpha",
//         "Generasi Beta",
//         "Generasi X",
//         "Generasi Y",
//         "Generasi Z",
//     ];

//     const dataGenerasi = generations.map(
//         (gen) => window.chartData?.generasi?.[gen] ?? 0
//     );

//     const colors = [
//         "rgba(34, 211, 238, 0.8)",
//         "rgba(59, 130, 246, 0.8)",
//         "rgba(99, 102, 241, 0.8)",
//         "rgba(139, 92, 246, 0.8)",
//         "rgba(168, 85, 247, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(239, 68, 68, 0.8)",
//     ];

//     try {
//         window.chartInstances["chartGenerasi"] = new Chart(ctx, {
//             type: "bar",
//             data: {
//                 labels: generations,
//                 datasets: [
//                     {
//                         data: dataGenerasi,
//                         backgroundColor: colors,
//                         borderColor: colors.map((color) =>
//                             color.replace("0.8", "1")
//                         ),
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 animation: { duration: 300 },
//                 indexAxis: "y",
//                 scales: {
//                     x: { beginAtZero: true, max: 200 },
//                 },
//                 plugins: {
//                     legend: { display: false },
//                     datalabels: {
//                         anchor: "end",
//                         align: "end",
//                         color: "#000",
//                         font: { weight: "bold", size: 10 },
//                         formatter: (value) => `${value}`,
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });
//     } catch (error) {
//         console.error("Error rendering Generasi chart:", error);
//     }
// }

// function renderChartPerkawinan() {
//     const ctx = document.getElementById("chartPerkawinan");
//     if (!ctx || !window.chartData?.perkawinan) return;

//     destroyChart("chartPerkawinan");

//     const categories = ["Belum Kawin", "Kawin", "Cerai Mati", "Cerai Hidup"];
//     const dataPerkawinan = categories.map(
//         (cat) => window.chartData?.perkawinan?.[cat] ?? 0
//     );

//     const colors = [
//         "rgba(34, 211, 238, 0.8)",
//         "rgba(37, 99, 235, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(79, 70, 229, 0.8)",
//     ];

//     try {
//         window.chartInstances["chartPerkawinan"] = new Chart(ctx, {
//             type: "bar",
//             data: {
//                 labels: categories,
//                 datasets: [
//                     {
//                         data: dataPerkawinan,
//                         backgroundColor: colors,
//                         borderColor: colors.map((color) =>
//                             color.replace("0.8", "1")
//                         ),
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 animation: { duration: 300 },
//                 scales: {
//                     y: { beginAtZero: true, max: 1000 },
//                 },
//                 plugins: {
//                     legend: { display: false },
//                     datalabels: {
//                         anchor: "end",
//                         align: "end",
//                         color: "#000",
//                         font: { weight: "bold", size: 10 },
//                         formatter: (value) => `${value}`,
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });
//     } catch (error) {
//         console.error("Error rendering Perkawinan chart:", error);
//     }
// }

// function renderChartAgama() {
//     const ctx = document.getElementById("chartAgama");
//     if (!ctx || !window.chartData?.agama) return;

//     destroyChart("chartAgama");

//     const categories = [
//         "Islam",
//         "Kristen",
//         "Katolik",
//         "Hindu",
//         "Buddha",
//         "Konghucu",
//         "Lainnya",
//     ];
//     const dataAgama = categories.map(
//         (cat) => window.chartData?.agama?.[cat] ?? 0
//     );

//     const colors = [
//         "rgba(34, 211, 238, 0.8)",
//         "rgba(59, 130, 246, 0.8)",
//         "rgba(99, 102, 241, 0.8)",
//         "rgba(139, 92, 246, 0.8)",
//         "rgba(168, 85, 247, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(239, 68, 68, 0.8)",
//     ];

//     try {
//         window.chartInstances["chartAgama"] = new Chart(ctx, {
//             type: "bar",
//             data: {
//                 labels: categories,
//                 datasets: [
//                     {
//                         data: dataAgama,
//                         backgroundColor: colors,
//                         borderColor: colors.map((color) =>
//                             color.replace("0.8", "1")
//                         ),
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 animation: { duration: 300 },
//                 scales: {
//                     y: { beginAtZero: true },
//                 },
//                 plugins: {
//                     legend: { display: false },
//                     datalabels: {
//                         anchor: "end",
//                         align: "end",
//                         color: "#000",
//                         font: { weight: "bold", size: 10 },
//                         formatter: (value) => `${value}`,
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });
//     } catch (error) {
//         console.error("Error rendering Agama chart:", error);
//     }
// }

// function renderChartPendidikan() {
//     const ctx = document.getElementById("chartPendidikan");
//     if (!ctx || !window.chartData?.pendidikan) return;

//     destroyChart("chartPendidikan");

//     const tingkatan = [
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
//     const dataPendidikan = tingkatan.map(
//         (level) => window.chartData?.pendidikan?.[level] ?? 0
//     );

//     const colors = [
//         "rgba(30, 64, 175, 0.8)",
//         "rgba(37, 99, 235, 0.8)",
//         "rgba(59, 130, 246, 0.8)",
//         "rgba(96, 165, 250, 0.8)",
//         "rgba(129, 140, 248, 0.8)",
//         "rgba(139, 92, 246, 0.8)",
//         "rgba(168, 85, 247, 0.8)",
//         "rgba(236, 72, 153, 0.8)",
//         "rgba(239, 68, 68, 0.8)",
//         "rgba(234, 179, 8, 0.8)",
//         "rgba(107, 114, 128, 0.8)",
//     ];

//     try {
//         window.chartInstances["chartPendidikan"] = new Chart(ctx, {
//             type: "bar",
//             data: {
//                 labels: tingkatan,
//                 datasets: [
//                     {
//                         data: dataPendidikan,
//                         backgroundColor: colors,
//                         borderColor: colors.map((c) => c.replace("0.8", "1")),
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 animation: { duration: 300 },
//                 indexAxis: "y",
//                 scales: {
//                     x: {
//                         beginAtZero: true,
//                         max: 1000,
//                         ticks: { stepSize: 500 },
//                     },
//                 },
//                 plugins: {
//                     legend: { display: false },
//                     datalabels: {
//                         anchor: "end",
//                         align: "end",
//                         color: "#000",
//                         font: { weight: "bold", size: 10 },
//                         formatter: (value) => `${value}`,
//                     },
//                 },
//             },
//             plugins: [ChartDataLabels],
//         });
//     } catch (error) {
//         console.error("Error rendering Pendidikan chart:", error);
//     }
// }

// window.addEventListener("beforeunload", () => {
//     destroyAllCharts();
// });
