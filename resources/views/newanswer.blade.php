<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Je hebt een nieuw antwoord op je bericht van admin: {{$admin}}</h2>
    <p>Jouw vraag: <b>{{$currentTicket->title}} - {{$currentTicket->question}}</b></p>
    <p><b>{{$admin}}</b>: {{$messageUser}}</p>
    <br>

<a href="27.0.0.1:8000/chatAdmin/{{$currentTicket->id}}">Ga hier naar de chat</a>

</body>
</html>