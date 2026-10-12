<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover"/>
    <title>FocusQuest - Analytics</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>@layer base{html,body{width:100vw;margin:0;padding:0;}body{overscroll-behavior:none;}.pb-safe{padding-bottom:env(safe-area-inset-bottom,0px);}.pt-safe{padding-top:env(safe-area-inset-top,0px);}}::-webkit-scrollbar{display:none;} body { min-height: max(884px, 100dvh); }</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { theme: { extend: { colors: { secondary: "#006590", surface: "#fbf9f8", tertiary: "#755b00", primary: "#2b6c00", "primary-container": "#58cc02", "primary-fixed": "#87fe45", "primary-fixed-dim": "#6be026", "tertiary-fixed": "#ffdf92", "tertiary-fixed-dim": "#f4bf00", "secondary-fixed": "#c8e6ff" } } } };</script>
</head>
<body class="bg-surface font-sans text-gray-800 flex flex-col antialiased">
    <header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl pt-safe shadow-sm">
        <div class="h-16 px-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-2xl">military_tech</span>
                <h1 class="font-bold text-lg truncate">Quest Summary & Analytics</h1>
            </div>
            <button onclick="window.location.href='/'" class="w-11 h-11 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 active:translate-y-0.5 transition-transform"><span class="material-symbols-outlined">close</span></button>
        </div>
    </header>

    <main class="flex flex-col w-full max-w-md mx-auto pt-20 pb-8 px-4 gap-4">
        <!-- Hero Card -->
        <div class="relative w-full rounded-2xl bg-white shadow-md p-6 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-1 bg-primary-fixed text-primary px-3 py-1 rounded-full mb-4 z-10 font-bold text-sm">
                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                10 / 10 Percobaan Tuntas
            </div>
            <div class="w-24 h-24 rounded-full bg-tertiary-fixed flex items-center justify-center shadow-[0_5px_0_0_#ddad00] z-10" id="trophy-badge">
                <div class="w-20 h-20 rounded-full bg-yellow-400 flex items-center justify-center shadow-inner">
                    <span class="material-symbols-outlined text-[52px] text-white drop-shadow" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                </div>
            </div>
            <h2 class="text-3xl font-black mt-4 text-gray-900">Misi Tuntas! ⚡</h2>
            <p class="font-semibold text-gray-500">Refleks kilat Anda terkalibrasi.</p>
        </div>

        <!-- Metric Tiles -->
        <div class="w-full bg-white rounded-2xl p-4 shadow-md flex items-center justify-between mt-2">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-primary-fixed flex items-center justify-center text-primary shadow-[0_3px_0_0_#6be026]">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">speed</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs font-bold text-gray-500 uppercase">Rata-Rata Reaksi</span>
                    <div class="flex items-baseline gap-1">
                        <span id="result-avg" class="text-4xl font-black text-gray-900">--</span>
                        <span class="text-lg font-bold text-gray-500">ms</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 w-full">
            <div class="bg-white rounded-xl p-3 shadow-md flex flex-col items-center text-center">
                <div class="w-8 h-8 rounded-full bg-tertiary-fixed text-tertiary flex items-center justify-center mb-1"><span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">flash_on</span></div>
                <span class="text-[11px] font-extrabold text-gray-500 uppercase">Tercepat</span>
                <span id="result-fastest" class="text-xl font-black text-tertiary mt-0.5">-- ms</span>
            </div>
            <div class="bg-white rounded-xl p-3 shadow-md flex flex-col items-center text-center">
                <div class="w-8 h-8 rounded-full bg-primary-fixed text-primary flex items-center justify-center mb-1"><span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">target</span></div>
                <span class="text-[11px] font-extrabold text-gray-500 uppercase">Akurasi</span>
                <span id="result-accuracy" class="text-xl font-black text-primary mt-0.5">--%</span>
            </div>
        </div>

        <!-- Interactive Analytics Chart -->
        <div class="w-full bg-white rounded-2xl p-4 shadow-md mt-2 flex flex-col">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-secondary text-[22px]">bar_chart</span>
                <h3 class="font-bold text-lg text-gray-900">Riwayat 10 Percobaan</h3>
            </div>
            <div class="relative w-full pt-4 pb-2">
                <div class="absolute top-[48%] left-0 right-0 border-t-2 border-dashed border-gray-300 z-0"></div>
                <div id="chart-bars" class="grid grid-cols-10 gap-1 items-end h-36 relative z-10 px-1">
                    <!-- JS will inject 10 bars here -->
                </div>
            </div>
        </div>

        <!-- Play Again Action -->
        <button onclick="window.location.href='/'" class="w-full h-14 mt-4 rounded-2xl bg-primary-container text-white font-black text-xl flex items-center justify-center gap-2 shadow-[0_5px_0_0_#1e5000] active:translate-y-1 active:shadow-none transition-all">
            <span class="material-symbols-outlined text-2xl">replay</span> Main Lagi
        </button>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rawData = localStorage.getItem('fq_last_session');
            if (!rawData) return; // If accessed directly without playing, leave default placeholders
            
            const sessionData = JSON.parse(rawData);
            if(sessionData.length === 0) return;

            // 1. Calculate Metrics
            const times = sessionData.filter(d => d.is_correct).map(d => d.reaction_time_ms);
            const misses = sessionData.filter(d => !d.is_correct).length;
            
            const avg = times.length > 0 ? Math.round(times.reduce((a,b) => a+b, 0) / times.length) : 0;
            const fastest = times.length > 0 ? Math.min(...times) : 0;
            const accuracy = Math.round(((10 - misses) / 10) * 100);

            // 2. Inject Metrics
            document.getElementById('result-avg').textContent = avg;
            document.getElementById('result-fastest').textContent = fastest > 0 ? `${fastest} ms` : 'Miss';
            document.getElementById('result-accuracy').textContent = `${accuracy}%`;

            // 3. Render Dynamic Chart Bars
            const chartContainer = document.getElementById('chart-bars');
            chartContainer.innerHTML = ''; // Clear template
            
            // Normalize heights so the slowest click doesn't break the container
            const maxTime = Math.max(...sessionData.map(d => d.reaction_time_ms), 400);

            sessionData.forEach((attempt, i) => {
                const isFast = attempt.reaction_time_ms === fastest && attempt.is_correct;
                const isMiss = !attempt.is_correct;
                
                // Lower times = taller bars (better score visually)
                let heightPct = 100 - ((attempt.reaction_time_ms / maxTime) * 100);
                heightPct = Math.max(20, Math.min(100, heightPct)); // Keep between 20% and 100%

                const colorClass = isMiss ? 'bg-red-400 shadow-[0_2px_0_0_#991b1b]' : 
                                  (isFast ? 'bg-tertiary-fixed-dim shadow-[0_3px_0_0_#ddad00]' : 'bg-primary-fixed-dim shadow-[0_2px_0_0_#2b6c00]');
                const textColor = isFast ? 'text-tertiary font-black' : (isMiss ? 'text-red-500 font-bold' : 'text-gray-500 font-bold');
                
                chartContainer.innerHTML += `
                    <div class="flex flex-col items-center h-full justify-end group cursor-pointer">
                        <span class="text-[9px] ${textColor} opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap mb-1">
                            ${isMiss ? 'Miss' : attempt.reaction_time_ms}
                        </span>
                        <div class="w-full rounded-t-md ${colorClass} transition-all" style="height: ${heightPct}%;"></div>
                        <span class="text-[10px] font-bold text-gray-500 mt-1">${i + 1}</span>
                    </div>
                `;
            });
        });
    </script>
</body>
</html>