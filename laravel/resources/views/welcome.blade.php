<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script source="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
         
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

        <title>Projet Rapide</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            
            html, body {

                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 300;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                height : 15%;
                justify-content: center;
                background: rgba(96, 125, 139, 0.3);
                    
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                font-family: Trebuchet MS, sans-serif;
                margin-top: 20%;
                margin-bottom: 30px;
                color : white;
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            }
            body,
            html {
                height: 100%
            }

            #particles-js canvas {
                display: block;
                vertical-align: bottom;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
                opacity: 1;
                -webkit-transition: opacity .8s ease, -webkit-transform 1.4s ease;
                transition: opacity .8s ease, transform 1.4s ease
            }

            #particles-js {
                background: #424242;
                width: 100%;
                height: 100%;
                position: fixed;
                z-index: -10;
                top: 0;
                left: 0
            }
            .links > a {
                color: #FFF;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            }
        </style>
    </head>
    <body>

        

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <a href="{{ url('adminForm') }}">Login Gestionnaire</a>
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
            
            
             

            
            <div id="particles-js"></div>
            <script src="{{ asset('js/particles.js') }}"></script>
            <script src="{{ asset('js/background/app.js') }}"></script>
       
            <script>
                particlesJS.load('particles-js', '/particles.json', function(){
                    console.log('particles.json loaded...');
                });
            </script>
        </div>
        <div class="content">
                <div class="title m-b-md">
                    Projet Rapide
                </div>

            </div>
    </body>
</html>
