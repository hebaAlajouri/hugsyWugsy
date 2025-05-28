@extends('layouts.admin')

@section('content')
<div class="feminine-orders-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h2 class="page-title">
                <i class="fas fa-heart"></i>
                Manage Orders
                <span class="subtitle">Keep track of all your beautiful orders</span>
            </h2>
            <a href="{{ route('admin.orders.create') }}" class="btn-add-order">
                <i class="fas fa-plus-circle"></i>
                Add New Order
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Orders Table -->
    <div class="orders-card">
        <div class="card-header">
            <h3><i class="fas fa-shopping-bag"></i> Orders Overview</h3>
            <span class="orders-count">{{ count($orders) }} orders</span>
        </div>
        
        <div class="table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th class="col-id"><i class="fas fa-hashtag"></i> ID</th>
                        <th class="col-customer"><i class="fas fa-user"></i> Customer</th>
                        <th class="col-email"><i class="fas fa-envelope"></i> Email</th>
                        <th class="col-phone"><i class="fas fa-phone"></i> Phone</th>
                        <th class="col-total"><i class="fas fa-dollar-sign"></i> Total</th>
                        <th class="col-actions"><i class="fas fa-cog"></i> Actions</th>
                    </tr>
                </thead>
               <tbody>
    @foreach ($orders as $order)
        <tr class="order-row">
            <td class="order-id" data-label="Order ID">#{{ $order->id }}</td>
            <td class="customer-name" data-label="Customer">
                <div class="customer-info">
                    <span class="name">{{ $order->user ? $order->user->name : 'Guest' }}</span>
                    @if(!$order->user)
                        <span class="guest-badge">Guest</span>
                    @endif
                </div>
            </td>
            <td class="email" data-label="Email">
                <span class="email-text">{{ $order->email ?: 'N/A' }}</span>
            </td>
            <td class="phone" data-label="Phone">
                <span class="phone-text">{{ $order->phone ?: 'N/A' }}</span>
            </td>
            <td class="total" data-label="Total">
                <span class="price">${{ number_format($order->total, 2) }}</span>
            </td>
            <td class="actions" data-label="Actions">
                <div class="action-buttons">
                    <a href="{{ route('admin.orders.edit', $order->id) }}" 
                       class="btn-edit" title="Edit Order">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" 
                          method="POST" 
                          style="display:inline-block"
                          class="delete-form">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" 
                                class="btn-delete" 
                                title="Delete Order"
                                onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.feminine-orders-container {
    padding: 2rem;
    background: linear-gradient(135deg, #ffeef8 0%, #f8f0ff 100%);
    min-height: 100vh;
    font-family: 'Poppins', 'Arial', sans-serif;
}

.page-header {
    margin-bottom: 2rem;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1rem;
}

.page-title {
    color: #8b5a87;
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
}

.page-title i {
    color: #e91e63;
    font-size: 2rem;
}

.subtitle {
    font-size: 1rem;
    color: #b388b5;
    font-weight: 400;
    margin-top: 0.25rem;
}

.btn-add-order {
    background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.3);
    transition: all 0.3s ease;
    border: none;
}

.btn-add-order:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(233, 30, 99, 0.4);
}

.success-message {
    background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
    color: #2e7d32;
    padding: 1rem 1.5rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 10px rgba(76, 175, 80, 0.2);
    border-left: 4px solid #4caf50;
}

.orders-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(139, 90, 135, 0.1);
    overflow: hidden;
    border: 1px solid rgba(233, 30, 99, 0.1);
}

.card-header {
    background: linear-gradient(135deg, #fce4ec 0%, #f3e5f5 100%);
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid rgba(233, 30, 99, 0.1);
}

.card-header h3 {
    color: #8b5a87;
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.orders-count {
    background: #e91e63;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.table-container {
    overflow-x: auto;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
    table-layout: fixed;
}

/* Column widths */
.col-id { width: 80px; }
.col-customer { width: 150px; }
.col-email { width: 200px; }
.col-phone { width: 130px; }
.col-total { width: 100px; }
.col-actions { width: 120px; }

.orders-table thead th {
    background: linear-gradient(135deg, #fce4ec 0%, #f8bbd9 100%);
    color: #8b5a87;
    padding: 1rem 0.75rem;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #e91e63;
    position: sticky;
    top: 0;
    z-index: 10;
    white-space: nowrap;
    font-size: 0.85rem;
}

.orders-table thead th i {
    margin-right: 0.5rem;
    color: #e91e63;
}

.order-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(233, 30, 99, 0.1);
}

.order-row:hover {
    background: linear-gradient(135deg, #ffeef8 0%, #fff0f8 100%);
    transform: scale(1.002);
}

.orders-table td {
    padding: 0.75rem;
    vertical-align: middle;
    word-wrap: break-word;
    overflow: hidden;
}

.order-id {
    font-weight: 600;
    color: #e91e63;
    font-size: 0.95rem;
    white-space: nowrap;
}

.customer-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.customer-info .name {
    font-weight: 500;
    color: #333;
    font-size: 0.9rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.guest-badge {
    background: linear-gradient(135deg, #ffb74d 0%, #ff9800 100%);
    color: white;
    font-size: 0.65rem;
    padding: 0.15rem 0.4rem;
    border-radius: 8px;
    font-weight: 500;
    width: fit-content;
}

.email-text, .phone-text {
    color: #666;
    font-size: 0.8rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: block;
}

.email-text:hover, .phone-text:hover {
    overflow: visible;
    white-space: normal;
    background: #fff;
    padding: 0.25rem;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    position: relative;
    z-index: 5;
}

.price {
    font-weight: 600;
    color: #2e7d32;
    font-size: 1rem;
    white-space: nowrap;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-edit, .btn-delete {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-edit {
    background: linear-gradient(135deg, #42a5f5 0%, #2196f3 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(33, 150, 243, 0.3);
}

.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.4);
    color: white;
    text-decoration: none;
}

.btn-delete {
    background: linear-gradient(135deg, #ef5350 0%, #f44336 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 67, 54, 0.3);
}

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(244, 67, 54, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .feminine-orders-container {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .page-title {
        font-size: 2rem;
        text-align: center;
        align-items: center;
    }
    
    .btn-add-order {
        align-self: center;
        width: fit-content;
        margin: 0 auto;
    }
    
    .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    /* Mobile table adjustments */
    .orders-table {
        font-size: 0.75rem;
    }
    
    .col-id { width: 60px; }
    .col-customer { width: 120px; }
    .col-email { width: 150px; }
    .col-phone { width: 110px; }
    .col-total { width: 80px; }
    .col-actions { width: 80px; }
    
    .orders-table th,
    .orders-table td {
        padding: 0.5rem 0.25rem;
    }
    
    .customer-info .name {
        font-size: 0.8rem;
    }
    
    .email-text, .phone-text {
        font-size: 0.75rem;
    }
    
    .price {
        font-size: 0.85rem;
    }
    
    .action-buttons {
        flex-direction: row;
        gap: 0.25rem;
        justify-content: center;
    }
    
    .btn-edit, .btn-delete {
        width: 28px;
        height: 28px;
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .btn-add-order {
        width: 100%;
        justify-content: center;
    }
    
    .card-header h3 {
        font-size: 1.2rem;
    }
    
    .orders-count {
        width: 100%;
        text-align: center;
    }
    
    .customer-info .name,
    .price {
        font-size: 0.85rem;
    }
}

/* Animation for rows */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.order-row {
    animation: fadeInUp 0.5s ease forwards;
}

/* Custom scrollbar for table container */
.table-container::-webkit-scrollbar {
    height: 8px;
}

.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
    border-radius: 10px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #c2185b 0%, #e91e63 100%);
}
@media (max-width: 768px) {
    .orders-table, 
    .orders-table thead, 
    .orders-table tbody, 
    .orders-table th, 
    .orders-table td, 
    .orders-table tr {
        display: block;
        width: 100%;
    }

    .orders-table thead {
        display: none;
    }

    .order-row {
        margin-bottom: 1.5rem;
        border: 1px solid #e91e63;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(233, 30, 99, 0.1);
        background: #fff5f9;
        padding: 1rem;
    }

    .orders-table td {
        padding: 0.5rem 0;
        position: relative;
        text-align: left;
    }

    .orders-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        font-weight: 600;
        color: #e91e63;
        padding-left: 1rem;
    }

    .orders-table td {
        padding-left: 50%;
        white-space: normal;
        overflow: visible;
        text-overflow: unset;
    }
}

</style>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection
