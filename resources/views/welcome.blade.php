<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('icon/favicon.svg') }}" type='image/x-icon'>

        <title>OraganizeNote</title>

        <!-- Styles -->
        <style>
            html,
            body {
                background-color: #fff;
                color: #222;
                font-weight: 400;
                height: 100vh;
                margin-left: 8px;
                margin-right: 8px;

                font-family: -apple-system,
                    BlinkMacSystemFont,
                    Helvetica Neue,
                    Segoe UI, Hiragino Kaku Gothic ProN,
                    Hiragino Sans,
                    ヒラギノ角ゴ ProNW3,
                    Arial,
                    メイリオ,
                    Meiryo,
                    sans-serif;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links>a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

        </style>
    </head>

    <body>
        <div class="flex-center position-ref full-height">

            <div class="top-right links">
                @guest
                <a href="{{ route('login') }}">Login</a>

                <a href="{{ route('register') }}">Register</a>
                @endguest
            </div>

            <div class="content">
                <div class="title m-b-md">
                    OraganizeNote
                </div>
            </div>
        </div>
    </body>

</html>