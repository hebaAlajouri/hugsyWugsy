<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Oopsie!</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            color: #ff69b4;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 60px 20px;
        }

        .error-title {
            font-size: 120px;
            font-family: 'Pacifico', cursive;
            margin: 0;
        }

        .message {
            font-size: 24px;
            margin: 10px 0 30px;
            font-weight: 300;
        }

        .teddy {
            width: 180px;
            margin: 20px auto;
        }

        .btn-home {
            background-color: #ffb6c1;
            color: white;
            padding: 12px 28px;
            border: none;
            border-radius: 30px;
            font-size: 18px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(255, 182, 193, 0.5);
            transition: background 0.3s ease;
        }

        .btn-home:hover {
            background-color: #ff69b4;
        }

        .hearts {
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <h1 class="error-title">404</h1>
        <p class="message">Oopsie! Looks like this teddy got lost on the way. 🧸</p>
        <img src="{{ asset('images/teddy-sad.png') }}" alt="Sad Teddy" class="teddy">
        <br>
        <a href="{{ url('/') }}" class="btn-home">Back to HugsyWugsy</a>
    </div>
</body>
</html>
