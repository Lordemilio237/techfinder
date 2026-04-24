<?php

namespace App\Http\Controllers\web;

use App\Models\Competence;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CompetenceController extends Controller
{
    public function index()
    {
        $competence_list = Competence::orderBy('code_comp', 'asc')->paginate(10);
        return view('Competence', compact('competence_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_comp' => 'required|unique:competences,code_comp', // Ajouté car nécessaire
            'label_comp' => 'required|string|max:255',
            'description_comp' => 'nullable|string'
        ]);

        try {
            $competence = Competence::create($request->all());

            return response()->json([
                'message' => 'Compétence créée avec succès !',
                'data' => $competence
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $code_comp)
    {
        $request->validate([
            'label_comp' => 'required|string|max:255',
            'description_comp' => 'nullable|string'
        ]);

        try {
            $competence = Competence::findOrFail($code_comp);
            // Correction ici : on utilisait label_comp pour la description dans votre code
            $competence->update([
                'label_comp' => $request->label_comp,
                'description_comp' => $request->description_comp
            ]);

            return response()->json([
                'message' => 'Compétence mise à jour !',
                'data' => $competence
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur lors de la modif'], 500);
        }
    }

    public function destroy($code_comp)
    {
        try {
            $competence = Competence::findOrFail($code_comp);
            $competence->delete();
            return response()->json(['message' => 'Compétence supprimée avec succès !'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Suppression impossible'], 500);
        }
    }
}