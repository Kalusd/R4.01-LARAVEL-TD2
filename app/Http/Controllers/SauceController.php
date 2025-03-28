<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sauce;
use Illuminate\Support\Facades\Auth;

class SauceController extends Controller
{
    /**
     * Affichage de toutes les sauces
     */
    public function index(Request $request)
    {
        $sauces = Sauce::all();
        if ($request->expectsJson()) {
            return new JsonResponse($sauces);
        }
        return view('sauces.index', compact('sauces'));
    }

    /**
     * Affichage du formulaire pour créer une sauce
     */
    public function create(Request $request)
    {
        if ($request->expectsJson()) {
            return new JsonResponse(true);
        }
        return view('sauces.create');
    }

    /**
     * Stocker une sauce nouvellement créé
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'image' => 'nullable|image',
            'heat' => 'required|integer|min:1|max:10',
        ]);
        $sauce = new Sauce();
        $sauce->name = $request->name;
        $sauce->manufacturer = $request->manufacturer;
        $sauce->description = $request->description;
        $sauce->mainPepper = $request->mainPepper;
        $sauce->heat = $request->heat;
        $sauce->user_id = Auth::id();
        if ($request->hasFile('image')) {
            $image_url = $request->file('image')->store('images', 'public');
            $sauce->imageUrl = $image_url;
        }
        $sauce->save();
        if ($request->expectsJson()) {
            return new JsonResponse(true);
        }
        return redirect()->route('sauces.index');
    }

    /**
     * Affiche la sauce demandée
     */
    public function show(Request $request, string $id)
    {
        $sauce = Sauce::find($id);
        if ($request->expectsJson()) {
            return new JsonResponse($sauce);
        }
        return view('sauces.show', compact('sauce'));
    }

    /**
     * Affiche le formulaire d'édition d'une sauce
     */
    public function edit(Request $request, string $id)
    {
        $sauce = Sauce::find($id);
        return view('sauces.edit', compact('sauce'));
    }

    /**
     * Met à jour la sauce demandée
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'image' => 'nullable|image',
            'heat' => 'required|integer|min:1|max:10',
        ]);
        $sauce = Sauce::find($id);
        $sauce->name = $request->name;
        $sauce->manufacturer = $request->manufacturer;
        $sauce->description = $request->description;
        $sauce->mainPepper = $request->mainPepper;
        $sauce->heat = $request->heat;
        $sauce->user_id = Auth::id();
        if ($request->hasFile('image')) {
            $image_url = $request->file('image')->store('images', 'public');
            $sauce->imageUrl = $image_url;
        }
        $sauce->save();
        if ($request->expectsJson()) {
            return new JsonResponse(true);
        }
        return redirect()->route('sauces.index');
    }

    /**
     * Supprime la sauce demandée
     */
    public function destroy(Request $request, string $id)
    {
        $sauce = Sauce::find($id);
        $sauce->delete();
        if ($request->expectsJson()) {
            return new JsonResponse(true);
        }
        return redirect()->route('sauces.index');
    }

    /**
     * Ajoute un like à la sauce demandée
     */
    public function like(Request $request, string $id) {
        $sauce = Sauce::findOrFail($id);
        $user_id = Auth::id();
        // On convertit les attributs json usersLiked et usersDisliked en tableau si leur valeur n'est pas 'null'
        $usersLiked = json_decode($sauce->usersLiked ?? '[]', true);
        $usersDisliked = json_decode($sauce->usersDisliked ?? '[]', true);
        if (!in_array($user_id, $usersLiked)) { // Si l'utilisateur n'a pas déjà liké la sauce
            $usersLiked[] = $user_id;
            $sauce->likes++;
            if (($key = array_search($user_id, $usersDisliked)) !== false) { // Si l'utilisateur avait disliké la sauce
                unset($usersDisliked[$key]);
                $sauce->dislikes--;
            }
        }
        // On convertit les tableaux usersLiked et usersDisliked en json
        $sauce->usersLiked = json_encode($usersLiked);
        $sauce->usersDisliked = json_encode($usersDisliked);
        $sauce->save();
        if ($request->expectsJson()) {
            return new JsonResponse(true);
        }
        return back();
    }

    /**
     * Ajoute un dislike à la sauce demandée
     */
    public function dislike(Request $request, string $id) {
        $sauce = Sauce::findOrFail($id);
        $user_id = Auth::id();
        // On convertit les attributs json usersLiked et usersDisliked en tableau si leur valeur n'est pas 'null'
        $usersLiked = json_decode($sauce->usersLiked ?? '[]', true);
        $usersDisliked = json_decode($sauce->usersDisliked ?? '[]', true);
        if (!in_array($user_id, $usersDisliked)) { // Si l'utilisateur n'a pas déjà disliké la sauce
            $usersDisliked[] = $user_id;
            $sauce->dislikes++;
            if (($key = array_search($user_id, $usersLiked)) !== false) { // Si l'utilisateur avait liké la sauce
                unset($usersLiked[$key]);
                $sauce->likes--;
            }
        }
        // On convertit les tableaux usersLiked et usersDisliked en json
        $sauce->usersLiked = json_encode($usersLiked);
        $sauce->usersDisliked = json_encode($usersDisliked);
        $sauce->save();
        if ($request->expectsJson()) {
            return new JsonResponse(true);
        }
        return back();
    }
}
