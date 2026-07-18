@extends('layouts.app')

@section('title', 'ProConduite')
@section('description', 'Passez votre permis en toute confiance avec ProConduite, auto-école à Cotonou : cours de code, leçons de conduite et permis accéléré, encadrés par des moniteurs diplômés d\'État.')

@section('content')

    <section
        class="photo-hero py-28 sm:py-36"
        style="background-image: url('https://images.unsplash.com/photo-1646459273661-66884c54f2f1?fm=jpg&q=70&w=1920&auto=format&fit=crop');"
    >
        <div class="container-narrow text-center">
            <span class="eyebrow !text-gold-300">Auto-école agréée &middot; Cotonou, Bénin</span>
            <h1 class="mx-auto mt-6 max-w-3xl font-display text-4xl leading-tight text-stone-50 sm:text-5xl lg:text-6xl">
                Passez votre permis en toute <span class="text-gold-400">confiance</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-stone-200">
                Code de la route, leçons de conduite et permis accéléré : nos moniteurs diplômés d'État vous accompagnent à chaque étape, avec un suivi personnalisé jusqu'au jour de l'examen.
            </p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('contact') }}" class="btn-primary">Réserver un cours</a>
                <a href="{{ route('tarifs') }}" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-white/40 px-7 py-3 text-sm font-semibold uppercase tracking-wide text-stone-50 transition duration-300 hover:bg-white/10">
                    Découvrir nos tarifs
                </a>
            </div>
        </div>
    </section>

    <section class="pattern-motif border-b border-stone-200 py-16">
        <div class="container-narrow">
            <dl class="grid grid-cols-2 gap-8 text-center sm:grid-cols-4">
                <div>
                    <dt class="font-display text-3xl text-ink-900 sm:text-4xl">92&nbsp;%</dt>
                    <dd class="mt-2 text-sm text-stone-500">Taux de réussite</dd>
                </div>
                <div>
                    <dt class="font-display text-3xl text-ink-900 sm:text-4xl">15&nbsp;ans</dt>
                    <dd class="mt-2 text-sm text-stone-500">D'expérience</dd>
                </div>
                <div>
                    <dt class="font-display text-3xl text-ink-900 sm:text-4xl">3&nbsp;200+</dt>
                    <dd class="mt-2 text-sm text-stone-500">Élèves formés</dd>
                </div>
                <div>
                    <dt class="font-display text-3xl text-ink-900 sm:text-4xl">8</dt>
                    <dd class="mt-2 text-sm text-stone-500">Moniteurs diplômés</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Nos engagements</span>
                <h2 class="section-title mt-4">Pourquoi choisir ProConduite</h2>
                <p class="mt-4 text-stone-500">
                    Un accompagnement exigeant et bienveillant, pensé pour vous mener sereinement jusqu'au permis.
                </p>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Moniteurs diplômés d\'État', 'text' => 'Une équipe pédagogique certifiée, patiente et à l\'écoute de votre progression.', 'icon' => 'academic'],
                    ['title' => 'Suivi personnalisé', 'text' => 'Un livret de progression numérique pour visualiser vos acquis à chaque leçon.', 'icon' => 'chart'],
                    ['title' => 'Véhicules récents', 'text' => 'Une flotte entretenue et équipée en double commande pour apprendre en sécurité.', 'icon' => 'car'],
                    ['title' => 'Disponibilités flexibles', 'text' => 'Des créneaux en semaine, le soir et le week-end pour s\'adapter à votre emploi du temps.', 'icon' => 'clock'],
                ] as $feature)
                    <div class="card p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            @switch($feature['icon'])
                                @case('academic')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443" /></svg>
                                    @break
                                @case('chart')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                                    @break
                                @case('car')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v-.75a.75.75 0 00-.75-.75h-2.25m0 0V12m0 3.75h-3m-2.25 0h-1.5a.75.75 0 01-.75-.75v-3a.75.75 0 01.44-.683l4.5-2.045a.75.75 0 01.62 0l4.5 2.045a.75.75 0 01.44.683v3a.75.75 0 01-.75.75h-1.5m-8.25-3h12" /></svg>
                                    @break
                                @case('clock')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @break
                            @endswitch
                        </div>
                        <h3 class="mt-5 font-display text-lg text-ink-900">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-stone-500">{{ $feature['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-sand-100 py-24">
        <div class="container-narrow">
            <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
                <div>
                    <span class="eyebrow">Nos formations</span>
                    <h2 class="section-title mt-4">Un parcours complet vers le permis</h2>
                </div>
                <a href="{{ route('services') }}" class="btn-outline">Voir tous nos services</a>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['title' => 'Code de la route', 'text' => 'Séries d\'entraînement illimitées en salle et en ligne, corrigées par nos moniteurs.'],
                    ['title' => 'Leçons de conduite', 'text' => 'Des heures de conduite individuelles, en ville, sur route et sur autoroute.'],
                    ['title' => 'Permis accéléré', 'text' => 'Une formation intensive pour obtenir votre permis en quelques semaines.'],
                ] as $service)
                    <div class="card p-8">
                        <h3 class="font-display text-xl text-ink-900">{{ $service['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-stone-500">{{ $service['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Comment ça marche</span>
                <h2 class="section-title mt-4">Votre parcours en 4 étapes</h2>
            </div>

            <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['step' => '01', 'title' => 'Inscription', 'text' => 'Créez votre dossier et choisissez la formule adaptée à vos besoins.'],
                    ['step' => '02', 'title' => 'Code de la route', 'text' => 'Préparez et validez l\'épreuve théorique à votre rythme.'],
                    ['step' => '03', 'title' => 'Leçons de conduite', 'text' => 'Progressez avec votre moniteur jusqu\'à la conduite autonome.'],
                    ['step' => '04', 'title' => 'Examen & permis', 'text' => 'Passez l\'épreuve pratique et récupérez votre permis.'],
                ] as $item)
                    <div class="relative">
                        <span class="font-display text-5xl text-green-600/15">{{ $item['step'] }}</span>
                        <h3 class="mt-3 font-display text-lg text-ink-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-stone-500">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-sand-100 py-24">
        <div class="container-narrow">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Témoignages</span>
                <h2 class="section-title mt-4">Ce que disent nos élèves</h2>
            </div>

            <div class="mt-16 grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['name' => 'Chimène Adjovi', 'text' => 'Une équipe très pédagogue, j\'ai eu mon permis du premier coup grâce à des leçons adaptées à mon niveau.'],
                    ['name' => 'Rodrigue Houngbédji', 'text' => 'Le suivi personnalisé fait vraiment la différence. Les moniteurs sont patients et rassurants.'],
                    ['name' => 'Nadège Kponou', 'text' => 'La formule accélérée m\'a permis d\'obtenir mon permis en un mois avant de commencer mon nouveau travail.'],
                ] as $testimonial)
                    <div class="card p-8">
                        <div class="flex gap-1 text-gold-500">
                            @for ($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.447a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.538 1.118l-3.367-2.447a1 1 0 00-1.176 0l-3.367 2.447c-.783.57-1.838-.196-1.538-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.063 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z" /></svg>
                            @endfor
                        </div>
                        <p class="mt-4 text-sm leading-relaxed text-stone-600">&ldquo;{{ $testimonial['text'] }}&rdquo;</p>
                        <p class="mt-4 font-display text-ink-900">{{ $testimonial['name'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow">
            <div class="card flex flex-col items-center gap-6 px-8 py-16 text-center">
                <h2 class="section-title max-w-xl">Prêt à prendre le volant ?</h2>
                <p class="max-w-xl text-stone-500">
                    Contactez-nous dès aujourd'hui pour un premier rendez-vous et démarrer votre formation au permis.
                </p>
                <a href="{{ route('contact') }}" class="btn-primary">Réserver un cours</a>
            </div>
        </div>
    </section>

@endsection
