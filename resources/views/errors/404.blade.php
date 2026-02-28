<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found | B2F Official</title>
    <link rel="icon" href="{{ asset('bootstrap/bootstrap-b2f-landing/assets/img/logo_b2f.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a;
            color: #ffffff;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-align: center;
        }
        .wrapper {
            max-width: 500px;
            padding: 20px;
        }
        .code {
            font-size: 8rem;
            font-weight: 700;
            color: #feb801;
            margin: 0;
            letter-spacing: -5px;
            line-height: 1;
        }
        .title {
            font-size: 1.2rem;
            font-weight: 400;
            color: #94a3b8; /* Warna abu-abu soft */
            margin: 20px 0 40px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .btn-back {
            display: inline-block;
            border: 1px solid #feb801;
            color: #feb801;
            padding: 12px 40px;
            border-radius: 50px; /* Capsule style lebih minimalis */
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: #feb801;
            color: #0f172a;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="code">404</h1>
        <div class="title">Halaman Tidak Ditemukan</div>
        <a href="{{ url()->previous() }}" class="btn-back">KEMBALI</a>
    </div>
</body>
</html>