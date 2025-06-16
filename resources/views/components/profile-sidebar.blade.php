<aside class="bg-white border border-gray-200 shadow-sm rounded-lg p-6 h-fit">
    <!-- 👤 Profil -->
    <div class="flex flex-col items-center text-center">
        <img src="/images/mig.jpg" alt="Profilbillede"
             class="w-32 h-32 rounded-full border border-gray-300 object-cover mb-4 shadow">

        <h2 class="text-xl font-semibold text-gray-800">Morten Andersen</h2>

        <p class="text-sm text-gray-600">
    Strategier til passiv indtægt, frihed og ro i sindet – baseret på virkelige erfaringer.  
    <a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Læs mere →</a>
</p>
        {{-- <p class="text-sm text-gray-600 mb-3 leading-snug">
            Jeg bygger denne platform selv – fra backend til frontend – for at dele strategisk viden inden for
            <strong>trading, betting og investering</strong>.
        </p> --}}
    </div>

    <!-- 🧰 Tech Stack -->
    <div class="mt-6 bg-gray-50 border border-gray-200 p-4 rounded-lg text-sm">
        <h3 class="font-semibold text-gray-700 mb-3">🧰 Tech stack</h3>
        <ul class="space-y-1 text-gray-600">
            <li>⚙️ Laravel 11</li>
            <li>🎨 Tailwind CSS</li>
            <li>🧱 Blade-komponenter</li>
            <li>⚡ Vite + Alpine.js</li>
        </ul>
    </div>

    <!-- 🚧 Udviklingsstatus -->
    <div class="mt-6 bg-indigo-50 border border-indigo-100 p-4 rounded-lg text-sm">
    <h3 class="font-semibold text-indigo-700 mb-2">🚧 Under udvikling</h3>
    <p class="text-indigo-800">Jeg bygger fortsat nye features – næste opdatering bliver søgning og brugerlogin.</p>
</div>
</aside>
