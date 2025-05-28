@extends('layouts.admin')

@section('content')
<style>
    .girly-container {
        background: linear-gradient(135deg, #ffeef8 0%, #fff5f9 50%, #fef7ff 100%);
        min-height: 100vh;
        padding: 2rem 1rem;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    .girly-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .girly-title {
        color: #be185d;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
        position: relative;
        display: inline-block;
    }
    
    .girly-title::after {
        content: '✨';
        position: absolute;
        top: -10px;
        right: -30px;
        font-size: 1.5rem;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    .girly-subtitle {
        color: #ec4899;
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 2rem;
    }
    
    .btn-hugsy {
        background: linear-gradient(135deg, #ec4899 0%, #f472b6 50%, #be185d 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 16px;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 0.025em;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .btn-hugsy:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(236, 72, 153, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-hugsy::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-hugsy:hover::before {
        left: 100%;
    }
    
    .girly-table-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 70px rgba(236, 72, 153, 0.1);
        border: 1px solid rgba(244, 114, 182, 0.1);
        position: relative;
        width: 100%;
    }
    
    .girly-table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ec4899, #f472b6, #f9a8d4, #fce7f3);
    }
    
    .girly-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        font-weight: 500;
        table-layout: fixed;
    }
    
    .girly-table thead {
        background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
    }
    
    .girly-table th {
        padding: 1rem 0.75rem;
        text-align: left;
        font-weight: 700;
        color: #831843;
        font-size: 0.85rem;
        letter-spacing: 0.025em;
        border: none;
        position: relative;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .girly-table th:nth-child(1) { width: 18%; } /* Name */
    .girly-table th:nth-child(2) { width: 25%; } /* Description */
    .girly-table th:nth-child(3) { width: 12%; } /* Price */
    .girly-table th:nth-child(4) { width: 15%; } /* Category */
    .girly-table th:nth-child(5) { width: 12%; } /* Customizable */
    .girly-table th:nth-child(6) { width: 18%; } /* Actions */
    
    .girly-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(244, 114, 182, 0.1);
    }
    
    .girly-table tbody tr:hover {
        background: rgba(253, 242, 248, 0.7);
        transform: scale(1.005);
    }
    
    .girly-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .girly-table td {
        padding: 1rem 0.75rem;
        color: #831843;
        border: none;
        vertical-align: middle;
        font-size: 0.85rem;
        line-height: 1.4;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .product-name {
        font-weight: 700;
        color: #be185d;
        font-size: 0.9rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }
    
    .product-description {
        color: #9f1239;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        font-size: 0.8rem;
        line-height: 1.3;
    }
    
    .product-price {
        font-weight: 700;
        color: #059669;
        font-size: 1rem;
        white-space: nowrap;
    }
    
    .product-category {
        background: linear-gradient(135deg, #f9a8d4, #f472b6);
        color: white;
        padding: 0.3rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }
    
    .customizable-badge {
        padding: 0.3rem 0.6rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
        display: inline-block;
    }
    
    .customizable-yes {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .customizable-no {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.3rem;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        color: white;
        padding: 0.4rem 0.6rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        white-space: nowrap;
    }
    
    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border: none;
        color: white;
        padding: 0.4rem 0.6rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        white-space: nowrap;
    }
    
    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    
    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }
    
    .floating-heart {
        position: absolute;
        color: #f9a8d4;
        font-size: 1.2rem;
        animation: float 12s ease-in-out infinite;
        opacity: 0.2;
    }
    
    .floating-heart:nth-child(1) { left: 5%; top: 20%; animation-delay: 0s; }
    .floating-heart:nth-child(2) { left: 95%; top: 30%; animation-delay: 3s; }
    .floating-heart:nth-child(3) { left: 10%; top: 70%; animation-delay: 6s; }
    .floating-heart:nth-child(4) { left: 90%; top: 80%; animation-delay: 9s; }
    
    @keyframes sparkle {
        0%, 100% { transform: rotate(0deg) scale(1); opacity: 0.7; }
        50% { transform: rotate(15deg) scale(1.3); opacity: 1; }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.2; }
        25% { transform: translateY(-10px) rotate(5deg); opacity: 0.4; }
        50% { transform: translateY(-5px) rotate(-5deg); opacity: 0.3; }
        75% { transform: translateY(-15px) rotate(3deg); opacity: 0.4; }
    }
    
    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #ec4899;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.6;
    }
    
    .empty-state-text {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .empty-state-subtext {
        color: #f472b6;
        font-size: 1rem;
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .girly-container {
            padding: 1rem 0.5rem;
        }
        
        .girly-title {
            font-size: 1.8rem;
        }
        
        .girly-table th, .girly-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .girly-table th:nth-child(1) { width: 16%; } /* Name */
        .girly-table th:nth-child(2) { width: 28%; } /* Description */
        .girly-table th:nth-child(3) { width: 10%; } /* Price */
        .girly-table th:nth-child(4) { width: 14%; } /* Category */
        .girly-table th:nth-child(5) { width: 10%; } /* Customizable */
        .girly-table th:nth-child(6) { width: 22%; } /* Actions */
        
        .action-buttons {
            flex-direction: column;
            gap: 0.2rem;
            align-items: stretch;
        }
        
        .btn-edit, .btn-delete {
            font-size: 0.65rem;
            padding: 0.3rem 0.4rem;
        }
        
        .product-category, .customizable-badge {
            font-size: 0.65rem;
            padding: 0.2rem 0.4rem;
        }
    }
    
    @media (max-width: 480px) {
        .girly-table th, .girly-table td {
            padding: 0.5rem 0.3rem;
            font-size: 0.7rem;
        }
        
        .girly-table th:nth-child(2) { width: 30%; } /* Give more space to description */
        .girly-table th:nth-child(6) { width: 24%; } /* More space for actions */
    }
</style>

<div class="girly-container">
    <div class="floating-elements">
        <div class="floating-heart">💖</div>
        <div class="floating-heart">💕</div>
        <div class="floating-heart">💗</div>
        <div class="floating-heart">🌸</div>
    </div>
    
    <div class="girly-header">
        <h2 class="girly-title">Products</h2>
        <p class="girly-subtitle">Manage your beautiful product collection</p>
        <a href="{{ route('admin.products.create') }}" class="btn btn-hugsy">
            ✨ Add New Product
        </a>
    </div>
    
    <div class="girly-table-container">
        @if($products->count() > 0)
            <table class="girly-table">
                <thead>
                    <tr>
                        <th>🌸 Name</th>
                        <th>💭 Description</th>
                        <th>💎 Price</th>
                        <th>🏷️ Category</th>
                        <th>✨ Customizable</th>
                        <th>⚡ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><span class="product-name">{{ $product->name }}</span></td>
                            <td><span class="product-description" title="{{ $product->description }}">{{ $product->description }}</span></td>
                            <td><span class="product-price">${{ $product->price }}</span></td>
                            <td><span class="product-category">{{ $product->category }}</span></td>
                            <td>
                                <span class="customizable-badge {{ $product->is_customizable ? 'customizable-yes' : 'customizable-no' }}">
                                    {{ $product->is_customizable ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block; margin: 0;">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this beautiful product? 💕')">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🛍️</div>
                <div class="empty-state-text">No products yet!</div>
                <div class="empty-state-subtext">Create your first beautiful product to get started</div>
            </div>
        @endif
    </div>
</div>
@endsection