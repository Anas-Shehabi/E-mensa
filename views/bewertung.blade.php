
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Bewertung</title>
    <style>


    </style>
</head>
<body>



    <div style="margin-left: 20px">
            <h1 style="margin-top: 20px">Bewertung</h1>

            <h2> {{ $ergebnis['name'] }}</h2>
<div class="res_img">
            @if($ergebnis['bildname'])
                <div><img class="res_img" src="img/{{ $ergebnis['id'].$ergebnis['bildname'] }}.jpg" width="500" height="250"></div>
            @else
                <div><img class="res_img" src="img/00_image_missing.jpg" width="500" height="250"></div>
            @endif
            <br><br>
</div>

                <form method="post" action="/bewertungController?gerichtid={{$ergebnis['id']}}">

                    <input  type="hidden" name = "gerichtid" value="<?php $_GET['gerichtid'] ?>">
                    <label class="mr-sm-2" for="bemerkung">Bemerkung:</label>
                    <textarea class="mr-sm-2" type="text" id="bemerkung" name="bemerkung"></textarea>

                    <span>&nbsp;&nbsp;</span>

                    <label  class="mr-sm-2" for="inlineFormCustomSelec">Bewertung:</label>
                    <select style="width: 80px;"  class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="sterne_bewertung">
                    <option value="4">Sehr gut</option>
                    <option value="3">gut</option>
                    <option value="2">schlecht</option>
                    <option value="1">sehr schlecht</option>
                </select>

                    <br><br>

                    <input type="submit" name="bewerten" value="bewerten">

                </form>


</div>

</body>
</html>
