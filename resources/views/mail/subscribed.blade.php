<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);
        body {
            background-color: #D32F2F;
            font-family: 'Calibri', sans-serif !important
        }

        .mt-100 {
            margin-top: 100px
        }

        .container {
            margin-top: 200px
        }

        .card {
            position: relative;
            display: flex;
            width: 450px;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #d2d2dc;
            border-radius: 4px;
            -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
            box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
        }

        .card .card-body {
            padding: 1rem 1rem
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.25rem
        }

        p {
            font-size: 14px
        }

        h4 {
            margin-top: 18px
        }

        .cross {
            padding: 10px;
            color: #d6312d;
            cursor: pointer
        }

        .continue:focus {
            outline: none
        }

        .continue {
            border-radius: 5px;
            text-transform: capitalize;
            font-size: 13px;
            padding: 8px 19px; 
            cursor: pointer;
            color: #fff;
            background-color: #D50000
        }

        .continue:hover {
            background-color: #D32F2F !important
        }
    </style>
</head>
<body>
    <div class="row d-flex justify-content-center align-items-center rows">
        <div class="col-md-6">
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="card text-center">
                        <div class="text-right cross"> <i class="fa fa-times"></i> </div>
                        <div class="card-body text-center"> <img src="https://i.imgur.com/zQZOY6Q.png" width="200px">
                            <h4>Selamat!</h4>
                            <p>Anda sudah terdaftar menjadi subscriber newsletter kami!</p>
                            <h5>- Masakin Team (Kelompok 7 PBKK B)</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>