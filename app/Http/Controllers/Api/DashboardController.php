<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * @OA\Tag(
 * name="Dashboard & Reports",
 * description="API Endpoints for Management Dashboard KPIs and charts data"
 * )
 */
class DashboardController extends Controller
{
    private const MANAGEMENT_ROLES = ['ADMIN', 'MANAGER', 'SUPERVISOR'];

    /**
     * Vérifie si l'utilisateur est autorisé.
     */
    private function checkAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        // Assurez-vous que les méthodes isAdmin(), isManager(), isSupervisor() existent dans le modèle User
        return $user && ($user->isAdmin() || $user->isManager() || $user->isSupervisor());
    }

    /**
     * @OA\Get(
     * path="/api/dashboard/kpis",
     * summary="Get main Key Performance Indicators (KPIs)",
     * tags={"Dashboard & Reports"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="KPIs retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="KPIs retrieved successfully"),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="total_revenue", type="number", format="float", example=125000.50),
     * @OA\Property(property="total_orders", type="integer", example=520),
     * @OA\Property(property="new_orders_today", type="integer", example=12),
     * @OA\Property(property="active_users", type="integer", example=300),
     * @OA\Property(property="delivery_rate", type="number", format="float", example=0.92, description="Percentage of delivered orders"),
     * @OA\Property(property="delivered_orders", type="integer", example=478, description="Total delivered orders count"),
     * * @OA\Property(property="orders_ready_to_ship", type="integer", example=20, description="Nombre de commandes en attente d'expédition."),
     * @OA\Property(property="deliveries_in_progress", type="integer", example=5, description="Nombre de commandes avec le statut IN_DELIVERY."),
     * @OA\Property(property="deliveries_successful", type="integer", example=478, description="Nombre total de livraisons réussies."),
     * @OA\Property(property="deliveries_failed", type="integer", example=2, description="Nombre total de livraisons échouées."),
     * )
     * )
     * )
     * ),
     * @OA\Response(response=403, description="Forbidden")
     * )
     */

    public function getKpis()
    {
        if (!$this->checkAccess()) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        $today = Carbon::today();

        // -------------------------
        // 1. KPIs Standard (Déjà implémentés)
        // -------------------------
        $totalOrders = Order::count();
        $totalRevenue = Order::whereIn('status', ['PAID', 'DELIVERED'])->sum('total');
        $deliveredOrders = Order::where('status', 'DELIVERED')->count();
        $deliveryRate = $totalOrders > 0 ? round($deliveredOrders / $totalOrders, 4) : 0;
        $activeUsers = User::where('role', User::ROLE_CLIENT)->count(); 


        // -------------------------
        // 2. Nouveaux KPIs de Logistique
        // -------------------------
        
        // Commandes prêtes à expédier (après paiement, avant l'envoi)
        $readyToShip = Order::where('status', 'PAID')->count(); 
        
        // Commandes en cours de livraison
        $inDelivery = Order::where('status', 'IN_DELIVERY')->count(); 
        
        // Livraisons réussies / échouées
        $successfulDeliveries = Order::where('status', 'DELIVERED')->count();
        $failedDeliveries = Order::where('status', 'FAILED')->count(); 


        $kpis = [
            // Standard
            'total_revenue' => (float) $totalRevenue,
            'total_orders' => (int) $totalOrders,
            'active_users' => (int) $activeUsers,
            'delivery_rate' => $deliveryRate,
            
            // Logistique
            'orders_ready_to_ship' => (int) $readyToShip,
            'deliveries_in_progress' => (int) $inDelivery,
            'deliveries_successful' => (int) $successfulDeliveries,
            'deliveries_failed' => (int) $failedDeliveries,
        ];

        return response()->json([
            'message' => 'KPIs retrieved successfully',
            'data' => $kpis,
        ]);
    }

/**
     * @OA\Get(
     * path="/api/dashboard/sales-over-time",
     * summary="Get sales volume and revenue trend over a period (e.g., last 30 days)",
     * tags={"Dashboard & Reports"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="period", in="query", @OA\Schema(type="string", enum={"day", "week", "month"}), example="day", description="Granularity of aggregation"),
     * @OA\Parameter(name="days", in="query", @OA\Schema(type="integer", default=30), description="Number of days to look back"),
     * @OA\Response(
     * response=200,
     * description="Sales data retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string"),
     * @OA\Property(property="data", type="array", @OA\Items(
     * @OA\Property(property="label", type="string", example="2025-12-01"),
     * @OA\Property(property="revenue", type="number", format="float", example=1500.50),
     * @OA\Property(property="order_count", type="integer", example=10)
     * ))
     * )
     * )
     * )
     */
    public function getSalesOverTime(Request $request)
    {
        if (!$this->checkAccess()) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        $days = $request->get('days', 30);
        $period = $request->get('period', 'day'); // day, week, month
        
        $startDate = Carbon::now()->subDays($days)->startOfDay();

        // Déterminer la colonne de regroupement
        if ($period === 'week') {
            // Groupement par année et numéro de semaine
            // Utiliser 1 pour la semaine commençant le lundi, CONCAT pour éviter les confusions d'année
            $selectLabel = DB::raw("CONCAT(YEAR(created_at), '-', WEEK(created_at, 1)) as label"); 
        } elseif ($period === 'month') {
            // Groupement par année et mois
            $dateFormat = '%Y-%m';
            $selectLabel = DB::raw("DATE_FORMAT(created_at, '{$dateFormat}') as label");
        } else {
            // Groupement par jour (par défaut)
            $dateFormat = '%Y-%m-%d';
            $selectLabel = DB::raw("DATE_FORMAT(created_at, '{$dateFormat}') as label");
        }


        $salesData = Order::select(
                $selectLabel,
                DB::raw('SUM(total) as revenue'),
                DB::raw('COUNT(id) as order_count')
            )
            ->whereIn('status', ['PAID', 'DELIVERED']) 
            ->where('created_at', '>=', $startDate)
            ->groupBy('label')
            ->orderBy('label', 'asc')
            ->get();

        return response()->json([
            'message' => 'Sales data retrieved successfully',
            'data' => $salesData,
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/dashboard/top-products",
     * summary="Get top selling products (quantity and revenue)",
     * tags={"Dashboard & Reports"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="limit", in="query", @OA\Schema(type="integer", default=10)),
     * @OA\Response(
     * response=200,
     * description="Top products retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string"),
     * @OA\Property(property="data", type="array", @OA\Items(
     * @OA\Property(property="product_name", type="string"),
     * @OA\Property(property="total_quantity", type="integer"),
     * @OA\Property(property="total_revenue", type="number", format="float")
     * ))
     * )
     * )
     * )
     */

    public function getTopProducts(Request $request)
    {
        if (!$this->checkAccess()) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        $limit = $request->get('limit', 10);

        // Jointure avec OrderItem et Product
        $topProducts = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.total) as total_revenue') // Le total dans order_items est prix * quantité
            )
            ->whereIn('orders.status', ['PAID', 'DELIVERED'])
            ->groupBy('products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'message' => 'Top selling products retrieved successfully',
            'data' => $topProducts,
        ]);
    }

// Fichier : app/Http/Controllers/Api/DashboardController.php

    /**
     * @OA\Get(
     * path="/api/dashboard/order-status-distribution",
     * summary="Get the count of orders by status for pie charts",
     * tags={"Dashboard & Reports"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Status distribution retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string"),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="PENDING", type="integer", example=10),
     * @OA\Property(property="DELIVERED", type="integer", example=400)
     * )
     * ) 
     * ) 
     * ) 
     */
    public function getOrderStatusDistribution()
    {
        if (!$this->checkAccess()) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        $statusCounts = Order::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return response()->json([
            'message' => 'Order status distribution retrieved successfully',
            'data' => $statusCounts,
        ]);
    }
}