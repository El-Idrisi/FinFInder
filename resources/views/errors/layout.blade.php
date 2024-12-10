<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Error') - FinFinder</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Waves Effect */
        .waves {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background-color: transparent;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 100%;
            animation: wave 8s linear infinite;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 88.7'%3E%3Cpath d='M800 56.9c-155.5 0-204.9-50-405.5-49.9-200 0-250 49.9-394.5 49.9v31.8h800v-.2-31.6z' fill='%23e0f2fe'/%3E%3C/svg%3E");
            background-size: 50% 100%;
            bottom: -20px;
        }

        .wave.wave1 {
            animation: wave 30s linear infinite;
            opacity: 0.3;
            z-index: 1;
        }

        .wave.wave2 {
            animation: wave 15s linear infinite;
            opacity: 0.5;
            z-index: 2;
        }

        .wave.wave3 {
            animation: wave 10s linear infinite;
            opacity: 0.7;
            z-index: 3;
        }

        @keyframes wave {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .error-content {
            text-align: center;
            max-width: 600px;
            width: 100%;
            padding: 40px 20px;
            position: relative;
            z-index: 10;
        }

        .error-code {
            font-size: 140px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #0284c7 0%, #bae6fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: glitch 2s infinite;
        }

        .error-code::before,
        .error-code::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0284c7 0%, #bae6fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .error-code::before {
            animation: glitch-top 2s infinite linear alternate-reverse;
            clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
        }

        .error-code::after {
            animation: glitch-bottom 3s infinite linear alternate-reverse;
            clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
            -webkit-clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
        }

        .error-message {
            font-size: 28px;
            margin-bottom: 30px;
            color: #0284c7;
            font-weight: 600;
        }

        .error-description {
            font-size: 18px;
            margin-bottom: 40px;
            color: #64748b;
            line-height: 1.6;
        }

        .home-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #0284c7;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .home-button:hover {
            background: #0369a1;
            transform: translateY(-4px);
        }

        .home-button svg {
            width: 20px;
            height: 20px;
        }

        /* Fish Animation */
        .fish {
            position: absolute;
            z-index: 1;
        }

        .fish svg {
            fill: rgba(59, 130, 246, 0.2);
            width: 100%;
            height: 100%;
        }

        .fish-1 {
            width: 60px;
            top: 20%;
            animation: swimLeft 15s linear infinite;
        }

        .fish-2 {
            width: 40px;
            top: 60%;
            animation: swimRight 20s linear infinite;
        }

        /* Bubbles Animation */
        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            top: 0;
            left: 0;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            border-radius: 50%;
            opacity: 0.5;
            animation: rise 10s infinite ease-in;
            background: rgba(2, 132, 199, 0.1);
            /* Warna bubble sesuai tema biru */
        }

        .bubble:nth-child(1) {
            width: 40px;
            height: 40px;
            left: 10%;
            animation-duration: 8s;
        }

        .bubble:nth-child(2) {
            width: 20px;
            height: 20px;
            left: 20%;
            animation-duration: 5s;
            animation-delay: 1s;
        }

        .bubble:nth-child(3) {
            width: 50px;
            height: 50px;
            left: 35%;
            animation-duration: 7s;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 30px;
            height: 30px;
            left: 50%;
            animation-duration: 11s;
            animation-delay: 0s;
        }

        .bubble:nth-child(5) {
            width: 35px;
            height: 35px;
            left: 65%;
            animation-duration: 6s;
            animation-delay: 3s;
        }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
            }

            50% {
                transform: translate(100px);
            }

            100% {
                bottom: 1080px;
                transform: translateX(-200px);
            }
        }

        @keyframes swimLeft {
            0% {
                transform: translateX(-100px) scaleX(1);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateX(calc(100vw + 100px)) scaleX(1);
                opacity: 0;
            }
        }

        @keyframes swimRight {
            0% {
                transform: translateX(calc(100vw + 100px)) scaleX(-1);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateX(-100px) scaleX(-1);
                opacity: 0;
            }
        }

        @keyframes glitch {
            0% {
                transform: translate(0);
            }

            20% {
                transform: translate(-2px, 2px);
            }

            40% {
                transform: translate(-2px, -2px);
            }

            60% {
                transform: translate(2px, 2px);
            }

            80% {
                transform: translate(2px, -2px);
            }

            100% {
                transform: translate(0);
            }
        }

        @keyframes glitch-top {
            0% {
                transform: translate(0);
            }

            20% {
                transform: translate(2px, -2px);
            }

            40% {
                transform: translate(-2px, 2px);
            }

            60% {
                transform: translate(2px, 2px);
            }

            80% {
                transform: translate(-2px, -2px);
            }

            100% {
                transform: translate(0);
            }
        }

        @keyframes glitch-bottom {
            0% {
                transform: translate(0);
            }

            20% {
                transform: translate(-2px, 2px);
            }

            40% {
                transform: translate(2px, -2px);
            }

            60% {
                transform: translate(-2px, -2px);
            }

            80% {
                transform: translate(2px, 2px);
            }

            100% {
                transform: translate(0);
            }
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 100px;
            }

            .error-message {
                font-size: 24px;
            }

            .error-description {
                font-size: 16px;
            }

            .waves {
                height: 150px;
            }
        }

        @media (max-width: 480px) {
            .error-code {
                font-size: 80px;
            }

            .error-message {
                font-size: 20px;
            }

            .error-description {
                font-size: 14px;
            }

            .home-button {
                padding: 12px 24px;
                font-size: 16px;
            }

            .waves {
                height: 100px;
            }
        }
    </style>
</head>

<body>
    <!-- Waves Background -->
    <div class="waves">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
    </div>

    <!-- Bubbles -->
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <!-- Swimming Fish -->
    <div class="fish fish-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-fish">
            <path d="M6.5 12c.94-3.46 4.94-6 8.5-6 3.56 0 6.06 2.54 7 6-.94 3.47-3.44 6-7 6s-7.56-2.53-8.5-6Z" />
            <path d="M18 12v.5" />
            <path d="M16 17.93a9.77 9.77 0 0 1 0-11.86" />
            <path
                d="M7 10.67C7 8 5.58 5.97 2.73 5.5c-1 1.5-1 5 .23 6.5-1.24 1.5-1.24 5-.23 6.5C5.58 18.03 7 16 7 13.33" />
            <path d="M10.46 7.26C10.2 5.88 9.17 4.24 8 3h5.8a2 2 0 0 1 1.98 1.67l.23 1.4" />
            <path d="m16.01 17.93-.23 1.4A2 2 0 0 1 13.8 21H9.5a5.96 5.96 0 0 0 1.49-3.98" />
        </svg>
    </div>
    <div class="fish fish-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-fish">
            <path d="M6.5 12c.94-3.46 4.94-6 8.5-6 3.56 0 6.06 2.54 7 6-.94 3.47-3.44 6-7 6s-7.56-2.53-8.5-6Z" />
            <path d="M18 12v.5" />
            <path d="M16 17.93a9.77 9.77 0 0 1 0-11.86" />
            <path
                d="M7 10.67C7 8 5.58 5.97 2.73 5.5c-1 1.5-1 5 .23 6.5-1.24 1.5-1.24 5-.23 6.5C5.58 18.03 7 16 7 13.33" />
            <path d="M10.46 7.26C10.2 5.88 9.17 4.24 8 3h5.8a2 2 0 0 1 1.98 1.67l.23 1.4" />
            <path d="m16.01 17.93-.23 1.4A2 2 0 0 1 13.8 21H9.5a5.96 5.96 0 0 0 1.49-3.98" />
        </svg>
    </div>

    <!-- Error Content -->
    <div class="error-content">
        <div class="error-code" data-text="@yield('code')">@yield('code')</div>
        <h1 class="error-message">@yield('message')</h1>
        <p class="error-description">
            Maaf, halaman yang Anda cari tidak dapat ditemukan. Silakan kembali ke halaman utama.
        </p>
        <a href="{{ url('/') }}" class="home-button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path d="M9 22V12h6v10" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</body>

</html>
