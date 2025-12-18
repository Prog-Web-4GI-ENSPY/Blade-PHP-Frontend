<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil
     */
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_visible', true)
            ->where('is_featured', true)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $categories = Category::where('is_visible', true)
            ->orderBy('position')
            ->take(6)
            ->get();

        return view('pages.home', compact('featuredProducts', 'categories'));
    }

    /**
     * Afficher la page À propos
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Afficher la page Contact
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Traiter le formulaire de contact
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Ici vous pouvez envoyer un email ou sauvegarder en base
        // Pour l'instant, on retourne juste un message de succès

        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons bientôt.');
    }
}