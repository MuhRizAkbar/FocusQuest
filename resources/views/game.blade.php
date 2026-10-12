<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" name="viewport"/>
    <meta content="mobile_stack" name="shell-type"/>
    <title>FocusQuest - Game</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>@layer base{html,body{width:100vw;margin:0;padding:0;}body{overscroll-behavior:none;}.pb-safe{padding-bottom:env(safe-area-inset-bottom,0px);}.pt-safe{padding-top:env(safe-area-inset-top,0px);}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { colors: { secondary: "#006590", surface: "#fbf9f8", tertiary: "#755b00", primary: "#2b6c00", "primary-container": "#58cc02", "primary-fixed": "#87fe45", error: "#ba1a1a", "error-container": "#ffdad6", "tertiary-fixed": "#ffdf92" }, fontFamily: { sans: ["Nunito Sans", "sans-serif"] } } } };</script>
    <style>body { min-height: max(884px, 100dvh); }</style>
</head>
<body class="bg-surface font-sans text-gray-800 flex flex-col antialiased">
    <header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl pt-safe shadow-sm">
        <div class="h-16 px-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img alt="FocusQuest" class="h-7 w-auto hidden sm:block" src="https://lh3.googleusercontent.com/aida/AEtjO1U_ZbIEOTRhhWO5bTewLCAqiU9TpmpBXBf1-rNcL2fXQBHATkd0HeNosBzlbx5EhAHqsy483Df4OayLF0xGOKw67Fgjl1EOYogv_CCfJfVHJwxHrHP5Wht7VFv42WhBO-_yXeCp03xnMxA4eCoDR3_KbUITixhULWUBqRS2HSA2XMw-DRgEqBKBfTEH-06EiN8ym-HCiNqkinPdgzN2Ima-NhsFo-Zh9HmjTsWcjqHuKRpTJO0yEAK6Rw"/>
                <h1 class="font-bold text-lg truncate">Reaction Quest</h1>
            </div>
            <div class="flex items-center gap-2">
                <div class="inline-flex items-center gap-1 bg-gray-200 px-3 py-1 rounded-full shadow-sm"><span class="material-symbols-outlined text-yellow-500 text-lg">local_fire_department</span><span id="streak-counter" class="font-black text-sm">0</span></div>
            </div>
        </div>
    </header>

    <main class="flex flex-col relative w-full pt-16 pb-8 bg-surface min-h-screen">
        <div class="flex flex-col w-full max-w-lg mx-auto px-4 pb-8 gap-4 mt-4 sm:border sm:border-gray-200 sm:rounded-3xl sm:shadow-lg sm:bg-white sm:p-6">
            
            <section class="flex flex-col gap-2 pt-1">
                <div class="flex items-center justify-between gap-1">
                    <div class="inline-flex items-center gap-1 bg-gray-200 px-4 py-1.5 rounded-full shadow-sm">
                        <span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">flag</span>
                        <span class="font-extrabold text-sm uppercase tracking-wider">Attempt <span class="text-primary-container font-black" id="current-attempt">0</span>/10</span>
                    </div>
                    <div class="inline-flex items-center gap-1 bg-yellow-100 px-4 py-1.5 rounded-full shadow-sm">
                        <span class="material-symbols-outlined text-yellow-600 text-lg" style="font-variation-settings: 'FILL' 1;">bolt</span>
                        <span class="font-black text-sm text-yellow-600" id="live-avg-ms">-- ms avg</span>
                    </div>
                </div>
                
                <div class="relative w-full h-4 bg-gray-200 rounded-full overflow-hidden shadow-inner">
                    <div class="relative h-full bg-primary-container rounded-full transition-all duration-300 ease-out" id="progress-bar" style="width: 0%;"></div>
                </div>
            </section>

            <section class="relative bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex items-center justify-center overflow-hidden">
                <div class="flex flex-col text-center items-center">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span id="stimulus-status" class="px-3 py-1 bg-gray-200 text-gray-500 font-bold text-xs rounded-full uppercase tracking-wider">WAIT</span>
                    </div>
                    <h2 class="text-xl font-black leading-tight flex items-center gap-1" id="stimulus-prompt">
                        Mulai Tantangan!
                    </h2>
                </div>
            </section>

            <!-- Interactive Impulse Target Arena (2x2 Grid) -->
            <section class="flex flex-col items-center w-full my-2">
                <div class="grid grid-cols-2 gap-4 w-full max-w-[360px] aspect-square" id="reaction-grid">
                    <!-- Target Icon (Star) -->
                    <button class="game-btn relative w-full h-full min-h-[128px] bg-white rounded-xl p-2 flex flex-col items-center justify-center gap-1 text-center transition-all duration-75 shadow-[0_5px_0_0_#dbd9d9] active:shadow-[0_1px_0_0_#dbd9d9] active:translate-y-1 focus:outline-none" data-target="true" type="button">
                        <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[46px] text-yellow-600" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <span class="font-black text-gray-800 tracking-wide mt-1">STAR</span>
                    </button>
                    <!-- Distractor 1 (Cross) -->
                    <button class="game-btn relative w-full h-full min-h-[128px] bg-white rounded-xl p-2 flex flex-col items-center justify-center gap-1 text-center transition-all duration-75 shadow-[0_5px_0_0_#dbd9d9] active:shadow-[0_1px_0_0_#dbd9d9] active:translate-y-1 focus:outline-none" data-target="false" type="button">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[44px] text-red-600 font-black">close</span>
                        </div>
                        <span class="font-black text-gray-500 tracking-wide mt-1">CROSS</span>
                    </button>
                    <!-- Distractor 2 (Cross) -->
                    <button class="game-btn relative w-full h-full min-h-[128px] bg-white rounded-xl p-2 flex flex-col items-center justify-center gap-1 text-center transition-all duration-75 shadow-[0_5px_0_0_#dbd9d9] active:shadow-[0_1px_0_0_#dbd9d9] active:translate-y-1 focus:outline-none" data-target="false" type="button">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[44px] text-red-600 font-black">close</span>
                        </div>
                        <span class="font-black text-gray-500 tracking-wide mt-1">CROSS</span>
                    </button>
                    <!-- Distractor 3 (Cross) -->
                    <button class="game-btn relative w-full h-full min-h-[128px] bg-white rounded-xl p-2 flex flex-col items-center justify-center gap-1 text-center transition-all duration-75 shadow-[0_5px_0_0_#dbd9d9] active:shadow-[0_1px_0_0_#dbd9d9] active:translate-y-1 focus:outline-none" data-target="false" type="button">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[44px] text-red-600 font-black">close</span>
                        </div>
                        <span class="font-black text-gray-500 tracking-wide mt-1">CROSS</span>
                    </button>
                </div>
            </section>

            <section class="flex flex-col items-center w-full max-w-[360px] mx-auto mt-2">
                <div class="w-full bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex items-center justify-between transition-all duration-200" id="feedback-pill">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-gray-500">timer</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-black">Last Hit</span>
                            <span class="text-xl font-black text-gray-900" id="last-hit-text">-- ms</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            const totalAttempts = 10;
            let currentAttempt = 0;
            let isWaiting = true;
            let isGameComplete = false;
            let stimulusStartTime = 0;
            const reactionData = [];
            
            const grid = document.getElementById('reaction-grid');
            const buttons = Array.from(document.querySelectorAll('.game-btn'));
            const statusBadge = document.getElementById('stimulus-status');
            const promptText = document.getElementById('stimulus-prompt');
            const feedbackPill = document.getElementById('feedback-pill');

            // Ambil Nama & Umur dari LocalStorage (Diisi di Halaman Awal)
            let userName = localStorage.getItem('fq_user_name') || 'Anonim';
            let userAge = localStorage.getItem('fq_user_age') || 20;
            
            const sessionId = crypto.randomUUID ? crypto.randomUUID() : 'SES-' + Math.random().toString(36).substr(2, 9);
            const devicePlatform = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop';

            buttons.forEach(btn => { btn.dataset.originalHtml = btn.innerHTML; });

            function startRound() {
                if (currentAttempt >= totalAttempts) { finishGame(); return; }

                isWaiting = true;
                
                statusBadge.textContent = 'TUNGGU...';
                statusBadge.className = 'px-3 py-1 bg-gray-200 text-gray-500 font-bold text-xs rounded-full uppercase tracking-wider';
                promptText.innerHTML = 'Jangan klik dulu!';

                buttons.forEach(btn => {
                    btn.innerHTML = '<div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center"><span class="material-symbols-outlined text-[32px] text-gray-400">hourglass_empty</span></div>';
                    btn.dataset.activeTarget = 'false';
                });

                const delay = Math.floor(Math.random() * 2000) + 1000;

                setTimeout(() => {
                    if (isGameComplete) return;

                    buttons.forEach(btn => {
                        btn.innerHTML = btn.dataset.originalHtml;
                        btn.dataset.activeTarget = btn.dataset.target; 
                    });

                    buttons.sort(() => Math.random() - 0.5).forEach(btn => grid.appendChild(btn));

                    isWaiting = false;
                    stimulusStartTime = performance.now();
                    
                    statusBadge.textContent = 'ACTIVE';
                    statusBadge.className = 'px-3 py-1 bg-primary-container text-white font-bold text-xs rounded-full uppercase tracking-wider';
                    
                    // Nampilin Full Icon Bintang di Prompt
                    promptText.innerHTML = 'Sentuh <div class="inline-flex w-10 h-10 rounded-full bg-yellow-100 items-center justify-center align-middle mx-1"><span class="material-symbols-outlined text-[28px] text-yellow-600" style="font-variation-settings: \'FILL\' 1;">star</span></div> secepatnya!';

                }, delay);
            }

            setTimeout(startRound, 500);

            grid.addEventListener('click', (e) => {
                const btn = e.target.closest('.game-btn');
                if (!btn || isWaiting || isGameComplete) return; 

                const reactionTime = Math.round(performance.now() - stimulusStartTime);
                const isCorrect = btn.dataset.activeTarget === 'true';

                currentAttempt++;
                isWaiting = true;

                // Tambahkan field `name` ke payload
                reactionData.push({
                    session_id: sessionId,
                    name: userName,
                    age: parseInt(userAge),
                    attempt_number: currentAttempt,
                    reaction_time_ms: reactionTime,
                    is_correct: isCorrect ? 1 : 0,
                    device_platform: devicePlatform
                });

                document.getElementById('current-attempt').textContent = currentAttempt;
                document.getElementById('progress-bar').style.width = ((currentAttempt / totalAttempts) * 100) + '%';
                document.getElementById('last-hit-text').textContent = reactionTime + ' ms';

                const correctHits = reactionData.filter(d => d.is_correct);
                if(correctHits.length > 0) {
                    const sum = correctHits.reduce((acc, curr) => acc + curr.reaction_time_ms, 0);
                    document.getElementById('live-avg-ms').textContent = Math.round(sum / correctHits.length) + ' ms avg';
                }

                if (isCorrect) {
                    feedbackPill.classList.add('shadow-[0_4px_0_0_#58cc02]', 'bg-green-50');
                    document.getElementById('streak-counter').textContent = correctHits.length;
                    setTimeout(() => feedbackPill.classList.remove('shadow-[0_4px_0_0_#58cc02]', 'bg-green-50'), 300);
                } else {
                    btn.classList.add('translate-x-1');
                    feedbackPill.classList.add('shadow-[0_4px_0_0_#ba1a1a]');
                    setTimeout(() => {
                        btn.classList.remove('translate-x-1');
                        feedbackPill.classList.remove('shadow-[0_4px_0_0_#ba1a1a]');
                    }, 300);
                }

                setTimeout(startRound, 600);
            });

         async function finishGame() {
                isGameComplete = true;
                promptText.innerHTML = 'Menyimpan Data...';
                statusBadge.textContent = 'SELESAI';
                statusBadge.className = 'px-3 py-1 bg-secondary text-on-primary font-label-md text-label-md rounded-full font-black uppercase tracking-wider';
                
                grid.style.opacity = '0.5';
                grid.style.pointerEvents = 'none';

                try {
                    const response = await fetch('/save-results', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ results: reactionData })
                    });
                    
                    // JIKA SERVER MENOLAK (Error 500 / 422)
                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error("SERVER ERROR:", errorText);
                        alert("GAGAL MENYIMPAN DATA KE DATABASE!\nCek Console Browser (F12) untuk detailnya.");
                        return; // Hentikan proses, jangan pindah halaman!
                    }
                    
                    localStorage.setItem('fq_last_session', JSON.stringify(reactionData));
                    window.location.href = '/results'; 
                } catch(e) {
                    console.error("NETWORK ERROR:", e);
                    alert('Gagal mengirim data! Pastikan server berjalan (php artisan serve).');
                }
            }
        </script>
    </main>
</body>
</html>