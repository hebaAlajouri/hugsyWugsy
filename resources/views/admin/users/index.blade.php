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
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
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
        flex-wrap: wrap;
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
        white-space: nowrap;
    }

    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(196, 69, 105, 0.4);
        color: white;
        text-decoration: none;
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
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, #ffeef8 0%, #f8f4ff 100%);
        color: #6b4c7a;
        font-weight: 600;
        padding: 1rem;
        text-align: center;
        font-size: 1rem;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 1rem;
        text-align: center;
        border-bottom: 1px solid #ffeef8;
        color: #5a4a6b;
        font-weight: 500;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(135deg, #fff0f6 0%, #faf0ff 100%);
        transform: scale(1.01);
    }

    .action-btn {
        padding: 8px 20px;
        border-radius: 20px;
        border: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.3s ease;
        margin: 3px;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .edit-btn {
        background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
        color: white;
    }

    .edit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(116, 185, 255, 0.4);
        color: white;
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

    .role-badge {
        background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(108, 92, 231, 0.3);
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

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    @media (max-width: 992px) {
        .header-title {
            font-size: 2rem;
            text-align: center;
            justify-content: center;
        }

        .header-content {
            flex-direction: column;
            align-items: center;
        }

        .add-btn {
            margin-left: 0;
        }

        .custom-table thead {
            display: none;
        }

        .custom-table tbody td {
            display: block;
            text-align: right;
            position: relative;
            padding-left: 50%;
        }

        .custom-table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
            color: #a58bbd;
            text-align: left;
        }

        .custom-table tbody tr {
            display: block;
            margin-bottom: 1.5rem;
            border: 1px solid #f3e7f7;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(255, 182, 193, 0.1);
        }

        .action-btn {
            width: 100%;
            justify-content: center;
            margin: 5px 0;
        }
    }
</style>

<div class="admin-container">
    {{-- 🌼 Header --}}
    <div class="header-card">
        <div class="header-content">
            <h1 class="header-title">
                <span>🌸</span>
                Lovely Admin Panel – Users List
                <span>💕</span>
            </h1>
            {{-- ➕ Add User Button --}}
            <a href="{{ route('users.create') }}" class="add-btn">
                <span>✨</span>
                Add New User
                <span>💖</span>
            </a>
        </div>
    </div>

    {{-- 📋 Users Table --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>🆔 ID</th>
                        <th>👩‍💼 Name</th>
                        <th>📧 Email</th>
                        <th>🎀 Role</th>
                        <th>🛠️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td data-label="ID">{{ $user->id }}</td>
                            <td data-label="Name">{{ $user->name }}</td>
                            <td data-label="Email">{{ $user->email }}</td>
                            <td data-label="Role">
                                <span class="role-badge">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td data-label="Actions">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn edit-btn">
                                    <span>💅</span>
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" 
                                            onclick="return confirm('Are you sure you want to delete this user? 💭')">
                                        <span>🗑️</span>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <span class="empty-icon">🌸</span>
                                <div>No users found</div>
                                <small style="color: #d1a3e0;">Add some lovely users to get started! 💭</small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
