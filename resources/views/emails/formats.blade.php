<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <p>Bonjour ! Comment allez-vous ?</p>
        <p>{{ $admin }} vous a crée un compte un compte sur son application.</p>
        <p>
            Vous pouvez réinitialiser votre mot de passe pour vous connecter en cliquant sur ce lien :
            {{-- <a href="http://127.0.0.1:5500/admin/choose-pass-user/{{ $id }}/edit?email={{ $email }}">Lien de réinitialiser</a> --}}

            <a href="http://127.0.0.1:5500/forgot-password">Lien de réinitialiser</a>
        </p>
        <p><a href="http://127.0.0.1:5500/login">Lien de connexion</a></p>
    </div>
</body>

</html>
