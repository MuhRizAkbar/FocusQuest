<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FocusQuest - Raw Data</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}}::-webkit-scrollbar{display:none;}</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { colors: { "surface-container-lowest": "#ffffff", "surface-container-low": "#f3f4f6", "surface-container-high": "#e7e8ea", "on-surface": "#191c1e", "on-surface-variant": "#3f4a36", primary: "#2b6c00", "primary-container": "#58cc02", "primary-fixed": "#87fe45", "on-primary-fixed-variant": "#1f5100", secondary: "#575e70", "secondary-fixed": "#dce2f7", "on-secondary-fixed": "#141b2b", tertiary: "#006591", "tertiary-fixed": "#c9e6ff", "on-tertiary-fixed-variant": "#004c6e", error: "#ba1a1a", "error-container": "#ffdad6", "on-error-container": "#93000a" }, fontFamily: { sans: ["Inter", "sans-serif"] } } } };</script>
</head>
<body class="bg-surface-container-low font-sans text-sm text-on-surface antialiased">
    <aside class="fixed left-0 top-0 h-full w-64 bg-surface-container-lowest shadow-sm z-50 flex flex-col justify-between">
        <div class="flex flex-col">
            <div class="h-16 px-4 flex items-center gap-3 bg-surface-container-lowest">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white"><span class="material-symbols-outlined text-lg">bolt</span></div>
                <div class="flex flex-col"><span class="font-semibold tracking-tight text-base">FocusQuest</span><span class="text-xs text-on-surface-variant">Data Collection</span></div>
            </div>
            <nav class="px-4 py-4 flex flex-col gap-2">
                <a class="flex items-center gap-3 px-4 py-2 text-on-surface-variant rounded-xl hover:bg-surface-container-high transition-colors" href="/admin"><span class="material-symbols-outlined text-lg">dashboard</span><span>Dashboard</span></a>
                <a aria-current="page" class="flex items-center gap-3 px-4 py-2 bg-primary-container text-on-primary-fixed-variant font-semibold rounded-xl" href="/admin/raw-data"><span class="material-symbols-outlined text-lg">dataset</span><span>Raw Data</span></a>
            </nav>
        </div>
    </aside>

    <div class="pl-64">
        <header class="fixed top-0 left-64 right-0 h-16 bg-surface-container-lowest shadow-sm z-40 flex items-center justify-between px-6">
            <div class="flex items-center gap-2 text-on-surface-variant font-medium">
                <span class="text-sm">Research Study</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="font-semibold text-on-surface text-base">Raw Dataset</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                    <div class="flex flex-col text-right"><span class="font-semibold text-sm leading-tight">Admin</span></div>
                    <a class="p-2 text-on-surface-variant hover:text-error hover:bg-surface-container-high rounded-xl transition-colors flex items-center justify-center" href="/logout" title="Logout"><span class="material-symbols-outlined text-xl">logout</span></a>
                </div>
            </div>
        </header>

        <main class="w-full pt-24 px-6 pb-8 bg-surface-container-low min-h-screen">
            <section class="bg-surface-container-lowest rounded-xl shadow-sm flex flex-col overflow-hidden">
                <div class="p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <span class="p-1 rounded bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center"><span class="material-symbols-outlined text-lg">dataset</span></span>
                        <h2 class="text-lg font-semibold">Complete Telemetry Dataset</h2>
                    </div>
                    <button onclick="window.location.href='/admin/export'" class="flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container text-on-surface font-semibold text-sm rounded-xl transition-colors" type="button">
                        <span class="material-symbols-outlined text-base">download</span><span>Export Full CSV</span>
                    </button>
                </div>
                
                <div class="overflow-x-auto w-full min-h-[500px]">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-surface-container-low text-on-surface-variant text-xs uppercase tracking-wider">
                            <tr>
                                <th class="py-3 px-4 font-semibold">ID</th>
                                <th class="py-3 px-4 font-semibold">Session ID</th>
                                <th class="py-3 px-4 font-semibold">Name</th> <!-- Kolom Baru -->
                                <th class="py-3 px-4 font-semibold">Age</th>
                                <th class="py-3 px-4 font-semibold">Attempt</th>
                                <th class="py-3 px-4 font-semibold">Reaction Time</th>
                                <th class="py-3 px-4 font-semibold">Correctness</th>
                                <th class="py-3 px-4 font-semibold">Device</th>
                                <th class="py-3 px-4 font-semibold">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody id="logs-table-body" class="divide-y divide-gray-100 text-sm text-gray-800">
                            <!-- Data injects here via JS -->
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 bg-surface-container-low/50 border-t border-gray-100 text-sm text-on-surface-variant flex justify-between items-center">
                    <span id="page-info" class="font-medium">Loading entries...</span>
                    <div class="flex gap-2">
                        <button id="btn-prev" onclick="changePage(-1)" class="px-4 py-2 bg-white border border-gray-200 rounded-lg font-semibold hover:bg-gray-50 disabled:opacity-50 transition-colors">Previous</button>
                        <button id="btn-next" onclick="changePage(1)" class="px-4 py-2 bg-white border border-gray-200 rounded-lg font-semibold hover:bg-gray-50 disabled:opacity-50 transition-colors">Next</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        let currentPage = 1;
        let lastPage = 1;

        async function loadData(page) {
            try {
                const response = await fetch('/raw-data-api?page=' + page);
                const data = await response.json();
                
                currentPage = data.current_page;
                lastPage = data.last_page;
                
                document.getElementById('page-info').textContent = `Page ${currentPage} of ${lastPage} (Total: ${data.total} records)`;
                document.getElementById('btn-prev').disabled = (currentPage === 1);
                document.getElementById('btn-next').disabled = (currentPage === lastPage);

                const tbody = document.getElementById('logs-table-body');
                tbody.innerHTML = '';
                
                    data.data.forEach(log => {
                    const tr = document.createElement('tr');
                    tr.className = "hover:bg-gray-50 transition-colors";
                    
                    const dateObj = new Date(log.created_at);
                    const formattedDate = dateObj.toLocaleDateString() + ' ' + dateObj.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

                    tr.innerHTML = `
                        <td class="py-3 px-4 font-mono text-xs font-semibold text-gray-500">#LOG-${log.id}</td>
                        <td class="py-3 px-4 font-mono text-xs">${log.session_id.substring(0,8)}</td>
                        <td class="py-3 px-4 font-semibold">${log.name || 'Anonim'}</td> <!-- Data Nama -->
                        <td class="py-3 px-4">${log.age}</td>
                        <td class="py-3 px-4"><span class="bg-gray-100 px-2 py-1 rounded-md text-xs font-mono">${log.attempt_number}/10</span></td>
                        <td class="py-3 px-4 font-mono font-bold ${log.is_correct ? 'text-primary' : 'text-error'}">${log.reaction_time_ms} ms</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold ${log.is_correct ? 'bg-primary-fixed text-on-primary-fixed-variant' : 'bg-error-container text-error'}">
                                ${log.is_correct ? 'Correct' : 'Miss'}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-500 text-xs">${log.device_platform || 'Unknown'}</td>
                        <td class="py-3 px-4 text-gray-400 text-xs font-mono">${formattedDate}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (error) {
                console.error("Failed to load raw data:", error);
            }
        }

        function changePage(direction) {
            const newPage = currentPage + direction;
            if (newPage >= 1 && newPage <= lastPage) {
                loadData(newPage);
            }
        }

        document.addEventListener('DOMContentLoaded', () => loadData(1));
    </script>
</body>
</html>