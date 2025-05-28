@extends('layouts.admin')

@section('content')
{{-- 🌸 Custom Styles --}}
<style>
    .admin-container {
        background: linear-gradient(135deg, #ffeef8 0%, #f8f4ff 100%);
        min-height: 100vh;
        padding: 2rem;
    }
    
    .header-card {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
        border-radius: 25px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(255, 182, 193, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .header-title {
        color: #fff;
        font-size: 2.5rem;
        font-weight: 600;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .add-btn {
        background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 6px 20px rgba(196, 69, 105, 0.3);
        transition: all 0.3s ease;
        margin-left: auto;
    }
    
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(196, 69, 105, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #b5d8b5;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        color: #155724;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(181, 216, 181, 0.3);
    }
    
    .alert-success::before {
        content: '✅';
        font-size: 1.2rem;
    }
    
    .table-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(255, 182, 193, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }
    
    .custom-table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(255, 182, 193, 0.15);
        background: white;
    }
    
    .custom-table thead th {
        background: linear-gradient(135deg, #ffeef8 0%, #f8f4ff 100%);
        color: #6b4c7a;
        font-weight: 600;
        padding: 1.2rem;
        text-align: center;
        border: none;
        font-size: 1.1rem;
    }
    
    .custom-table tbody td {
        padding: 1.2rem;
        text-align: center;
        border-bottom: 1px solid #ffeef8;
        color: #5a4a6b;
        font-weight: 500;
        vertical-align: middle;
    }
    
    .custom-table tbody tr {
        transition: all 0.3s ease;
    }
    
    .custom-table tbody tr:hover {
        background: linear-gradient(135deg, #fff0f6 0%, #faf0ff 100%);
        transform: scale(1.01);
    }
    
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .action-btn {
        padding: 6px 15px;
        border-radius: 20px;
        border: none;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.3s ease;
        margin: 0 3px;
        font-size: 0.85rem;
    }
    
    .edit-btn {
        background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
        color: white;
    }
    
    .edit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .delete-btn {
        background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
        color: white;
    }
    
    .delete-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(232, 67, 147, 0.4);
        color: white;
    }
    
    .order-badge {
        background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(108, 92, 231, 0.3);
    }
    
    .product-name {
        font-weight: 600;
        color: #8b5a96;
    }
    
    .quantity-badge {
        background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        color: #6c5ce7;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(253, 203, 110, 0.3);
    }
    
    .price-tag {
        background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(0, 184, 148, 0.3);
    }
    
    .id-badge {
        background: linear-gradient(135deg, #dda0dd 0%, #ba68c8 100%);
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #b298c7;
        font-size: 1.2rem;
        font-weight: 500;
    }
    
    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        display: block;
    }
    
    .deleted-product {
        color: #e84393;
        font-style: italic;
        opacity: 0.8;
    }
    
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .header-title {
            font-size: 2rem;
        }
        
        .admin-container {
            padding: 1rem;
        }
        
        .custom-table {
            font-size: 0.85rem;
        }
        
        .custom-table thead th,
        .custom-table tbody td {
            padding: 0.8rem 0.4rem;
        }
        
        .action-btn {
            padding: 4px 8px;
            font-size: 0.75rem;
            margin: 1px;
        }
        
        .table-card {
            padding: 1rem;
            overflow-x: auto;
        }
    }
    
    .sparkle-decoration {
        position: absolute;
        color: rgba(255, 182, 193, 0.4);
        font-size: 1.5rem;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    .sparkle-1 { top: 10%; right: 10%; animation-delay: 0s; }
    .sparkle-2 { top: 70%; left: 10%; animation-delay: 0.7s; }
    .sparkle-3 { top: 40%; right: 5%; animation-delay: 1.4s; }
    
    @keyframes sparkle {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.2); }
    }
    /* Base styles as before, no horizontal scrollbar on desktop */

.table-card {
  background: rgba(255, 255, 255, 0.9);
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 8px 32px rgba(255, 182, 193, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
  /* remove overflow-x here */
}

/* Table normal style on desktop */
.custom-table {
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(255, 182, 193, 0.15);
  background: white;
  width: 100%;
}

/* Hide horizontal scrollbar on mobile and convert table to cards */
@media (max-width: 768px) {
  .custom-table, 
  .custom-table thead, 
  .custom-table tbody, 
  .custom-table th, 
  .custom-table td, 
  .custom-table tr {
    display: block;
    width: 100%;
  }
  
  /* Hide table header on mobile */
  .custom-table thead tr {
    display: none;
  }
  
  .custom-table tbody tr {
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #fff0f6 0%, #faf0ff 100%);
    border-radius: 15px;
    padding: 1rem;
    box-shadow: 0 3px 15px rgba(255, 182, 193, 0.2);
  }
  
  .custom-table tbody td {
    /* Add label before each cell */
    position: relative;
    padding-left: 50%;
    text-align: left;
    border-bottom: none;
    font-size: 0.9rem;
    font-weight: 600;
    color: #5a4a6b;
  }
  
  /* Label text from data-label attribute */
  .custom-table tbody td::before {
    content: attr(data-label);
    position: absolute;
    left: 1rem;
    top: 1rem;
    font-weight: 700;
    color: #8b5a96;
    white-space: nowrap;
  }
  
  /* Last td no border */
  .custom-table tbody td:last-child {
    border-bottom: none;
  }
  
  /* Action buttons inline and smaller */
  .action-btn {
    padding: 6px 10px;
    font-size: 0.8rem;
    margin: 0 2px 6px 0;
  }
  
  /* Adjust badges */
  .order-badge,
  .quantity-badge,
  .price-tag,
  .id-badge {
    display: inline-block;
    margin-top: 0.3rem;
    font-size: 0.85rem;
  }
}

</style>

<div class="admin-container">
    {{-- ✨ Decorative Sparkles --}}
    <div class="sparkle-decoration sparkle-1">✨</div>
    <div class="sparkle-decoration sparkle-2">💫</div>
    <div class="sparkle-decoration sparkle-3">🌟</div>
    
    {{-- 🌼 Header --}}
    <div class="header-card">
        <div class="header-content">
            <h2 class="header-title">
                <span>🛍️</span>
                Order Items Management
                <span>💖</span>
            </h2>
            {{-- ➕ Add Order Item Button --}}
            <a href="{{ route('admin.order_items.create') }}" class="add-btn">
                <span>✨</span>
                Add Order Item
                <span>🛒</span>
            </a>
        </div>
    </div>

    {{-- 🎉 Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 📋 Order Items Table --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="table custom-table w-100">
                <thead>
                    <tr>
                        <th>🆔 ID</th>
                        <th>📋 Order</th>
                        <th>🛍️ Product</th>
                        <th>📦 Quantity</th>
                        <th>💰 Price</th>
                        <th>🛠️ Actions</th>
                    </tr>
                </thead>
               <tbody>
    @forelse($orderItems as $item)
        <tr>
            <td data-label="ID">
                <span class="id-badge">{{ $item->id }}</span>
            </td>
            <td data-label="Order ID">
                <span class="order-badge">#{{ $item->order_id }}</span>
            </td>
            <td data-label="Product Name">
                <span class="{{ $item->product ? 'product-name' : 'deleted-product' }}">
                    {{ $item->product->name ?? 'Deleted Product' }}
                    @if(!$item->product)
                        <span>🚫</span>
                    @endif
                </span>
            </td>
            <td data-label="Quantity">
                <span class="quantity-badge">{{ $item->quantity }}</span>
            </td>
            <td data-label="Price">
                <span class="price-tag">${{ number_format($item->price, 2) }}</span>
            </td>
            <td data-label="Actions">
                <a href="{{ route('admin.order_items.edit', $item->id) }}" class="action-btn edit-btn">
                    <span>💅</span>
                    Edit
                </a>

                <form action="{{ route('admin.order_items.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" 
                            onclick="return confirm('Delete this lovely item? 💭')">
                        <span>🗑️</span>
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="empty-state" data-label="No Data">
                <span class="empty-icon">🛍️</span>
                <div>No order items found</div>
                <small style="color: #d1a3e0;">Add some lovely items to get started! 💕</small>
            </td>
        </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>
</div>
@endsection