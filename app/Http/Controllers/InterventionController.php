<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Exception;

class InterventionController extends Controller
{
    /**
     * Afficher toutes les interventions
     */
    public function index()
    {
        try {
            $interventions = Intervention::with([
                'client',
                'technicien',
                'competence'
            ])->get();

            return response()->json($interventions);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la récupération des interventions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Créer une intervention
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'date_int' => 'required|string',
                'note_int' => 'nullable|integer',
                'commentaire_int' => 'nullable|string',
                'code_user_client' => 'required|string',
                'code_user_techn' => 'required|string',
                'code_comp' => 'required|integer'
            ]);

            $intervention = Intervention::create([
                'date_int' => $request->date_int,
                'note_int' => $request->note_int,
                'commentaire_int' => $request->commentaire_int,
                'code_user_client' => $request->code_user_client,
                'code_user_techn' => $request->code_user_techn,
                'code_comp' => $request->code_comp
            ]);

            return response()->json([
                'message' => 'Intervention créée',
                'data' => $intervention
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Afficher une intervention
     */
    public function show(Intervention $intervention)
    {
        try {
            return response()->json(
                $intervention->load([
                    'client',
                    'technicien',
                    'competence'
                ])
            );
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'affichage',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Modifier une intervention
     */
    public function update(Request $request, Intervention $intervention)
    {
        try {
            $request->validate([
                'date_int' => 'sometimes|string',
                'note_int' => 'sometimes|integer',
                'commentaire_int' => 'sometimes|string',
                'code_user_client' => 'sometimes|integer',
                'code_user_techn' => 'sometimes|integer',
                'code_comp' => 'sometimes|integer'
            ]);

            $intervention->update($request->only([
                'date_int',
                'note_int',
                'commentaire_int',
                'code_user_client',
                'code_user_techn',
                'code_comp'
            ]));

            return response()->json([
                'message' => 'Intervention modifiée',
                'data' => $intervention
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la modification',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Supprimer une intervention
     */
    public function destroy(Intervention $intervention)
    {
        try {
            $intervention->delete();

            return response()->json([
                'message' => 'Intervention supprimée'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la suppression',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}