@extends('layouts.app')

@section('title', 'Contact')
@section('description', 'Contactez ProConduite à Cotonou pour réserver un cours, poser une question sur nos formules ou planifier votre premier rendez-vous.')

@section('content')

    <section
        class="photo-hero py-20 sm:py-28"
        style="background-image: url('https://images.unsplash.com/photo-1709600677177-dd125e80dd6e?fm=jpg&q=70&w=1920&auto=format&fit=crop');"
    >
        <div class="container-narrow text-center">
            <span class="eyebrow !text-gold-300">Contact</span>
            <h1 class="mx-auto mt-6 max-w-2xl font-display text-4xl text-stone-50 sm:text-5xl">
                Parlons de votre projet de permis
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-stone-200">
                Une question, une envie de vous inscrire ? Notre équipe à Cotonou vous répond sous 24h ouvrées.
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="container-narrow grid gap-10 lg:grid-cols-5">

            <div class="lg:col-span-3">
                <div class="card p-8 sm:p-10">

                    @if (session('success'))
                        <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="text-sm font-medium text-stone-600">Nom complet</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    class="mt-2 w-full rounded-lg border-stone-300 bg-white text-ink-900 placeholder:text-stone-400 focus:border-green-500 focus:ring-green-500"
                                    placeholder="Votre nom et prénom"
                                >
                                @error('name')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="text-sm font-medium text-stone-600">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="mt-2 w-full rounded-lg border-stone-300 bg-white text-ink-900 placeholder:text-stone-400 focus:border-green-500 focus:ring-green-500"
                                    placeholder="vous@email.bj"
                                >
                                @error('email')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="phone" class="text-sm font-medium text-stone-600">Téléphone <span class="text-stone-400">(optionnel)</span></label>
                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    value="{{ old('phone') }}"
                                    class="mt-2 w-full rounded-lg border-stone-300 bg-white text-ink-900 placeholder:text-stone-400 focus:border-green-500 focus:ring-green-500"
                                    placeholder="01 23 45 67 89"
                                >
                                @error('phone')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="formule" class="text-sm font-medium text-stone-600">Formule souhaitée <span class="text-stone-400">(optionnel)</span></label>
                                <select
                                    name="formule"
                                    id="formule"
                                    class="mt-2 w-full rounded-lg border-stone-300 bg-white text-ink-900 focus:border-green-500 focus:ring-green-500"
                                >
                                    <option value="" @selected(old('formule', request('formule')) === null || old('formule', request('formule')) === '')>Je ne sais pas encore</option>
                                    @foreach (['Formule Essentielle', 'Formule Confort', 'Formule Accélérée', 'Cours de code intensif'] as $formule)
                                        <option value="{{ $formule }}" @selected(old('formule', request('formule')) === $formule)>{{ $formule }}</option>
                                    @endforeach
                                </select>
                                @error('formule')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="text-sm font-medium text-stone-600">Message</label>
                            <textarea
                                name="message"
                                id="message"
                                rows="5"
                                class="mt-2 w-full rounded-lg border-stone-300 bg-white text-ink-900 placeholder:text-stone-400 focus:border-green-500 focus:ring-green-500"
                                placeholder="Parlez-nous de votre projet : date souhaitée, disponibilités, questions..."
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full sm:w-auto">Envoyer ma demande</button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="card space-y-6 p-8">
                    <div>
                        <h2 class="font-display text-lg text-ink-900">Nos coordonnées</h2>
                        <ul class="mt-4 space-y-4 text-sm text-stone-500">
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 flex-none text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                <span>Boulevard Saint-Michel, Akpakpa, Cotonou, Bénin</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 flex-none text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                                <a href="tel:+22901234567" class="transition hover:text-green-700">+229 01 23 45 67</a>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 flex-none text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                <a href="mailto:contact@proconduite.bj" class="transition hover:text-green-700">contact@proconduite.bj</a>
                            </li>
                        </ul>
                    </div>

                    <div class="border-t border-stone-200 pt-6">
                        <h2 class="font-display text-lg text-ink-900">Horaires</h2>
                        <dl class="mt-4 space-y-2 text-sm text-stone-500">
                            <div class="flex justify-between">
                                <dt>Lundi &ndash; Vendredi</dt>
                                <dd class="text-stone-700">8h &ndash; 19h</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Samedi</dt>
                                <dd class="text-stone-700">8h &ndash; 17h</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Dimanche</dt>
                                <dd class="text-stone-700">Fermé</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-stone-200">
                        <iframe
                            src="https://www.openstreetmap.org/export/embed.html?bbox=2.375%2C6.352%2C2.445%2C6.392&layer=mapnik&marker=6.372%2C2.412"
                            class="h-48 w-full"
                            loading="lazy"
                            title="Localisation de ProConduite à Cotonou"
                        ></iframe>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
