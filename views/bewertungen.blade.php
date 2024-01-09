
<html>
<header>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Bewertungen</title>
</header>

<body>
<div class="container">
    <div class="row">

        <div class = "col-sm-12">
            <table class="table" border="2" style=" width: 100%";>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Gerichte</th>
                    <th scope="col">Bemerkungen</th>
                    <th scope="col">Bewertungen</th>
                    <th scope="col">Bewertungszeitpunkt</th>
                    <th scope="col">Löschen</th>
                    @if($status == 'admin')
                        <th scope="col">hervorgehoben</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<$count;$i++)
                    <tr>
                        <td>{{$ergebnis[$i]['name']}}</td>
                        <td>{{$ergebnis[$i]['bemerkung']}}</td>
                        <td style="text-align: center">
                            @for($j=0;$j<$ergebnis[$i]['SterneBewertung'];$j++)
                                <span class="fa fa-star checked1"></span>
                            @endfor
                        </td>
                        <td style="text-align: center">{{$ergebnis[$i]['Bewertungszeitpunkt']}}</td>
                        @if($benutzer_id == $ergebnis[$i]['Benutzerid'])
                            <td><a href="/loeschen?bewertungid={{$ergebnis[$i]['Bewertungid']}}" > delete </a>
                        @else <td> ----- </td>
                        @endif
                        @if($status == 'admin')
                            @if($ergebnis[$i]['hervorgehoben'] == 1)
                                <td><a href="/hervorhebungabwaehlen?bewertungid={{$ergebnis[$i]['Bewertungid']}}"> &nbspHervorhebung abwählen </a></td>
                            @else
                                <td><a href="/hervorheben?bewertungid={{$ergebnis[$i]['Bewertungid']}}"> &nbspHervorheben </a></td>
                            @endif
                        @endif
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
