
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
    <title>Tp Salaire</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <form action="{{ route('handleLogin')}}" method="post">

                @csrf
                @method('POST')

            <h1>Espace de connexion</h1>

                <div class="msg">
                    @if(Session::get('info'))
                        {{ Session::get('info') }}
                    @endif
                </div>


            <div class="user">

                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Addresse email">

                <i class="fas fa-unlock-alt"></i>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                {{-- <i class="fas fa-unlock-alt"></i>
                <input type="password" name="password" id="password" placeholder="Confirmez le mot de passe"> --}}
            </div>
            <div class="login-btn">
                <button class="btn">Connexion</button>
            </div>
            </form>
        </div>
    </div>
</body>


</html>
