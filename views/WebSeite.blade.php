

@extends('Werbeseite')


@section('header&nav')

    <div class="container">
        <div class="row">
            <div ID="logo" class="col-sm-1" >
                <h3 style="margin-bottom: 10px"> E - Mensa logo</h3>
            </div>
            <div  class = "col-sm-7">
                <ul id="navbarhead" >

                    <li class="nav"> <a href="">Ankündigung </a></li>
                    <li class="nav"><a href=" #speisen"> speisen </a></li>
                    <li class="nav"><a href=" #zahlen">Zahlen </a></li>
                    <li class="nav"> <a href="#kontakt"> Kontakt </a></li>
                    <li class="nav"> <a href=" #wichtig"> Wichtig für uns</a></li>

                </ul>
            </div>
            <div class = "col-sm-4">
                <ul id="navbarhead" >

                    <li class="nav" style="color: black"> Welcome {{$benutzerTyp}} </li>
                    <li class="nav">
                        @if(isset($status))
                            <a href="/abmeldungController?logout"> logout </a></li>
                    @else
                        <a href="/anmeldungController?logout"> login </a></li>
                    @endif

                </ul>

            </div>
        </div>
    </div>

    </div>


@endsection


@section('main')
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">

    <div class="container">
        <div class="row">
            <div class = "col-sm-2"></div>
            <div class = "col-sm-9">

                <img src="img/schnitzel.jpg" width="100%" height="300">

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class = "col-sm-2"></div>
            <div class = "col-sm-9">
                <h3 id="speisen"> Bald gibt es Eseen auch Online ;)</h3>
                <p class="paragraph">Wo lattenzaun aneinander mu erhaltenen vorpfeifen grasgarten. Raschen als her achtete gedacht.
                    Ungerechte freundlich messingnen am da. Em gearbeitet vergnugter um aufmerksam langweilig ja eigentlich.
                    Wo lattenzaun aneinander mu erhaltenen vorpfeifen grasgarten. Raschen als her achtete gedacht.
                    Ungerechte freundlich messingnen am da. Em gearbeitet vergnugter um aufmerksam langweilig ja eigentlich.
                    En gebogen regnete es es niemand dunkeln ja samstag unrecht.Dank und ganz hol neu also chen. Verlie kleide in sa lieber.

                </p>


            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class = "col-sm-2"></div>
            <div class = "col-sm-9">


                <table border="2" style="width: 100%;" >
                    <caption>Köstlichkeiten,die Sie erwarten</caption>

                    <tr>
                        <th colspan="4" ></th>
                        <th>Preis intern</th>
                        <th>Preis extern</th>
                        <th>Allergen code</th>
                        <th> Bewertung </th>
                    </tr>

                    @foreach($dbgerichte as $gericht)
                        <td>
                        <td colspan="3" style="height: 50px;"> {!! $gericht->name !!} </td>
                        <td style=" height:50px; text-align:center" > {{$gericht->preis_intern}}</td>
                        <td style= " height: 50px; text-align: center" > {{$gericht->preis_extern}} </td>
                        <td style= " height: 50px; text-align: center" >
                            @foreach($dbAllergen as $allergen)
                                @if($gericht->name== $allergen['name'])
                                    {{$allergen['code']}}
                                @endif
                            @endforeach
                        </td>

                        @if(isset($status))
                            <td>  <a href="/bewertung?gerichtid={{$gericht->id}}"> &nbsp zur Bewertung </a></td>
                        @else
                            <td> &nbspBitte anmelden </a></td>
                            @endif
                            </tr>
                            <tr>
                                @if(isset($gericht->bildname))
                                    <td colspan="10"><img src="img/{{ $gericht->id.$gericht->bildname }}.jpg" width="100%" height="300"></td>
                                @else
                                    <td colspan="10"><img src="img/00_image_missing.jpg" width="100%" height="300"></td>
                                @endif
                            </tr>
                            @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-2" ></div>
            <div class="col-sm-9" >
                <ul>
                    @foreach($Allergen as $a)
                        <li> {{$a['code'] }} : {!! $a['Allergen_name'] !!}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class = "col-sm-2"></div>
            <div class = "col-sm-9">
                <table border="2" style="width: 100%;" >
                    <caption>Meinungen unserer Gäste</caption>
                    <tr>
                        <th >Gerichte</th>
                        <th >Bemerkungen</th>
                        <th >Bewertungen</th>
                    </tr>

                    @foreach($gaeste_meinungen as $meinung)
                        <tr>
                            <td style=" height:50px; text-align:center" > {{ $meinung['name'] }} </td>
                            <td style=" height:50px; text-align:center"> {{$meinung['bemerkung']}}</td>


                            <td style=" height:50px; text-align:center">
                                @for($i=0;$i<$meinung['SterneBewertung'];$i++)
                                    <span class="fa fa-star checked1"></span>
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                </table>
                <a href="/bewertungen">siehe alle Bewertungen</a>
                @if(isset($status))
                    <br><a href="/meinebewertungen">siehe Ihre Bewertungen</a>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-2" ></div>
            <div class="col-sm-9" >
                <h3 id="zahlen"> E - Mensa in Zahlen</h3>

                <table class="Zahlen">
                    <tr>
                        <th class="Zahlen">{{$besucher." "}}Besuche</th>
                        <th class="Zahlen">{{$anmeldungen}}  hat sich angemeldet</th>
                        <th class="Zahlen">{{$gerichte[0]['anzahl'] . " "}} Speisen</th>
                    </tr>
                </table>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-2"> </div>

                <div class="col-sm-9">
                    <h3 id="kontakt">Interesse geweckt? Wir informieren Sie!</h3>
                </div>
            </div>
        </div>


        <form  class="Anmeldung" method="post" action="/" >

            <div class="container">

                <div class="row">

                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">

                        <label class="formlabel"  >Ihre Name:</label><br>
                        <input class="anmeldung" type="text" name="Vorname" placeholder="Vorname" style="width: 75% " value="@isset($vars['post_vorname']){{ $vars['post_vorname'] }}@endisset"
                        @empty($vars['post_vorname']) {{""}} @endempty>

                    </div>

                    <div class="col-sm-2">
                        <label class="formlabel"  >Ihre E-Mail:</label><br>

                        <input class="anmeldung"  type="text" name="E-Mail" style="width: 75%" value=" @isset($vars['post_emai']){{ $vars['post_email'] }}@endisset
                        @empty($vars['post_email']) {{""}} @endempty">

                    </div>
                    <div class="col-sm-2">

                        <label class="formlabel" >Newsletter bitte in:</label><br>
                        <select   class="anmeldung"  name="Sprache">

                            <option value = "Englisch" @isset($vars['post_sprache'] )
                                @if($vars['post_sprache'] == 'English')  {{'selected'}} @else {{""}} @endif @endisset >Englisch</option>
                            <option value="Deutsch" @isset($vars['post_sprache'])
                                @if($vars['post_sprache'] == 'Deutsch')  {{"selected"}} @else {{""}} @endif @endisset>Deutsch</option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-4">
                        <input type="checkbox" name="Datenschutz" @if($vars['post_schicken'] and $vars['post_datenschutz'])
                            {{"checked"}} @else {{""}}@endif>

                        <label class="formlabel" class="Datenschutz" >Den Datenschutzbeschtimungen stimme ich zu</label>
                    </div>
                    <div class="col-sm-5">
                        <input  class ="schicken" name="schicken" type="submit" value="Zum Newsletter anmelden">

                        <p> {!! $vars['datenschutzErr']!!} </p>
                        <p> {!! $vars['correct'] !!} </p>
                        <p> {!! $vars['nameErr']!!} </p>
                        <p> {!!$vars['emailErr']!!} </p>


                    </div>
                </div>
            </div>
        </form>

        @endsection

        @section('footer')
            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">  </div>
                    <div class="col-sm-3">
                        <p class="foot"> <span>(C)</span> E-Mensa GmbH</p>
                    </div>
                    <div class="col-sm-3">
                        <p class="foot">Anas & Dirar</p>
                    </div>
                    <div class="col-sm-3">
                        <a href="" name="Impressum" style="padding-right: 5px; color: lightseagreen; text-decoration: underline">Impressum </a>
                    </div>

                </div>
            </div>
@endsection