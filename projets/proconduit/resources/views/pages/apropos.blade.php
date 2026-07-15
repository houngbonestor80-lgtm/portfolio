@extends('layouts.app')

@section('title', 'À propos')
@section('description', 'Découvrez l\'histoire, les valeurs et l\'équipe de ProConduite, auto-école à taille humaine implantée à Cotonou, Bénin.')

@section('content')

    <section
        class="photo-hero py-20 sm:py-28"
        style="background-image: url('https://images.unsplash.com/photo-1734867790637-1716c5b9ab42?fm=jpg&q=70&w=1920&auto=format&fit=crop');"
    >
        <div class="container-narrow text-center">
            <span class="eyebrow !text-gold-300">À propos de nous</span>
            <h1 class="mx-auto mt-6 max-w-2xl font-display text-4xl text-stone-50 sm:text-5xl">
                Une auto-école à taille humaine depuis 2010
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-stone-200">
                ProConduite est née d'une conviction simple : apprendre à conduire doit être une expérience rassurante, exigeante et sur-mesure, ancrée dans le quotidien de Cotonou.
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow grid items-center gap-12 lg:grid-cols-2">
            <div>
                <span class="eyebrow">Notre histoire</span>
                <h2 class="section-title mt-4">Du premier moniteur à toute une équipe</h2>
                <p class="mt-6 leading-relaxed text-stone-500">
                    Fondée en 2010 par un moniteur passionné, ProConduite a grandi grâce au bouche-à-oreille et à un principe simple : chaque élève progresse à son propre rythme. Aujourd'hui, notre équipe compte huit moniteurs diplômés d'État et plus de 3 200 élèves formés à Cotonou et ses environs.
                </p>
                <p class="mt-4 leading-relaxed text-stone-500">
                    Nous avons conservé l'esprit d'une auto-école de quartier &mdash; disponible, à l'écoute &mdash; tout en modernisant nos outils pédagogiques : livret de progression numérique, plateforme de code en ligne et véhicules récents.
                </p>
            </div>

            <div class="overflow-hidden rounded-2xl border border-stone-200 shadow-soft">
                <img
                    src="https://images.unsplash.com/photo-1586901027629-40a5d5238b7c?fm=jpg&q=70&w=1200&auto=format&fit=crop"
                    alt="Le village lacustre de Ganvié, sur le lac Nokoué au Bénin"
                    class="h-full w-full object-cover"
                    loading="lazy"
                >
            </div>
        </div>
    </section>

    <section class="bg-sand-100 py-16">
        <div class="container-narrow">
            <dl class="grid grid-cols-2 gap-8 text-center sm:grid-cols-4">
                <div>
                    <dt class="font-display text-3xl text-green-700">2010</dt>
                    <dd class="mt-2 text-sm text-stone-500">Année de création</dd>
                </div>
                <div>
                    <dt class="font-display text-3xl text-green-700">3 200+</dt>
                    <dd class="mt-2 text-sm text-stone-500">Élèves formés</dd>
                </div>
                <div>
                    <dt class="font-display text-3xl text-green-700">92 %</dt>
                    <dd class="mt-2 text-sm text-stone-500">Taux de réussite</dd>
                </div>
                <div>
                    <dt class="font-display text-3xl text-green-700">8</dt>
                    <dd class="mt-2 text-sm text-stone-500">Moniteurs diplômés</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Nos valeurs</span>
                <h2 class="section-title mt-4">Ce qui guide notre pédagogie</h2>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-3">
                @foreach ([
                    ['title' => 'Bienveillance', 'text' => 'Un cadre rassurant où chaque élève progresse à son rythme, sans jugement.'],
                    ['title' => 'Exigence', 'text' => 'Une pédagogie sérieuse pour former des conducteurs responsables et autonomes.'],
                    ['title' => 'Transparence', 'text' => 'Des tarifs clairs et un suivi honnête de votre progression, sans mauvaise surprise.'],
                ] as $value)
                    <div class="card p-8 text-center">
                        <h3 class="font-display text-lg text-ink-900">{{ $value['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-stone-500">{{ $value['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-sand-100 py-24">
        <div class="container-narrow">
            <div class="mx-auto max-w-2xl text-center">
                <span class="eyebrow">Notre équipe</span>
                <h2 class="section-title mt-4">Des moniteurs diplômés d'État</h2>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['name' => 'Espérance Houngbédji', 'role' => 'Directrice pédagogique', 'initials' => 'EH'],
                    ['name' => 'Koffi Adjovi', 'role' => 'Moniteur, spécialiste permis accéléré', 'initials' => 'KA'],
                    ['name' => 'Aïcha Moussa', 'role' => 'Monitrice, conduite accompagnée', 'initials' => 'AM'],
                    ['name' => 'Fabrice Dossou', 'role' => 'Moniteur, stages de perfectionnement', 'initials' => 'FD'],
                ] as $member)
                    <div class="card p-6 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-gradient font-display text-lg text-white">
                            {{ $member['initials'] }}
                        </div>
                        <h3 class="mt-4 font-display text-ink-900">{{ $member['name'] }}</h3>
                        <p class="mt-1 text-xs text-stone-500">{{ $member['role'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow">
            <div class="card flex flex-col items-center gap-6 px-8 py-16 text-center">
                <h2 class="section-title max-w-xl">Envie de nous rejoindre ?</h2>
                <p class="max-w-xl text-stone-500">
                    Prenez rendez-vous pour un premier échange avec notre équipe et démarrez votre parcours vers le permis.
                </p>
                <a href="{{ route('contact') }}" class="btn-primary">Nous contacter</a>
            </div>
        </div>
    </section>

@endsection
