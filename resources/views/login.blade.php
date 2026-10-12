<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FocusQuest - Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { theme: { extend: { colors: { primary: "#58cc02", "primary-shadow": "#1e5000", surface: "#fbf9f8" }, fontFamily: { sans: ["Nunito Sans", "sans-serif"] } } } };</script>
</head>
<body class="bg-surface font-sans text-gray-800 flex flex-col antialiased min-h-screen items-center justify-center p-4">
    
    <div class="w-full max-w-sm bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center border border-gray-100">
        <div class="w-16 h-16 rounded-full bg-primary/20 flex items-center justify-center mb-4 shadow-inner">
            <span class="material-symbols-outlined text-[40px] text-primary" style="font-variation-settings: 'FILL' 1;">admin_panel_settings</span>
        </div>
        <h1 class="text-2xl font-black text-gray-900 tracking-tight mb-1">Researcher Login</h1>
        <p class="text-gray-500 font-bold text-sm mb-6">Akses dasbor analitik FocusQuest.</p>

        <form action="/login" method="POST" class="w-full flex flex-col gap-4">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm font-bold text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="flex flex-col gap-1.5">
                <label for="password" class="font-bold text-gray-700 uppercase tracking-wide text-xs ml-1">Password Admin</label>
                <input type="password" id="password" name="password" placeholder="••••••••" class="w-full h-12 px-4 rounded-xl bg-gray-50 border-2 border-gray-200 text-lg font-bold text-gray-800 focus:outline-none focus:border-primary focus:bg-white transition-colors shadow-sm" required>
            </div>

            <button type="submit" class="w-full h-12 mt-2 rounded-xl bg-primary text-white font-black text-lg tracking-wide shadow-[0_4px_0_0_#1e5000] active:translate-y-1 active:shadow-[0_0px_0_0_#1e5000] transition-all">
                Masuk Dasbor
            </button>
        </form>
        
        <button onclick="window.location.href='/'" class="mt-6 text-gray-400 hover:text-gray-600 font-bold text-sm transition-colors">
            &larr; Kembali ke Game
        </button>
    </div>

</body>
</html>