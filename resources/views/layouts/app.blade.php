<!DOCTYPE html>
<html>
<head>
    <title>POS System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: -250px;
            background-color: #615EFC;
            padding-left: 15px;
            padding-top: 70px;
            transition: 0.3s;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #D1D8C5;
            color: #615EFC;
        }
        .content {
            margin-left: 20px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .sidebar-open .sidebar {
            left: 0;
        }
        .sidebar-open .content {
            margin-left: 270px;
        }
        .toggle-btn {
            top: 20px;
            left: 15px;
            background-color: #615EFC;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            z-index: 2;
        }
        header {
            background-color: #7E8EF1;
            padding: 10px 15px;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 3;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        header .logo {
            padding-left: 10px;
            font-size: 24px;
            font-weight: bold;
        }
        header img {
            padding-left: 50px;
            height: 80px;
            margin-right: 1px;
           
        }
    </style>
</head>
<body>
    <header>
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <div class="logo">WAHYU MART</div>
        
    </header>

    <div class="sidebar">
        <a href="{{ route('products.index') }}"><i class="fas fa-box"></i> Products</a>
        <a href="{{ route('sales.index') }}"><i class="fas fa-shopping-cart"></i> Sales</a>
        <a href="{{ route('transaction.index') }}"><i class="fas fa-receipt"></i> Transaction</a>
        <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-open');
        }
    </script>
</body>
</html>
