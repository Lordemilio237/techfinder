<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Affiche la liste des utilisateurs
     */
  public function index()
{
    // On ajoute latest() pour mettre le tout nouveau en haut de la liste
    $users = Utilisateur::latest()->paginate(10); 
    return view('Utilisateur', compact('users'));
}
    /**
     * Enregistre un nouvel utilisateur
     */
     public function store(Request $request)
{
    // 1. Validation complète
    $request->validate([
        'nom_user'      => 'required|string|max:255',
        'prenom_user'   => 'required|string|max:255',
        'login_user'    => 'required|email|unique:utilisateurs,login_user',
        'password_user' => 'required|min:6',
        'tel_user'      => 'nullable|string|max:20',
        'sexe_user'     => 'required|in:M,F',
        'role_user'     => 'required|string',
        'etat_user'     => 'required|boolean',
    ]);

    $nouveauCode = 'U' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); 

    // 2. Création avec toutes les données du formulaire
    Utilisateur::create([
        'code_user'     => $nouveauCode,
        'nom_user'      => $request->nom_user,
        'prenom_user'   => $request->prenom_user,
        'login_user'    => $request->login_user,
        'password_user' => Hash::make($request->password_user),
        'tel_user'      => $request->tel_user, 
        'sexe_user'     => $request->sexe_user,
        'role_user'     => $request->role_user,
        'etat_user'     => $request->etat_user,
    ]);

    return redirect()->back()->with('success', "Utilisateur créé avec succès !");
}

    /**
     * Affiche le formulaire de modification (vue orange)
     */
    public function edit($id)
    {
        // Utilise la clé primaire personnalisée code_user
        $user = Utilisateur::findOrFail($id);
        return view('Utilisateur.edit', compact('user'));
    }

    /**
     * Met à jour l'utilisateur existant
     */
    public function update(Request $request, $id)
{
    $user = Utilisateur::findOrFail($id);

    $request->validate([
        'nom_user'    => 'required|string|max:255',
        'prenom_user' => 'required|string|max:255',
        'login_user'  => 'required|email|unique:utilisateurs,login_user,'.$id.',code_user',
        'tel_user'    => 'nullable|string|max:20',
        'sexe_user'   => 'required|in:M,F',
        'role_user'   => 'required|string',
        'etat_user'   => 'required|boolean',
    ]);

    $data = [
        'nom_user'    => $request->nom_user,
        'prenom_user' => $request->prenom_user,
        'login_user'  => $request->login_user,
        'tel_user'    => $request->tel_user,
        'sexe_user'   => $request->sexe_user,
        'role_user'   => $request->role_user,
        'etat_user'   => $request->etat_user,
    ];

    // On ne change le mot de passe que s'il est saisi
    if ($request->filled('password_user')) {
        $data['password_user'] = Hash::make($request->password_user);
    }

    $user->update($data);

    return redirect()->route('web.users.index')->with('success', "L'utilisateur a été mis à jour avec succès.");
}
    /**
     * Supprime un utilisateur
     */
    public function destroy($id)
    {
        $user = Utilisateur::findOrFail($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}