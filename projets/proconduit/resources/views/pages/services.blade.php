@extends('layouts.app')

@section('title', 'Services')
@section('description', 'Découvrez toutes les formations ProConduite à Cotonou : code de la route, leçons de conduite, conduite accompagnée, permis accéléré et stages de perfectionnement.')

@section('content')

    <section
        class="photo-hero py-20 sm:py-28"
        style="background-image: url('https://images.unsplash.com/photo-1709600677177-dd125e80dd6e?fm=jpg&q=70&w=1920&auto=format&fit=crop');"
    >
        <div class="container-narrow text-center">
            <span class="eyebrow !text-gold-300">Nos formations</span>
            <h1 class="mx-auto mt-6 max-w-2xl font-display text-4xl text-stone-50 sm:text-5xl">
                Des services pensés pour chaque profil d'élève
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-stone-200">
                Que vous démarriez de zéro, souhaitiez accélérer votre formation ou reprendre le code, ProConduite propose un parcours adapté à votre rythme.
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow space-y-6">
            @foreach ([
                [
                    'icon' => 'book',
                    'title' => 'Code de la route',
                    'text' => 'Un accès illimité à notre plateforme de séries en ligne, complété par des cours en salle animés par nos moniteurs, pour maîtriser les fondamentaux du code avant de prendre le volant.',
                    'points' => ['Séries d\'entraînement illimitées en ligne', 'Cours en salle chaque semaine', 'Suivi de votre taux de réussite'],
                ],
                [
                    'icon' => 'car',
                    'title' => 'Leçons de conduite',
                    'text' => 'Des heures de conduite individuelles avec un moniteur diplômé d\'État, en ville, sur route et sur autoroute, pour progresser en toute sécurité jusqu\'à l\'autonomie complète.',
                    'points' => ['Véhicules récents à double commande', 'Créneaux flexibles en semaine et le week-end', 'Bilan de progression après chaque leçon'],
                ],
                [
                    'icon' => 'users',
                    'title' => 'Conduite accompagnée (AAC)',
                    'text' => 'Dès 16 ans, apprenez à conduire aux côtés d\'un accompagnateur après une formation initiale encadrée, pour cumuler de l\'expérience avant votre examen.',
                    'points' => ['Formation initiale de 20 heures minimum', 'Rendez-vous pédagogiques réguliers', 'Accompagnement des parents inclus'],
                ],
                [
                    'icon' => 'bolt',
                    'title' => 'Permis accéléré',
                    'text' => 'Une formule intensive conçue pour obtenir votre permis en quelques semaines, idéale avant un départ aux études, un nouvel emploi ou un déménagement.',
                    'points' => ['Code et conduite condensés sur 2 à 4 semaines', 'Places prioritaires à l\'examen', 'Encadrement renforcé par un moniteur dédié'],
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Cours de code intensif (rattrapage)',
                    'text' => 'Une remise à niveau accélérée pour les candidats qui souhaitent repasser rapidement l\'épreuve théorique, animée en petit groupe par nos moniteurs.',
                    'points' => ['Sessions courtes et intensives', 'Groupes réduits pour plus d\'échanges', 'Séries blanches chronométrées'],
                ],
                [
                    'icon' => 'sparkles',
                    'title' => 'Perfectionnement post-permis',
                    'text' => 'Pour les jeunes conducteurs ou toute personne souhaitant regagner en confiance : conduite sur grand axe, créneaux, conduite de nuit ou sous la pluie.',
                    'points' => ['Programme sur-mesure selon vos besoins', 'Idéal après une longue interruption de conduite', 'Un moniteur dédié pour toute la session'],
                ],
            ] as $service)
                <div class="card grid gap-8 p-8 lg:grid-cols-[auto,1fr] lg:items-start lg:p-10">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-50 text-green-600">
                        @switch($service['icon'])
                            @case('book')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                @break
                            @case('car')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v-.75a.75.75 0 00-.75-.75h-2.25m0 0V12m0 3.75h-3m-2.25 0h-1.5a.75.75 0 01-.75-.75v-3a.75.75 0 01.44-.683l4.5-2.045a.75.75 0 01.62 0l4.5 2.045a.75.75 0 01.44.683v3a.75.75 0 01-.75.75h-1.5m-8.25-3h12" /></svg>
                                @break
                            @case('users')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
                                @break
                            @case('bolt')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                                @break
                            @case('shield')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                                @break
                            @case('sparkles')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" /></svg>
                                @break
                        @endswitch
                    </div>

                    <div>
                        <h2 class="font-display text-2xl text-ink-900">{{ $service['title'] }}</h2>
                        <p class="mt-3 leading-relaxed text-stone-500">{{ $service['text'] }}</p>
                        <ul class="mt-5 grid gap-2 sm:grid-cols-2">
                            @foreach ($service['points'] as $point)
                                <li class="flex items-start gap-2 text-sm text-stone-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 flex-none text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                    <span>{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="pb-24">
        <div class="container-narrow">
            <div class="card flex flex-col items-center gap-6 px-8 py-16 text-center">
                <h2 class="section-title max-w-xl">Une question sur nos formations ?</h2>
                <p class="max-w-xl text-stone-500">
                    Consultez nos tarifs détaillés ou contactez-nous pour construire le parcours le plus adapté à votre situation.
                </p>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('tarifs') }}" class="btn-primary">Voir les tarifs</a>
                    <a href="{{ route('contact') }}" class="btn-outline">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>

@endsection
