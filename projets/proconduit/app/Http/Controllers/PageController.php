<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function tarifs(): View
    {
        return view('pages.tarifs');
    }

    public function apropos(): View
    {
        return view('pages.apropos');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'formule' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required' => 'Merci d\'indiquer votre nom.',
            'email.required' => 'Merci d\'indiquer votre email.',
            'email.email' => 'Cet email ne semble pas valide.',
            'message.required' => 'Merci de rédiger un message.',
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Merci pour votre message ! Notre équipe vous recontactera très rapidement.');
    }
}
