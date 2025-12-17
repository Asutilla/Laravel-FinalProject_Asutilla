<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartStock - Login Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a202c;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(30, 41, 59, 0.5) 0%, rgba(26, 32, 44, 1) 70%);
            z-index: -1;
        }

        .container {
            padding: 50px;
            max-width: 650px;
            width: 90%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(30, 41, 59, 0.7);
            border-radius: 20px;
            border: 1px solid rgba(47, 62, 85, 0.5);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        .logo {
            font-size: 54px;
            font-weight: 900;
            margin-bottom: 5px;
            color: white;
            letter-spacing: -1px;
        }

        .logo span {
            color: #2563eb;
        }

        .tagline {
            font-size: 20px;
            color: #94a3b8;
            margin-bottom: 10px;
            font-weight: 400;
        }

        .description {
            font-size: 15px;
            color: #94a3b8;
            margin-bottom: 50px;
            max-width: 500px;
            line-height: 1.6;
        }

        .main-button {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 16px 45px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;

            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4);
            transition: all 0.3s ease;
        }

        .main-button:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.6);
        }

        .footer-links {
            margin-top: 40px;
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #94a3b8;
        }

        .footer-links p {
            margin: 0;
        }

        .footer-links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #60a5fa;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="logo">Smart<span style="font-weight: 300;">Stock</span></div>
        <div class="tagline">Enterprise-Grade Inventory Command Center</div>

        <p class="description">
            Your centralized platform for real-time inventory tracking, supply chain oversight, and performance analytics. Please sign in to manage and monitor your product catalog.
        </p>

        @if (Route::has('login'))
        <a href="{{ route('login') }}" class="main-button">
            Access Management Portal
        </a>
        @endif

        <div class="footer-links">
            <p>&copy; 2025 SmartStock</p>
            @if (Route::has('register'))
            <a href="{{ route('register') }}">Create New Account</a>
            @endif
        </div>

    </div>

</body>

</html>