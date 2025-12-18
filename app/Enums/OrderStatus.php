<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';           // Order placed but not yet processed
    case PROCESSING = 'processing';     // Being prepared or packaged
    case SHIPPED = 'shipped';           // Sent to the customer
    case DELIVERED = 'delivered';       // Received by the customer
    case CANCELLED = 'cancelled';       // Order was cancelled
}
