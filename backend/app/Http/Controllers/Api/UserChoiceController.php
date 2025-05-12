<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChoiceRequest;
use App\Http\Requests\ResetUserChoicesRequest;
use App\Models\UserChoice;
use App\Exceptions\ApiException;
use App\Traits\JsonResponseTrait;

/**
 * Gère les choix effectués par les utilisateurs dans l'histoire interactive
 * Permet de sauvegarder et réinitialiser les choix d'un utilisateur
 * Utilise des Form Requests pour la validation des données
 */
class UserChoiceController extends Controller
{
    //Utilise JsonResponseTrait pour standardiser les réponses API
    use JsonResponseTrait;

    /**
     * Enregistre un nouveau choix d'utilisateur
     * POST /api/user-choices
     * 
     * @param UserChoiceRequest $request Contient user_id et choice_id validés
     * @return \Illuminate\Http\JsonResponse Retourne le choix créé
     * @throws ApiException Si la création échoue
     * 
     * La méthode:
     * 1. Valide les données avec UserChoiceRequest
     * 2. Crée une nouvelle entrée dans user_choices
     * 3. Retourne une réponse 201 en cas de succès
     */
    public function store(UserChoiceRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $userChoice = UserChoice::create([
                'user_id' => $validated['user_id'],
                'choice_id' => $validated['choice_id']
            ]);

            return $this->successResponse(
                $userChoice,
                'Choice saved successfully',
                201
            );
        } catch (\Exception $e) {
            throw new ApiException('Failed to save user choice', 500);
        }
    }

    /**
     * Réinitialise tous les choix d'un utilisateur
     * POST /api/user-choices/reset
     * 
     * @param ResetUserChoicesRequest $request Contient user_id validé
     * @return \Illuminate\Http\JsonResponse Message de succès
     * @throws ApiException Si la réinitialisation échoue
     * 
     * La méthode:
     * 1. Valide l'ID utilisateur
     * 2. Supprime tous ses choix existants
     * 3. Permet de recommencer l'histoire à zéro
     */
    public function reset(ResetUserChoicesRequest $request)
    {
        try {
            $validated = $request->validated();
            UserChoice::where('user_id', $validated['user_id'])->delete();

            return $this->successResponse(
                null,
                'Choices reset successfully'
            );
        } catch (\Exception $e) {
            throw new ApiException('Failed to reset choices', 500);
        }
    }
}