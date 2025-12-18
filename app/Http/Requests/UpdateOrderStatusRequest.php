<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autoriser uniquement les rôles de gestion à changer le statut
        $user = $this->user();
        return $user && ($user->isAdmin() || $user->isManager() || $user->isSupervisor());
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Assurez-vous que les constantes de statut sont définies dans votre modèle Order
        return [
            'status' => [
                'required',
                'string',
                // Validation que le statut est une valeur valide
                Rule::in([
                    Order::STATUS_PENDING,
                    Order::STATUS_PROCESSING,
                    Order::STATUS_PAID,
                    Order::STATUS_SHIPPED,
                    Order::STATUS_DELIVERED,
                    Order::STATUS_CANCELED,
                    Order::STATUS_FAILED,
                    Order::STATUS_IN_DELIVERY 
                ]),
            ],
        ];
    }
}