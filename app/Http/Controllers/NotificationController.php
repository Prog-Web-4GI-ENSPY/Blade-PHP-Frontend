<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 * name="Notifications",
 * description="Opérations de test pour l'envoi de notifications par e-mail (Mailable)."
 * )
 */
class NotificationController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/v1/notifications/test-registration",
     * operationId="testRegistrationEmail",
     * tags={"Notifications"},
     * summary="Teste l'envoi de l'e-mail de confirmation d'inscription.",
     * description="Nécessite qu'un utilisateur avec l'ID 1 existe.",
     * @OA\Response(
     * response=200,
     * description="E-mail de test d'inscription envoyé avec succès (Vérifiez la console pour les erreurs)."
     * ),
     * @OA\Response(
     * response=404,
     * description="Utilisateur non trouvé."
     * ),
     * @OA\Response(
     * response=500,
     * description="Erreur d'envoi d'e-mail."
     * )
     * )
     */
    public function testRegistration(Request $request)
    {
        // Récupérer un utilisateur existant pour le test (par exemple, l'utilisateur avec l'ID 1)
        $user = User::find(1);

        if (!$user) {
            return response()->json(['message' => 'User with ID 1 not found for testing.'], 404);
        }

        try {
            Mail::to($user->email)->send(new UserRegistered($user));
            return response()->json([
                'message' => 'Registration confirmation email sent successfully to ' . $user->email,
                'user_id' => $user->id
            ], 200);
        } catch (\Exception $e) {
            Log::error('Échec de l\'envoi de l\'e-mail d\'inscription: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send email. Check logs for details.'], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/v1/notifications/test-order",
     * operationId="testOrderEmail",
     * tags={"Notifications"},
     * summary="Teste l'envoi de l'e-mail de confirmation de commande.",
     * description="Nécessite qu'un utilisateur avec l'ID 1 existe.",
     * @OA\Response(
     * response=200,
     * description="E-mail de test de commande envoyé avec succès."
     * )
     * )
     */
    public function testOrder(Request $request)
    {
        // Récupérer un utilisateur existant pour le test
        $user = User::find(1);

        if (!$user) {
            return response()->json(['message' => 'User with ID 1 not found for testing.'], 404);
        }

        // Créer des données de commande de mock pour le test
        $mockOrder = (object) [
            'id' => 12345,
            'total' => 99.99,
            'items' => [
                (object)['name' => 'T-shirt Logo', 'qty' => 1, 'price' => 29.99],
                (object)['name' => 'Casquette Classique', 'qty' => 2, 'price' => 35.00],
            ],
            'shipping_address' => '123 Rue du Test, 75001 Paris'
        ];

        try {
            // Envoyer la notification de commande
            //Mail::to($user->email)->send(new OrderPlaced($user, $mockOrder));

            return response()->json([
                'message' => 'Order confirmation email sent successfully to ' . $user->email,
                'order_id' => $mockOrder->id
            ], 200);
        } catch (\Exception $e) {
            Log::error('Échec de l\'envoi de l\'e-mail de commande: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send order email. Check logs for details.'], 500);
        }
    }
}
