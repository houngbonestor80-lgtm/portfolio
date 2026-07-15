<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'ProConduite, auto-école à taille humaine à Cotonou : cours de code, leçons de conduite et permis accéléré avec des moniteurs diplômés d\'État.')">
    <title>@yield('title', 'ProConduite') · Auto-école</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">

    <header class="sticky top-0 z-50 border-b border-stone-200 bg-sand-50/90 backdrop-blur-md">
        <div class="container-narrow flex h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-display text-xl text-ink-900">
                Pro<span class="text-green-600">Conduite</span>
            </a>

            <nav class="hidden items-center gap-8 lg:flex">
                @php
                    $navLinks = [
                        'home' => ['label' => 'Accueil', 'route' => 'home'],
                        'services' => ['label' => 'Services', 'route' => 'services'],
                        'tarifs' => ['label' => 'Tarifs', 'route' => 'tarifs'],
                        'apropos' => ['label' => 'À propos', 'route' => 'apropos'],
                        'contact' => ['label' => 'Contact', 'route' => 'contact'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="text-sm font-medium tracking-wide transition {{ request()->routeIs($link['route']) ? 'text-green-700' : 'text-stone-600 hover:text-ink-900' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden lg:block">
                <a href="{{ route('contact') }}" class="btn-primary">Réserver un cours</a>
            </div>

            <button
                type="button"
                id="menu-toggle"
                class="flex h-10 w-10 items-center justify-center rounded-full border border-stone-300 text-ink-900 lg:hidden"
                aria-label="Ouvrir le menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
            >
                <svg id="menu-icon-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden border-t border-stone-200 bg-sand-50 lg:hidden">
            <nav class="container-narrow flex flex-col gap-1 py-4">
                @foreach ($navLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="rounded-lg px-3 py-3 text-sm font-medium {{ request()->routeIs($link['route']) ? 'bg-green-50 text-green-700' : 'text-stone-600 hover:bg-stone-100 hover:text-ink-900' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('contact') }}" class="btn-primary mt-3 w-full">Réserver un cours</a>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-black/10 bg-ink-950">
        <div class="container-narrow grid gap-12 py-16 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <a href="{{ route('home') }}" class="font-display text-xl text-stone-50">
                    Pro<span class="text-gold-400">Conduite</span>
                </a>
                <p class="mt-4 text-sm leading-relaxed text-stone-400">
                    Une auto-école à taille humaine à Cotonou qui vous accompagne du premier cours de code jusqu'au permis, avec des moniteurs diplômés d'État.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-stone-50">Liens rapides</h3>
                <ul class="mt-4 space-y-3 text-sm text-stone-400">
                    <li><a href="{{ route('home') }}" class="transition hover:text-gold-400">Accueil</a></li>
                    <li><a href="{{ route('services') }}" class="transition hover:text-gold-400">Services</a></li>
                    <li><a href="{{ route('tarifs') }}" class="transition hover:text-gold-400">Tarifs</a></li>
                    <li><a href="{{ route('apropos') }}" class="transition hover:text-gold-400">À propos</a></li>
                    <li><a href="{{ route('contact') }}" class="transition hover:text-gold-400">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-stone-50">Nos services</h3>
                <ul class="mt-4 space-y-3 text-sm text-stone-400">
                    <li>Code de la route</li>
                    <li>Leçons de conduite</li>
                    <li>Permis accéléré</li>
                    <li>Conduite accompagnée</li>
                    <li>Cours de code intensif</li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-stone-50">Contact</h3>
                <ul class="mt-4 space-y-3 text-sm text-stone-400">
                    <li>Boulevard Saint-Michel, Akpakpa, Cotonou, Bénin</li>
                    <li><a href="tel:+22901234567" class="transition hover:text-gold-400">+229 01 23 45 67</a></li>
                    <li><a href="mailto:contact@proconduite.bj" class="transition hover:text-gold-400">contact@proconduite.bj</a></li>
                    <li>Lun&ndash;Sam, 8h&ndash;19h</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10">
            <div class="container-narrow flex flex-col items-center justify-between gap-4 py-6 text-xs text-stone-500 sm:flex-row">
                <p>&copy; {{ date('Y') }} ProConduite. Tous droits réservés.</p>
                <p>Auto-école agréée &middot; Cotonou, Bénin</p>
            </div>
        </div>
    </footer>

</body>
</html>
