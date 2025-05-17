<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HugsyWugsy Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background: #fff8f3;
            color: #444;
        }
        .sidebar {
            background: #ffccd5;
            height: 100vh;
            padding: 2rem 1rem;
            border-right: 4px dashed #f8a5c2;
        }
        .sidebar h4 {
            font-weight: bold;
            color: #a83265;
        }
        .sidebar a {
            color: #a83265;
            display: block;
            margin: 0.8rem 0;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            background: #ffe2ec;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background: #f8a5c2;
            color: white;
        }
        .content-box {
            background: #ffffff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(248, 165, 194, 0.2);
        }
        .btn-hugsy {
            background-color: #f8a5c2;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 30px;
            padding: 10px 20px;
        }
        .btn-hugsy:hover {
            background-color: #e78aa9;
        }
        .table thead {
            background: #ffe2ec;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h4>HugsyWugsy 💖</h4>
            <a href="{{ route('users.index') }}">Manage Users</a>
            <a href="{{ route('admin.orders.index') }}">Manage Orders</a>
            <a href="{{ route('admin.admin_roles.index') }}">Admin Roles</a>
            <a href="{{ route('admin.messages.index') }}">Messages</a>
            <a href="{{ route('admin.gift_cards.index') }}">Gift Cards</a>
            <a href="{{ route('admin.certificates.index') }}">Certificates</a>
            <a href="#">Settings</a>
        </div>
        <div class="col-md-10 py-4">
            <div class="content-box">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>
