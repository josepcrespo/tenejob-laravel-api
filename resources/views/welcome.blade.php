<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TeneJob</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .eighty-height {
                height: 80vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .links a {
                color: #636b6f;
                padding: 15px 20px;
                margin: 0 5px;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border-width: 1px;
                border-style: solid;
                border-color: transparent;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
                transition: all 0.5s;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
            }

            .links a:hover {
                border-color: #cccccc;
            }

            footer.links {
                position: fixed;
                bottom: 30px;
            }

            footer.links a {
                padding: 5px 10px;
                font-size: 14px;
                text-transform: none;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref eighty-height">
            <div class="content">
                <div class="title">
                    <img src="data:image/png;base64,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"
                         width="auto"
                         height="auto"
                         alt="TeneJob"
                    />
                </div>

                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            <footer class="links">
                <a href="{{ url('/') }}:1080/" target="_blank">
                    <i class="fas fa-envelope"></i>&nbsp;
                    MailDev
                </a>
                <a href="/api/docs" target="_blank">
                    <i class="fas fa-book"></i>&nbsp;
                    API Documentation
                </a>
                <a href="https://github.com/laravel/laravel" target="_blank">
                    <i class="fas fa-code"></i>&nbsp;
                    Code Repository
                </a>
            </footer>
        </div>
    </body>
</html>