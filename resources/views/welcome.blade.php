<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover"/>
    <title>FocusQuest - Start</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { theme: { extend: { colors: { primary: "#58cc02", "primary-shadow": "#1e5000", surface: "#fbf9f8" }, fontFamily: { sans: ["Nunito Sans", "sans-serif"] } } } };</script>
</head>
<body class="bg-surface font-sans text-gray-800 flex flex-col antialiased min-h-screen">
    <main class="flex flex-col flex-1 items-center justify-center w-full max-w-md mx-auto px-6 py-8">
        
        <!-- Hero Section -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-24 h-24 rounded-full bg-primary/20 flex items-center justify-center mb-4 shadow-inner">
                <span class="material-symbols-outlined text-[64px] text-primary" style="font-variation-settings: 'FILL' 1;">bolt</span>
            </div>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-2">FocusQuest</h1>
            <p class="text-gray-500 font-bold text-lg">Uji kecepatan kognitif & refleks visualmu.</p>
        </div>

        <!-- Action Form -->
        <div class="w-full flex flex-col gap-5">
            <div class="flex flex-col gap-2">
                <label for="user-name" class="font-bold text-gray-700 uppercase tracking-wide text-sm ml-1">Siapa namamu?</label>
                <input type="text" id="user-name" placeholder="Contoh: Fulan" class="w-full h-14 px-4 rounded-2xl bg-white border-2 border-gray-200 text-lg font-bold text-gray-800 focus:outline-none focus:border-primary transition-colors text-center shadow-sm" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="user-age" class="font-bold text-gray-700 uppercase tracking-wide text-sm ml-1">Berapa usiamu?</label>
                <input type="number" id="user-age" placeholder="Contoh: 21" class="w-full h-14 px-4 rounded-2xl bg-white border-2 border-gray-200 text-lg font-bold text-gray-800 focus:outline-none focus:border-primary transition-colors text-center shadow-sm" required>
            </div>

            <button onclick="startGame()" class="w-full h-14 mt-2 rounded-2xl bg-primary text-white font-black text-xl tracking-wide shadow-[0_5px_0_0_#1e5000] active:translate-y-1 active:shadow-[0_1px_0_0_#1e5000] transition-all flex items-center justify-center gap-2">
                Mulai Tantangan
            </button>
        </div>
    </main>

    <script>
        function startGame() {
            const name = document.getElementById('user-name').value.trim();
            const age = document.getElementById('user-age').value;

            if (!name) {
                alert("Harap masukkan nama Anda untuk memulai!");
                return;
            }
            if (!age || age < 5 || age > 100) {
                alert("Masukkan usia yang valid untuk memulai!");
                return;
            }
            
            // Store both locally to pass to the game script
            localStorage.setItem('fq_user_name', name);
            localStorage.setItem('fq_user_age', age);
            window.location.href = '/game';
        }
    </script>
</body>
</html>