
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
            <form action="{{ route('submit', $email)}}" method="post">

                @csrf
                @method('POST')

                @if (Session::get('info'))
                    <b style="font-size:20px; color:rgb(19, 231, 157);">
                        {{ Session::get('info') }}
                    </b>
                @endif



                <h1>Définissez vos accès</h1>

                <div class="user">

                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" readonly value="{{ $email }}">

                    <input type="text" name="code" id="code" placeholder="Mettez le code" value="{{ old('code')}}">

                    <i class="fas fa-unlock-alt"></i>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">

                    <i class="fas fa-unlock-alt"></i>
                    <input type="password" name="ConfirmPassword" id="password" placeholder="Confirmez le mot de passe">

                </div>

                    @error('ConfirmPassword')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror

                <div class="login-btn">
                    <button class="btn">Valider</button>
                </div>

            </form>
        </div>
    </div>
</body>


</html>
