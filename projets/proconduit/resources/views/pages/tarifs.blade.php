@extends('layouts.app')

@section('title', 'Tarifs')
@section('description', 'Consultez les tarifs en FCFA de ProConduite : formules Essentielle, Confort et Accélérée, ainsi que nos prestations à la carte.')

@section('content')

    <section
        class="photo-hero py-20 sm:py-28"
        style="background-image: url('https://images.unsplash.com/photo-1600241005059-71de13374958?fm=jpg&q=70&w=1920&auto=format&fit=crop');"
    >
        <div class="container-narrow text-center">
            <span class="eyebrow !text-gold-300">Tarifs</span>
            <h1 class="mx-auto mt-6 max-w-2xl font-display text-4xl text-stone-50 sm:text-5xl">
                Des formules claires, sans frais cachés
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-stone-200">
                Choisissez la formule adaptée à votre rythme d'apprentissage. Paiement échelonné et tarifs de groupe possibles.
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow grid gap-8 lg:grid-cols-3">
            @foreach ([
                [
                    'name' => 'Formule Essentielle',
                    'price' => '120 000',
                    'tagline' => 'Pour démarrer sereinement',
                    'popular' => false,
                    'features' => [
                        'Accès illimité au code en ligne',
                        '20 heures de conduite',
                        'Suivi pédagogique standard',
                        'Présentation à l\'examen du code',
                    ],
                ],
                [
                    'name' => 'Formule Confort',
                    'price' => '175 000',
                    'tagline' => 'Notre formule la plus choisie',
                    'popular' => true,
                    'features' => [
                        'Accès illimité au code en ligne',
                        '30 heures de conduite',
                        'Moniteur dédié tout au long du parcours',
                        'Présentation aux examens code et conduite',
                        '2 heures de perfectionnement offertes',
                    ],
                ],
                [
                    'name' => 'Formule Accélérée',
                    'price' => '230 000',
                    'tagline' => 'Le permis en quelques semaines',
                    'popular' => false,
                    'features' => [
                        'Programme intensif sur 2 à 4 semaines',
                        '35 heures de conduite',
                        'Places prioritaires à l\'examen',
                        'Encadrement renforcé et bilans hebdomadaires',
                    ],
                ],
            ] as $formule)
                <div class="card relative flex flex-col p-8 {{ $formule['popular'] ? 'border-gold-400 shadow-gold' : '' }}">
                    @if ($formule['popular'])
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-gold-gradient px-4 py-1 text-xs font-semibold uppercase tracking-wide text-ink-950">
                            Le plus populaire
                        </span>
                    @endif

                    <h2 class="font-display text-xl text-ink-900">{{ $formule['name'] }}</h2>
                    <p class="mt-1 text-sm text-stone-500">{{ $formule['tagline'] }}</p>

                    <p class="mt-6">
                        <span class="font-display text-4xl text-ink-900">{{ $formule['price'] }}</span>
                        <span class="text-sm text-stone-500"> FCFA / forfait</span>
                    </p>

                    <ul class="mt-8 flex-1 space-y-3">
                        @foreach ($formule['features'] as $feature)
                            <li class="flex items-start gap-2 text-sm text-stone-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 flex-none text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a
                        href="{{ route('contact', ['formule' => $formule['name']]) }}"
                        class="{{ $formule['popular'] ? 'btn-primary' : 'btn-outline' }} mt-8 w-full"
                    >
                        Choisir cette formule
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-sand-100 py-24">
        <div class="container-narrow">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">À la carte</span>
                <h2 class="section-title mt-4">Prestations complémentaires</h2>
            </div>

            <div class="card mt-12 divide-y divide-stone-200 overflow-hidden">
                @foreach ([
                    ['label' => 'Heure de conduite supplémentaire', 'price' => '5 000 FCFA'],
                    ['label' => 'Cours de code intensif (rattrapage)', 'price' => '25 000 FCFA'],
                    ['label' => 'Évaluation de départ', 'price' => '3 000 FCFA'],
                    ['label' => 'Heure de perfectionnement post-permis', 'price' => '6 000 FCFA'],
                    ['label' => 'Location du véhicule pour l\'examen', 'price' => '10 000 FCFA'],
                ] as $item)
                    <div class="flex items-center justify-between px-8 py-5">
                        <span class="text-sm text-stone-600">{{ $item['label'] }}</span>
                        <span class="font-display text-lg text-green-700">{{ $item['price'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow grid gap-8 lg:grid-cols-2">
            <div class="card p-8">
                <h3 class="font-display text-xl text-ink-900">Paiement échelonné</h3>
                <p class="mt-3 text-sm leading-relaxed text-stone-500">
                    Réglez votre formation en 3 ou 4 fois sans frais supplémentaires, pour organiser votre budget sereinement pendant votre apprentissage.
                </p>
            </div>
            <div class="card p-8">
                <h3 class="font-display text-xl text-ink-900">Formations entreprises et groupes</h3>
                <p class="mt-3 text-sm leading-relaxed text-stone-500">
                    Une tarification adaptée pour les entreprises, coopératives et groupes d'au moins 5 personnes souhaitant former leurs équipes.
                </p>
            </div>
        </div>
    </section>

    <section class="pb-24">
        <div class="container-narrow">
            <div class="card flex flex-col items-center gap-6 px-8 py-16 text-center">
                <h2 class="section-title max-w-xl">Une question sur nos tarifs ?</h2>
                <p class="max-w-xl text-stone-500">
                    Notre équipe est disponible pour vous conseiller sur la formule la plus adaptée à votre profil.
                </p>
                <a href="{{ route('contact') }}" class="btn-primary">Nous contacter</a>
            </div>
        </div>
    </section>

@endsection
