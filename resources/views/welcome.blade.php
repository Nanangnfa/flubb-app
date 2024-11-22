<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta')

    <title>Flub | Influencer Marketing</title>
    
    @include('includes.style')  
    <style>
        .container {
            gap: 20px; /* Jarak antar elemen di layar besar */
        }

        @media (max-width: 576px) {
            .container {
                gap: 15px; /* Jarak antar elemen di layar kecil */
            }

            .btn {
                width: 100%; /* Tombol memenuhi lebar layar */
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="text-center mb-3">
            <img src="{{ asset('images/flub.png') }}" alt="Gambar" class="mb-3" style="max-width: 200px;">
            <h3>Selamat Datang!</h3>
        </div>

        <button class="btn btn-primary w-50" onclick="location.href='/influencer/login'">Pilih User Influencer</button>
        <button class="btn btn-primary w-50" onclick="location.href='/business/login'">Pilih User Business</button>
    </div>
</body>
</html>
