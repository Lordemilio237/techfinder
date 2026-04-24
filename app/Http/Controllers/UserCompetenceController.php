<?php

namespace App\Http\Controllers;

use App\Models\UserCompetence;
use Illuminate\Http\Request;
use Exception;

class UserCompetenceController extends Controller
{
    /**
     * Afficher toutes les associations utilisateur-compétence
     */
    public function index()
    {
        try {
            $userCompetences = UserCompetence::with('utilisateur')->get();

            return response()->json($userCompetences);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la récupération des associations',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ajouter une compétence à un utilisateur
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code_user' => 'required|integer',
                'code_comp' => 'required|integer'
            ]);

            $userCompetence = UserCompetence::create([
                'code_user' => $request->code_user,
                'code_comp' => $request->code_comp
            ]);

            return response()->json([
                'message' => 'Compétence ajoutée à l’utilisateur',
                'data' => $userCompetence
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'ajout',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Afficher une association spécifique
     */
    public function show($code_user, $code_comp)
    {
        try {
            $userCompetence = UserCompetence::where('code_user', $code_user)
                                            ->where('code_comp', $code_comp)
                                            ->firstOrFail();

            return response()->json($userCompetence);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Association non trouvée',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Modifier une association
     */
    public function update(Request $request, $code_user, $code_comp)
    {
        try {
            $userCompetence = UserCompetence::where('code_user', $code_user)
                                            ->where('code_comp', $code_comp)
                                            ->firstOrFail();

            $request->validate([
                'code_user' => 'sometimes|integer',
                'code_comp' => 'sometimes|integer'
            ]);

            $userCompetence->update($request->only([
                'code_user',
                'code_comp'
            ]));

            return response()->json([
                'message' => 'Association modifiée',
                'data' => $userCompetence
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la modification',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Supprimer une association
     */
    public function destroy($code_user, $code_comp)
    {
        try {
            $userCompetence = UserCompetence::where('code_user', $code_user)
                                            ->where('code_comp', $code_comp)
                                            ->firstOrFail();

            $userCompetence->delete();

            return response()->json([
                'message' => 'Association supprimée'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la suppression',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}