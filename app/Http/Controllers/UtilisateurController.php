<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class UtilisateurController extends Controller
{
    /**
     * Afficher tous les utilisateurs
     */
    public function index()
    {
        try {
            $utilisateurs = Utilisateur::with([
                'competences',
                'interventionsClient',
                'interventionsTechnicien'
            ])->get();

            return response()->json($utilisateurs);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la récupération des utilisateurs',
                'message' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue'
            ], 500);
        }
    }

    /**
     * Créer un utilisateur
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code_user' => 'required|string|max:50',
                'nom_user' => 'required|string|max:255',
                'prenom_user' => 'required|string|max:255',
                'login_user' => 'required|string|max:255',
                'password_user' => 'required|string|min:6|max:255',
                'tel_user' => 'nullable|string|max:20',
                'sexe_user' => 'nullable|string|max:10',
                'role_user' => 'required|string|max:50',
                'etat_user' => 'required|string|max:50'
            ]);

            $utilisateur = Utilisateur::create([
                'code_user' => $request->code_user,
                'nom_user' => $request->nom_user,
                'prenom_user' => $request->prenom_user,
                'login_user' => $request->login_user,
                // 🔐 Hash du mot de passe
                'password_user' => Hash::make($request->password_user),
                'tel_user' => $request->tel_user,
                'sexe_user' => $request->sexe_user,
                'role_user' => $request->role_user,
                'etat_user' => $request->etat_user
            ]);

            return response()->json([
                'message' => 'Utilisateur créé',
                'data' => $utilisateur
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création',
                'message' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue'
            ], 500);
        }
    }

    /**
     * Afficher un utilisateur
     */
    public function show(Utilisateur $utilisateur)
    {
        try {
            return response()->json(
                $utilisateur->load([
                    'competences',
                    'interventionsClient',
                    'interventionsTechnicien'
                ])
            );

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'affichage',
                'message' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue'
            ], 500);
        }
    }

    /**
     * Modifier un utilisateur
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        try {
            $request->validate([
                'nom_user' => 'sometimes|string|max:255',
                'prenom_user' => 'sometimes|string|max:255',
                'login_user' => 'sometimes|string|max:255',
                'password_user' => 'sometimes|string|min:6|max:255',
                'tel_user' => 'sometimes|string|max:20',
                'sexe_user' => 'sometimes|string|max:10',
                'role_user' => 'sometimes|string|max:50',
                'etat_user' => 'sometimes|string|max:50'
            ]);

            $data = $request->only([
                'nom_user',
                'prenom_user',
                'login_user',
                'password_user',
                'tel_user',
                'sexe_user',
                'role_user',
                'etat_user'
            ]);

            // 🔐 Hash seulement si le mot de passe est envoyé
            if ($request->has('password_user')) {
                $data['password_user'] = Hash::make($request->password_user);
            }

            $utilisateur->update($data);

            return response()->json([
                'message' => 'Utilisateur modifié',
                'data' => $utilisateur
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la modification',
                'message' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue'
            ], 500);
        }
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy(Utilisateur $utilisateur)
    {
        try {
            $utilisateur->delete();

            return response()->json([
                'message' => 'Utilisateur supprimé'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la suppression',
                'message' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue'
            ], 500);
        }
    }
}