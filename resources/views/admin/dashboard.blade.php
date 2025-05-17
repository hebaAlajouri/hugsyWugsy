<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HugsyWugsy Admin Dashboard</title>
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

        .header {
            background: #ffccd5;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(248, 165, 194, 0.2);
        }

        .header h1 {
            font-size: 2rem;
            color: #a83265;
        }

        .content-box {
            background: #ffffff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(248, 165, 194, 0.2);
        }

        .stat-box {
            background: #ffe2ec;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(248, 165, 194, 0.3);
        }

        .stat-box h4 {
            color: #a83265;
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

        .footer {
            background: #ffccd5;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4>HugsyWugsy 💖</h4>
            <a href="{{ route('admin.users.index') }}">Manage Users</a>
            <a href="{{ route('admin.orders.index') }}">Manage Orders</a>
            <a href="{{ route('admin.admin_roles.index') }}">Admin Roles</a>
            <a href="{{ route('admin.messages.index') }}">Messages</a>
            <a href="{{ route('admin.gift_cards.index') }}">Gift Cards</a>
            <a href="{{ route('admin.certificates.index') }}">Certificates</a>
            <a href="#">Settings</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 py-4">
            <div class="content-box">
                <!-- Header Section -->
                <div class="header">
                    <h1>Welcome to HugsyWugsy Admin Panel</h1>
                    <p>Manage your adorable teddy bear business with ease!</p>
                </div>

                <!-- Stats Section -->
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="stat-box">
                            <h4>Total Orders</h4>
                            <p>124</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="stat-box">
                            <h4>Active Users</h4>
                            <p>56</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="stat-box">
                            <h4>Messages</h4>
                            <p>10</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <h4>Recent Activities</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>New order placed (Order ID: 124)</td>
                            <td>2025-04-30</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New user registered (User ID: 56)</td>
                            <td>2025-04-29</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <a href="{{ route('admin.orders.create') }}" class="btn-hugsy">Add New Order</a>
                    <a href="{{ route('users.create') }}" class="btn-hugsy">Add New User</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<div class="footer">
    <p>Powered by HugsyWugsy</p>
</div>
</body>
</html>
