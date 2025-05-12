<?php
namespace App\Enums;

/**
 * Enum pour les types de score possibles dans l'histoire interactive
 * 
 * Utilisé pour:
 * - Typer les impacts des choix (chat ou chien)
 * - Calculer le résultat final du questionnaire
 * - Déterminer l'animal recommandé
 * 
 * @package App\Enums
 */
enum ScoreType: string
{

    /**
     * Score orienté chat
     * Indique une préférence ou compatibilité avec les chats
     */
    case CHAT  = 'chat';

    /**
     * Score orienté chien
     * Indique une préférence ou compatibilité avec les chiens
     */
    case CHIEN = 'chien';
}
