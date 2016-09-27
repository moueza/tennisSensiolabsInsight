<?php

require_once('config.php');
require_once('tennisOVS2016config.php');
require_once('TennisOVSClasseTemps.php');

//fffffffffffffffffffffffffffffffffff
function trouveIdFromPseudo($pseudo) {
// select id from tennisOVS2016 where nomOVS = $pseudo
    $GLOBALS['query'] = "select id from tennisOVS2016 where nomOVS = '" . $pseudo . "';";

    $result = [];
    echoDeb("<BR>lbl825 query=" . $GLOBALS['query']);
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        /* 	echo 'lbl27'; */
    } else {
        /* 	echo 'lbl29'; */
    }
    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        // echo 'lbl1035';
        //i de poub.php


        $num = mysqli_num_rows($result);


        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            $pseudo = $i["id"];
            // echo 'lbl1044 pseudo='. $pseudo;

            $i++;
        }
    } else {
        echoDeb('lbl1057');
    }
    return $pseudo; //car que 1elt
}

//fffffffffffffffffffffffffffffffffffffffffff
/** get 8 inscrits
  out : vector des noms */
function setVectorFromBDD() {
    require_once('config.php');
    $GLOBALS['query'] = " select  nomOVS   from  `tennisOVS2016`;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!


    $result = [];
    //  echo '<BR>lbl925';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //  echo 'lbl27';
    } else {
        echo 'lbl29';
    }


    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        $num = mysqli_num_rows($result);
        $vectorNames = [];
        $vectorNames2 = [];
        $l = 0;
        $cpt = 0;
        while ($l = mysqli_fetch_assoc($result)) {
            //	$nomOVS2 = $l["nam2"];
            //	$vectorNames[$l]=     $l[$l];

            $nomOVSS = $l["nomOVS"];
            $vectorNames2[$cpt] = $nomOVSS;
            // echo '<BR>nomOVS='.    $nomOVSS;
            //   echo '<BR>$vectorNames2[cpt]='.$vectorNames2[$cpt];
            // echo '<BR>$l='.$l.'  cpt='.$cpt;//TODO cpt est + fiable que l
            // echo '<BR>l[]='.$l[l];
            //	echo '<BR>948 vectorNames[l]='. $vectorNames[cpt];
            // echo   "jourSov=".$jourSov;
            // echo '<BR>949';
            $cpt++;
            $l++;
        }//fin while
    } else {
        echo '<BR>lbl78';
    }//endif
//	 array_pop($vectorNames2);//car sinon ca rajoute un dernier element vide a la fin
    return $vectorNames2;
}

//end function
//fffffffffffffffffffffffffffffffffffffffff
function setVectorFromBDDtyped($idTypeProposed) {
    echoDeb("lbl015454 fun.setVect..() ");
    require_once('config.php');

    switch ($idTypeProposed) {
        case "nom":
            $GLOBALS['query'] = " select  nomOVS   from  `tennisOVS2016`;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!
        case "mail":
            $GLOBALS['query'] = " select  `mail`   from  `tennisOVS2Le20160919` where secret is null;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!




        default:
            echoDeb('lbl261054 not filtered');
    }

    $result = [];
    echoDeb('<BR>lbl800925');
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        echoDeb('lbl800927');
    } else {
        echoDeb('lbl800929');
    }


    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        $num = mysqli_num_rows($result);
        $vectorNames = [];
        $vectorNames2 = [];
        $l = 0;
        $cpt = 0;
        while ($l = mysqli_fetch_assoc($result)) {
            //	$nomOVS2 = $l["nam2"];
            //	$vectorNames[$l]=     $l[$l];

            switch ($idTypeProposed) {
                case "nom":
                    $nomOVSS = $l["nomOVS"];
                    $vectorNames2[$cpt] = $nomOVSS;
                    break;
                case "mail":
                    $nomOVSS = $l["mail"];
                    $vectorNames2[$cpt] = $nomOVSS;
                    echoDeb('<BR>lbl488772 mail1=' . $vectorNames2[$cpt]);
                    break;
                default:
            }
            // echo '<BR>nomOVS='.    $nomOVSS;
            //   echo '<BR>$vectorNames2[cpt]='.$vectorNames2[$cpt];
            // echo '<BR>$l='.$l.'  cpt='.$cpt;//TODO cpt est + fiable que l
            // echo '<BR>l[]='.$l[l];
            //	echo '<BR>948 vectorNames[l]='. $vectorNames[cpt];
            // echo   "jourSov=".$jourSov;
            // echo '<BR>949';
            $cpt++;
            $l++;
        }//fin while
    } else {
        echo '<BR>lbl78';
    }//endif
//	 array_pop($vectorNames2);//car sinon ca rajoute un dernier element vide a la fin
    return $vectorNames2;
}

//fffffffffffffffffffffffffffffffffffffffff
/** set inputs from $namesVector */
function proposeNomsOVSinscri($namesVector) {
    $m; //declaration
    for ($m = 0; $m < sizeof($namesVector); $m++) {
        echo '<input type="radio" name="ovesien1" value="' . $namesVector[$m] . '">' . $namesVector[$m] . '<br>';
    }
}

function proposeMAILOVSinscriT2($namesVector, $nomsChampInput) {
    $m; //declaration
    for ($m = 0; $m < sizeof($namesVector); $m++) {
        echo '<input type="radio" name="' . $nomsChampInput . '" value="' . $namesVector[$m] . '">' . $namesVector[$m] . '<br>';
    }
}

//fffffffffffffffffffffffffffffffffffffffff
function proposeMAILOVSinscriT2dropdown($namesVector, $nomsChampInput) {
    $m; //declaration
    for ($m = 0; $m < sizeof($namesVector); $m++) {
        // echo '<input type="radio" name="' . $nomsChampInput . '" value="' . $namesVector[$m] . '">' . $namesVector[$m] . '<br>';
        echo ' <option value="' . $namesVector[$m] . '">' . $namesVector[$m] . '</option>';
    }
    //  echoDeb3('lbl10006651 length='. sizeof($namesVector)  );
//echo '<BR>lbl10006651 length='. sizeof($namesVector)  ;
   // echoDeb3(' option value size="'  . sizeof($namesVector) ;//ne pas mettre ici car entouré d un select
}

//fffffffffffffffffffffffffffffffffffffffff





function createMatchSimple($idTypeProposed) {
    /* nom ou mail */
//TODO


    echo '	<P>Enregistrement des matchs Simples</P>';
    echoDeb('<BR>lbl24677 adminFunctions');
    echo '<form  action="tennisOVS2016admin2.php"  method="post">';





    //  $noms = setVectorFromBDD();
    $noms = setVectorFromBDDtyped($idTypeProposed);
    echo '<DIV id="createSimple">'; //TODO enlever tout affichage pr des functions
    echoDeb('<BR>lbl504448 sizeof($noms)=' . sizeof($noms));

    switch ($idTypeProposed) {
        case "nom":
            echoDeb('lbl56673 nom');
            echo ' <input type="hidden" value="1" name="typeOfTournoiNo" >';
            proposeNomsOVSinscri($noms);
            proposeNomsOVSinscri($noms);



            break;
        case "mail":
            echoDeb('<BR>lbl56677 mail');
            echo ' <input type="hidden" value="2" name="typeOfTournoiNo"  >';
            echo '<BR>Joueur1:<BR>';
            proposeMAILOVSinscriT2($noms, 'maill1');

            echo '<BR>Joueur2:<BR>';
            proposeMAILOVSinscriT2($noms, 'maill2');

            break;
        default:
    }





    echo '	Score setNo1 Joueur1(si tie en 75, mettre 75 ET décocher pour tie ci-dessous ): <input type="number" name="score1" >  <BR>

		Score setNo1 Joueur2: <input type="number" name="score2" >  <BR>
<input type="checkbox" name="isNormalscore"  checked="checked">Score normal=coché (ou tie=décoché)  <BR>


  <BR>    Score setNo2 Joueur1: <input type="number" name="scoreSet2j1" > 
          <BR>Score setNo2 Joueur2:     Score2: <input type="number" name="scoreSet2j2" > 
 <input type="checkbox" name="isNormalscore2"  checked="checked">Score normal=coché (ou tie=décoché)  <BR>

        <BR> <BR>Score setNo3 Joueur1:    <input type="number" name="scoreSet3j1" > 
  <BR>Score setNo3 Joueur2:  <input type="number" name="scoreSet3j2" > 
    <input type="checkbox" name="isNormalscore3"  checked="checked">Score normal=coché (ou tie=décoché)  <BR>
';



    //$noms ci dessus
    echoDeb('<BR>lbl756 sizeof=' . sizeof($noms));
    echoDeb('<BR>lbl757 $noms[0]=' . $noms[0]);


    /*
      for($m = 0;$m< sizeof($noms); $m++) {
      echo'<BR>$m='.$m;
      echo '<input type="radio" name="ovesien2" value="'.$noms[$m].'">'.$noms[$m].'<br>'; */


//TODO mois jour
    //h debut
    //min deb
    //h fin
    //min fin
    //score2 3
    echo '<BR>Jour(1-30)*: <input type="number" name="jdeb" > 
<BR>DEBUT Heure(0-59):      <input type="number" name="hdeb" > 
  <BR>       Min: <input type="number" name="mindeb" > 
   
  <BR>Heure de fin      <input type="number" name="hfin" > 
   <BR>Minute de fin     <input type="number" name="minfin" > 
      ';

    echo '		<br>
		<br>
		<input type="submit" value="Inscription du match ">





		  </form>';
    echo '</DIV id="createSimple" >';
}

//function
//fffffffffffffffffffffffffffffffffffffffffffffffff

function createMatchSimpleDropdown($idTypeProposed) {
    /* nom ou mail */
//TODO


    echo '	<P>Enregistrement des matchs Simples</P>';
    echoDeb('<BR>lbl24677 adminFunctions');
    echo '<form  id="formulrMatch" action="tennisOVS2016admin2.php"  method="post">';





    //  $noms = setVectorFromBDD();
    $noms = setVectorFromBDDtyped($idTypeProposed);
    echo '<DIV id="createSimple">'; //TODO enlever tout affichage pr des functions
    echoDeb('<BR>lbl504448 sizeof($noms)=' . sizeof($noms));

    switch ($idTypeProposed) {
        case "nom":
            echoDeb('lbl56673 nom');
            echo ' <input type="hidden" value="1" name="typeOfTournoiNo" >';
            proposeNomsOVSinscri($noms);
            proposeNomsOVSinscri($noms);



            break;
        case "mail":
            //tournoi no2
            echoDeb('<BR>lbl56677 mail');
            echo ' <input type="hidden" value="2" name="typeOfTournoiNo"  >';
            echo '<BR>Joueur1:<BR>';
            echo '<select  name="maill1">';
            echoDeb3('<BR>noms='.$noms);
            proposeMAILOVSinscriT2dropdown($noms, 'maill1'); //TODO virer mail1 en param car est a l exth et ne sert a rien ds la fx
            echo '</select>';


            echo '<BR>Joueur2:<BR>';
            echo '<select  name="maill2" >';
            proposeMAILOVSinscriT2dropdown($noms, 'maill2');
            echo '</select><BR>';
            break;
        default:
    }





    echo '<BR>	Score setNo1 Joueur1(si tie en 75, mettre 75 ET décocher pour tie ci-dessous ): <input type="number" name="score1" >  <BR>

		Score setNo1 Joueur2: <input type="number" name="score2" >  <BR>
<input type="checkbox" name="isNormalscore"  checked="checked">Score normal=coché (ou tie=décoché)  <BR>


  <BR>    Score setNo2 Joueur1: <input type="number" name="scoreSet2j1" > 
          <BR>Score setNo2 Joueur2:     Score2: <input type="number" name="scoreSet2j2" > 
 <input type="checkbox" name="isNormalscore2"  checked="checked">Score normal=coché (ou tie=décoché)  <BR>

        <BR> <BR>Score setNo3 Joueur1:    <input type="number" name="scoreSet3j1" > 
  <BR>Score setNo3 Joueur2:  <input type="number" name="scoreSet3j2" > 
    <input type="checkbox" name="isNormalscore3"  checked="checked">Score normal=coché (ou tie=décoché)  <BR>
';



    //$noms ci dessus
    echoDeb('<BR>lbl756 sizeof=' . sizeof($noms));
    echoDeb('<BR>lbl757 $noms[0]=' . $noms[0]);


    /*
      for($m = 0;$m< sizeof($noms); $m++) {
      echo'<BR>$m='.$m;
      echo '<input type="radio" name="ovesien2" value="'.$noms[$m].'">'.$noms[$m].'<br>'; */


//TODO mois jour
    //h debut
    //min deb
    //h fin
    //min fin
    //score2 3
    echo '<BR>Jour(1-30)*: <input type="number" name="jdeb" > 
<BR>DEBUT Heure(0-59):      <input type="number" name="hdeb" > 
  <BR>       Min: <input type="number" name="mindeb" > 
   
  <BR>Heure de fin      <input type="number" name="hfin" > 
   <BR>Minute de fin     <input type="number" name="minfin" > 
      ';

    echo '		<br>
		<br>
		<input type="submit" value="Inscription du match ">





		  </form>';
    echo '</DIV id="createSimple" >';
}

//fffffffffffffffffffffffffffffffffffff
function createDouble() {
//TODO
//echo '	<P>update</P>

    echo '<DIV id="createDouble">';
    echo '<P>	createDouble</P>';






    $noms = setVectorFromBDD();
    echo '<BR> sizeof($noms)=' . sizeof($noms);


    proposeNomsOVSinscri($noms);






    echo '	Score1: <input type="number" name="score1" >  <BR>

		Score2: <input type="number" name="score2" >  <BR>


		<input type="checkbox" name="isNormalscore" value="true">Score normal (ou tie)  <BR>';


    //$noms ci dessus
    echo '<BR>sizeof=' . sizeof($noms);
    echo '<BR>$noms[0]=' . $noms[0];




    proposeNomsOVSinscri($noms);


    echo '		<br>
		<br>
		<input type="submit" value="Inscription">





		  </form> <DIV  id="createDouble">';
}

//function
//ffffffffffffffffffffffffffffffff

function deleteCookiesOVS() {
    //http://www.tutorialspoint.com/php/php_web_concepts.htm  $_PHP_SELF
    echo '	<P>Delete cookies</P>
	<form  action="';
    echo ' <?php setcookie("pseudoOVS","", - time()+3600*24*365);

setcookie("passw","",- time()+3600*24*365);
 ?>';
    echo '"  method="post">';



    echo '		<br>
		<br>
		<input type="submit" value="reset Cookies OVS">





		  </form>';
    echo '</DIV id="deleteCookiesOVS" >';
}

//ffffffffffffffffffffffffffffffff
/* * TODO TEST; reporter sur inscrits() de tennisOVS2016.php 
  corriger l ori de la copie TD en TH ds matchs ou inscrits
  called from  deliriumTennisClub.php
  out : void (ne fait que afficher dans un div)
  TODO rajouter alias */
function affichTable($reqVars, $tableName) {
    echo '<DIV  class="container-fluid">'; //TODO peut etre n afficher qu a partir de TABLE
    //   $GLOBALS['query']  = "select `nomOVS`  from  `tennisOVS2016`;";//!!!backticks sont VITAUX, quotes ne fontionnent pas!!
    $nameses = "";
    for ($ik = 0; $ik <= count($reqVars); $ik++) {
        $nameses = $nameses . "`,`" . $reqVars[$ik];
    }
    $nameses = substr($nameses, 2);
    $nameses = substr($nameses, 0, -2);
    // echo '<BR> lbl2448 $nameses='.$nameses;

    $GLOBALS['query'] = "select " . $nameses . "  from  `" . $tableName . "` where secret is null ;";
//  echo '<BR> lbl834 query='.  $GLOBALS['query'] ;

    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //  	echo '<BR> lbl827';
    } else {

        echo '<BR> lbl829';
    }

    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        // echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);


        echo '<table>';
//      echo "  <TR >  <TD> <b>"."Pseudo OVS inscrits"."</b> </TD>      </TH> ";
        // $chnTH= "  <TR > ";//TODO corriger ori
        $chnTH = "  <TR> ";

        for ($ij = 0; $ij < count($reqVars); $ij++) {
            //  echo '<BR>lbl037 reqVars ij='.$reqVars[$ij];
            $chnTH = $chnTH . " <TH> <b>" . $reqVars[$ij] . "</b> </TH> ";
        }

        $chnTH = $chnTH . "</TR>";
        //  echo '<BR>lbl038 chnTH='. $chnTH;
        echo $chnTH;
        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            //	echo 'lbl45';
            //print  nl2br("<BR>params");
            //    $minn =  $i[ "min"];
            // echo  nl2br("<BR>jour different");
            //  else{

            echo '<TR> ';
            for ($cpt4 = 0; $cpt4 < count($reqVars); $cpt4++) {

                $varr = $reqVars[$cpt4];

                $nomOVS = $i["nomOVS"];
                //	echo "lbl58 nomOVS=$nomOVS";
                //   echo ' <TD>'.$nomOVS.'</TD>';
                echo ' <TD>' . $i[$varr] . '</TD>';
            }
            echo ' </TR>';
            //	echo "lbl60";
            // echo   "jourSov=".$jourSov;
            $i++;
        }//fin while
    } else {
        echo '<BR>lbl36';
    }

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE>";




    echo ' </DIV>';
}

//ffffffffffffffffffffffffffffffff
//fffffffffffffffffffffffffffffff

/** inscription() */
function inscriptionSite() {

    echo '    <DIV id="inscriptionn" class="container-fluid">
    
          <H2>INSCRIPTION:</H2>
    <!-- onsubmit="return validateForm()"  -->
          <form action="tennisOVS2016inscription.php"  method="post" >
    
        Pseudo OVS: <input type="text" name="pseudoOVS" required>  <BR>
    
    
        <input type="radio" name="gender" value="male"  required>Homme<br>
        <input type="radio" name="gender" value="female">Femme<br>
    
    
        <BR>  <BR>
        Mot de passe: <input type="password" name="pass1" id="mdp" required>
        <BR>
        Mot de passe verif: <input type="password" onBlur="passwordSame(this)" id="mdp2" required>
        <DIV id="erreurMsg" class="container-fluid"></DIV>
        <BR>   <BR>
    
        <input type="checkbox" name="matin" value="oui">Participe aux simples du matin   <BR>
        <input type="checkbox" name="aprem" value="oui">Participe aux doubles de l\'après-midi
    
        <BR>   <BR>
        Mail:       <BR>
        <input type="radio" name="mail" value="OVS" required>mail par OVS<br>
        <input type="radio" name="mail" value="perso">mail perso:  <input type="text" name="mailperso" onblur="isMailpersoOK()"  id="mailPersoo"> <br>
    
        <!-- http://stackoverflow.com/questions/21203866/jquery-validate-checkbox-checked-required  -->
        <input type="checkbox" name="reglement"  value="accepted"  id="regl"  onblur="isReglAccepted" required>J\'ai lu et j\'accepte totalement le règlement<BR>
        <DIV id="erreurRegl"></DIV>
        <br>
        <br>
        <input type="submit" value="Inscription">
          </form>
    
    
    
    
    </DIV id="inscriptionn">
    ';
}

//fffffffffffffffffffffffffffffffffff
//ffffffffffffffffffffffffffff
function MdPoublié() {
    
}

//ffffffffffffffffffffffffffff
function envoieMailOVS($mesg, $nommOVSS) {
    //$nommOVSS=messagerie
}

//ffffffffffffffffffffffffffff
function envoieMailPerso($mesg, $mail) {
    
}

//ffffffffffffffffffffffffffff
function envoieMailsSpecifiques($idsMonSiteArray, $messagesSpecifiques) {
    // envoieMailOVS();
    // envoieMailPerso();
}

//ffffffffffffffffffffffffffff
function envoieMailsBroadcast($idsMonSiteArray, $message) {
    // envoieMailOVS();
    // envoieMailPerso();
}

//ffffffffffffffffffffffffffff
function envoieMail($idMonSiteString, $message) {
    // envoieMailOVS();
    // envoieMailPerso();
}

//ffffffffffffffffffffffffffff
function setAleaInDBuser($tabl, $colChamp) {

    for ($i = 1; $i < 100; $i++) {

        $req = "update  `tennisOVS2Le20160919`  set  aleaUser = 
rand( )where id = " . $i;
    }

    // if 
    //   if(1){
    //heure inscription avant minuit
    //  }else{
    //alea apres aleas d AV
    //  }
    //  }
//}
}

//ffffffffffffffffffffffffffff
function changerMdP() {
    
}

//ffffffffffffffffffffffffffff
function logout() {
    setcookie("pseudoOVS", "", - time() + 3600 * 24 * 365);
    setcookie("passw", "", -time() + 3600 * 24 * 365);


    setcookie("isOVSconnected", 0, - time() + 3600 * 24 * 365);
}

//ffffffffffffffffffffffffffff
function login() {

//action="tennisOVS2016connexion.php"  method="post"
    //appelle  validateForm2() from .js
    echo '
    <DIV name = "logina" id="login"  class="container-fluid">
<form 
onsubmit="return validateForm2()" name="formN" id="formId">
    
          <H2>Connexion</H2>
         
        Pseudo OVS: <input type="text" name="pseudoOVS" required>  <BR>
    
    
      <BR>
        Mot de passe: <input type="password" name="pass1" id="mdp" required>


 <input type="submit" value="Envoi">

        <BR>
    
    
    </form> </DIV id="login">';
    echo '
      <DIV id="debug"></DIV>
     '; //TODO
}

//ffffffffffffffffffffffffffff

function inscrits() {
    echo ' <DIV id="inscrits" class="container-fluid" >
        <H2>Liste des inscrits </H2>
        <P>';





    $GLOBALS['query'] = "select `nomOVS`  from  `tennisOVS2016`;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!


    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        /* 	echo 'lbl27'; */
    } else {

        /* 	echo 'lbl29'; */
    }
    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //	 echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);


        echo '<table>';
        echo "  <TR >  <TD> <b>Pseudo OVS inscrits</b> </TD>      </TH> ";
        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            //	echo 'lbl45';
            //print  nl2br("\nparams");
            //    $minn =  $i[ "min"];
            // echo  nl2br("\njour different");
            //  else{



            $nomOVS = $i["nomOVS"];
            //	echo "lbl58 nomOVS=$nomOVS";
            echo '<TR>  <TD>' . $nomOVS . '</TD> </TR>';



            //	echo "lbl60";
            // echo   "jourSov=".$jourSov;
            $i++;
        }//fin while
    }//endif

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE>";




    echo '	</P>
          </DIV  id="inscrits">';
}

//ffffffffffffffffffffffffffffffffffffff

function footerr() {

    echo '                   
       <DIV id="footerr"class="container-fluid">
        <SPAN class="spanFooter" id="ovs" id="ovsORI">  <a id="ovsOri2">OVS</a>   </SPAN>  
    
  <SPAN class="spanFooter" id="ovs">  <a  href="http://moueza.esy.es/tennis.html">Up</a>



  <SPAN class="spanFooter" id="pubs">  <a  href="http://moueza.esy.es/publicites.html">Pubs</a>



           <SPAN  class="spanFooter" id="homee"> <a  href="index.html">Home</a>  </SPAN>
      <SPAN  class="spanFooter"  id="powered">A site powered by Peter MOUEZA from <a  href="https://www.google.fr/search?client=ubuntu&channel=fs&q=homniserv&ie=utf-8&oe=utf-8&gfe_rd=cr&ei=H73eV6r_GNCT8QfLppWABQ">Homniserv</a> Contact : mouezapeter@gmail.com</SPAN>
           
        </DIV id="footerr">
    ';
}

//ffffffffffffffffffffffffffffff
function speech() {
    echo '
    <DIV id="speech" class="speechh    container-fluid"><H2>SPEECH</H2>
            <P>Merci pour ce dimanche de folie. Ce fût un très bon moment, passé dans la bonne humeur. Avec ses improvisations, son pique-nique, le super temps, une petite brise à certains moments. J\'espère que tout le monde a apprécié!</P>
             <P>Grâce à OVS, nous avons attiré du monde 45 kms à la ronde.</P>  <P>Et avec le partenariat Décathlon, nous avons pu récompenser le grand gagnant du simple : nicobrez. Merci à lui de s\'être déplacé de si loin.</P> <P>Merci à tous et merci aussi à Haminga d\'être venue!</P>
    </DIV>
    
    <DIV class="speechh container-fluid">Vous l\'attendiez, voici notre photo de groupe avec le gagnant devant :
    
    </DIV>';

    echo'
    
    <DIV class="speechh container-fluid">
      <img src="20160814_140342.jpg" id="imagg"
             alt="Tournoi OVS tennis 2016" height="299" width="531">
    </DIV>
   
    <DIV  class="speechh container-fluid">Et peut être un petit bonus dans la semaine...SUSPENSE! lol</DIV>
    ';

    echo '   <DIV  class="" id="bonus" container-fluid">Aller, ne faisons pas durer le supplice plus longtemps, pour les <b>inscrits connectés</b>, voici un bon <a href="tennisOVS2016bonus.php">lien</a></DIV>';


    //haminga http://nantes.onvasortir.com/tennis-a-la-durantiere-2149441.html  http://nantes.onvasortir.com/profil_read.php?Haminga
}

//ffffffffffffffffffffffffffffff

function horaires() {

    echo '
    
        <DIV id="horaires" class="container-fluid">
            <H2>LES HORAIRES : </H2>
       <H3>Simples : </H3>
          <ul><li>9h  Sco44 VS Alice427</li>
    <li>9h Stephan VS Synhedionn</li><BR>
    
    <li>9h45 LaP0mme44 VS joshua44</li>
    <li>9h45 nicobrez VS Number6 </li>
    
    </ul>
    
    
    
     <H3>Doubles : </H3>
    
     <ul><li>14h(Stephan et Sco44) 
     VS
    (Synhedionn et joshua44)</li>
    
     <li>14h(nicobrez et LaP0mme44)
    
    VS
    
    (Number6  et ?)</li>
    
    </ul>
    
    ';
}

//fffffffffffffffffffffffffffffffffffffffff




function messages() {
    messagesGet();
    messagesSet();
}

//fffffffffffffffffffffffffffff
/** TODO corriger bug : messages pas affiches */
function messagesSet() {

    echo '    <DIV id="messagesSet" class="messag container-fluid">
    
          <H2>Messages publics:</H2>
    <!-- onsubmit="return validateForm()"  -->
          <form action="resultForm_tennisOVS2016messages.php"  method="post" >
    
        Message: 
    
    <textarea name="messg" form="usrform"required ></textarea><BR>
    
    
        <br>
        <br>
        <input type="submit" value="Envoi">
          </form>
    
    
    
    
    </DIV id="messagesSet">
    ';
    //<input type="text" name="messg" required>  <BR>
}

//fffffffffffffffffffffffffffff


function messagesGet() {
    echo ' <DIV id="mesgGet"class="messag container-fluid"  >
        <H2>Les Messages </H2>
        <P>';


    $GLOBALS['query'] = "select 	`id` ,	`message` ,	`annee`, 	`mois`, 	`jour`, 	`heur`, 	`min`, 	`sec`, 	`pseudo`  from  `tennisOVS2016messages`;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!


    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        /* 	echo 'lbl27'; */
    } else {
        /* 	echo 'lbl29'; */
    }
    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        // echo 'lbl1035';
        //i de poub.php


        $num = mysqli_num_rows($result);


        $i = 0;

        while ($i = mysqli_fetch_assoc($result)) {
            //echo 'lbl1039';


            $message = $i["message"];
            $annee = $i["annee"];
            $mois = $i["mois"];
            $jour = $i["jour"];
            $heur = $i["heur"];
            $min = $i["min"];
            $sec = $i["sec"];
            $pseudo = $i["pseudo"];
            // 	$ = $i[""];


            echo '<BR><BR>Pseudo : ' . $pseudo . ': Le ' . $annee . ' ' . $mois . ' ' . $jour . ' à ' . $heur . 'h ' . $min . 'min ' . $sec . ' sec';
            echo '<BR>' . $message;
            //	echo '<table>';
            //  echo "  <TR >  <TD> <b>Pseudo OVS inscrits</b> </TD>      </TH> ";



            $i++;
        }//fin while
    }//endif

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE>";


    echo '	</P>
          </DIV  id="mesgGet">';
}

//fffffffffffffffffffffffffffff
/* * Place un cookie(si inexistant) et enregistre ds visitor */
function recordCookiedUser() {
    //TODO a mettre AV tt affichag
    //setcookie("pseudoOVS",$_POST["pseudoOVS"] , time()+3600*24*365);
    //setcookie("passw", $_POST["pass1"], time()+3600*24*365);


    require_once('config.php');










    //$reqVars=['comment','heure','min'];
    //echo 'lbl222';
    $reqVars = ['pseudoOVSS', 'heure', 'min', 'sec'];
    // $reqValues=[ "insert into visitor  (comment) values ('instagram.php  ".$_GET['id']."');"];
    //   $chn2= 'competences.php'.$_GET['ref'];

    if (isset($_COOKIE["pseudoOVS"])) {
        //echoDeb("lbl78995 functions.cookiesUse");
    } else {
        setcookie("pseudoOVS", "" . rand(), time() + 3600 * 24 * 365);
        // echoDeb("lbl78999functions.cookiesUse");
    }
    $reqValues = array();
    $reqValues[0] = $_COOKIE["pseudoOVS"];

    // $reqValues[1] =  date("c"); //date standard
    // $reqValues[9] =  date("d"); ;//jr
    $reqValues[1] = date("H"); //h
    $reqValues[2] = date("i"); //min
    $reqValues[3] = date("s"); //sec
    //echo('competencesChn='.$chn2);
    $req = reqInsertProxyTable($reqVars, $reqValues, "visitor");


    // echo "...poub.php req=".$req;

    /* if(mysqli_connect($conf_host, $conf_username, $conf_password)){
      echo 'connect config OK';
      }else{
      echo 'connect config KO';
      }
     */
    $result = mysqli_query($GLOBALS['conn'], $req);
    //echoDeb("lbllbl78995 funct.cookUser");
}

//fffffffffffffffffffffffffffff
function matchsEnr() {
    $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2016`j1, `tennisOVS2016`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id order by noMatch
    
    ;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!


    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {/* 	echo 'lbl27'; */
    } else {/* 	echo 'lbl29'; */
    }


    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //	 echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);




        echo '<DIV id="matchsEnr" class="container-fluid"> <b>Matchs enregistrés</b>
 <BR><b>Simples</b>  <table>';
        echo "<TR>  <TH>joueur1</TH>   <TH> Score J1</TH>   <TH> Score J2</TH>   <TH>Score normal?(ou tie) </TH>   <TH>joueur2</TH></TR>
      ";
        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            //	echo 'lbl45';
            //print  nl2br("\nparams");
            //    $minn =  $i[ "min"];
            // echo  nl2br("\njour different");
            //  else{
            //echo 'lbl6 poub.php852';


            $nomOVS1 = $i["nam1"];
            $scoreJ1 = $i["scoreJ1"];
            $scoreJ2 = $i["scoreJ2"];
            $isScoreNormal = $i["isScoreNormal"];
            $nomOVS2 = $i["nam2"];

            //	echo "lbl58 nomOVS=$nomOVS";
            echo '<TR>  <TD>' . $nomOVS1 . '</TD> <TD>' . $scoreJ1 . '</TD> <TD>' . $scoreJ2 . '</TD> <TD>' . $isScoreNormal . '</TD> <TD>' . $nomOVS2 . '</TD> </TR>';



            //	echo "lbl60";
            // echo   "jourSov=".$jourSov;
            $i++;
        }//fin while
    }//endif


    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE></DIV>";




    echo '<DIV><b>Doubles<b>';
    echo '<BR><TABLE>';
    echo '<TR><TH>Couple1</TH> <TH>Score1</TH> <TH>Score2</TH> <TH>Couple2</TH> </TR>';
    echo '<TR><TD>Number6&Alice </TD><TD>0</TD><TD>6</TD> <TD>Stephan&Synhedionn</TD></TR>';


    echo '<TR><TD>Stephan&Synhedionn</TD><TD>2</TD><TD>6</TD> <TD>NicoBrezh&Sco44</TD></TR>';




    echo '<TR><TD>LaPomme&Joshua</TD><TD>4</TD><TD>7 Tie</TD> <TD>NicoBrezh&Sco44</TD></TR>';




    echo '<TR><TD>Number6&Alice </TD><TD>6</TD><TD>4</TD> <TD>LaPomme&Joshua</TD></TR>';



    echo '<TR><TD>Stephan&Synhedionn</TD><TD>7</TD><TD>5</TD> <TD>    LaPomme&Joshua</TD></TR>';

    echo '</TABLE>';
    echo '</DIV>';
}

//fffffffffffffffffffffffffffff
function select($fieldsArray) {
    echo '<TD>';
}

//ffffffffffffffffffffffffffff
//getMessagesDated(){}
//ffffffffffffffffffffffffffff
function setMessageDated() {
    
}

//ffffffffffffffffffffffffffff
function actualites($idsMonSiteArray, $message) {
    // envoieMailOVS();
    // envoieMailPerso();
    //getMessagesDated()
}

//ffffffffffffffffffffffffffff
function formGetMatches($idsMonSiteArray, $message) {
    // envoieMailOVS();
    // envoieMailPerso();
    //getMessagesDated()
    echo '
    <H2>Matchs </H2>
        <DIV id="matches">
            //TODO creer ta balise Match en AngularJS
        <DIV id="match">
      <P class="classMatch">Match1:</P>
            <P></P>
            </DIV id="match" >
    
            </DIV>
    ';
}

//fffffffffffffffffffffffffffff
//fffffffffffffffffffffffffffffff
/* * inscription sur le site pr un compte(certains st deja inscrits sur site av le tournoi1 ms pas inscrits pr tournoi2) != inscrition tournoi

 *  inscription2() */
function inscription2site() {

    echo '    <DIV id="inscriptionn2compte" class="container-fluid">
    
          <H2>INSCRIPTION:</H2>
    <!-- onsubmit="return validateForm()"  -->
          <form action="tournoiNo2inscription.php"  method="post" >
    
        Pseudo OVS: <input type="text" name="pseudoOVS" required>  <BR>
    
    
        <input type="radio" name="gender" value="male"  required>Homme<br>
        <input type="radio" name="gender" value="female">Femme<br>
    
    
        <BR>  <BR>
        Mot de passe: <input type="password" name="pass1" id="mdp" required>
        <BR>
        Mot de passe verif: <input type="password" onBlur="passwordSame(this)" id="mdp2" required>
        <DIV id="erreurMsg" class="container-fluid"></DIV>
        <BR>   <BR>
    
        <input type="checkbox" name="matin" value="oui">Participe aux simples du matin   <BR>
        <input type="checkbox" name="aprem" value="oui">Participe aux doubles de l\'après-midi
    
        <BR>   <BR>
        Mail:       <BR>
        <input type="radio" name="mail" value="OVS" required>mail par OVS<br>
        <input type="radio" name="mail" value="perso">mail perso:  <input type="text" name="mailperso" onblur="isMailpersoOK()"  id="mailPersoo"> <br>
    
        <!-- http://stackoverflow.com/questions/21203866/jquery-validate-checkbox-checked-required  -->
       
        <DIV id="erreurRegl"></DIV>
        <br>
        <br>
        <input type="submit" value="Inscription au">
          </form>
    
    
    
    
    </DIV id="inscriptionn2compte">
    ';
}

//fffffffffffffffffffffffffffffffffff
/** pr inscription au tournoi, besoin que du pseudo, mdp que pr login : a part */
function isAmong8($nomm) {
    $reqq = 'select * from  `tennisOVS2016` where nomOVS="' . $nomm . '";';
    $vectt = setVectorFromBDD();
    $matching = false;
    $cpt2 = 0;
    while ((!$matching) && ($cpt2 < count($vectt))) {
        if ($vectt[$cpt2] == $nomm) {
            $matching = true;
        } else {
            
        }
        $cpt2++;
    }
    if ($matching) {
        return true;
    } else {
        return false;
    }
}

//TODO demander  mdp
////TODO demander mail meme aux anciens
//fffffffffffffffffffffffffffff
/** OVS ou pas, precedent ou pas */
function askForPseudo() {
    // echo '<BR>lbl446 in askForPseudo from ...functions.php';
    echo '<BR> <label for="ancien">Ancien du tournoi1</label>
  <input type="radio" name="choixPseudo" id="ancien" value="ancien" required><br>
           ';
    proposeNomsOVSinscri(setVectorFromBDD());







    echo '
  <label for="nouveauDovs">Nouveau ici, et PseudoOVS</label>
  <input type="radio" name="choixPseudo" id="nouveauDovs" value="nouveauDovs"><br>
  
<label for="nouveauDovs">Pseudo d OVS</label>
<input type="text" name="nomPseudoOVS" id="nomPseudoOVS">';





    echo '<BR><label for="nouveauExth">Nouveau ici, hors OVS</label>
  <input type="radio" name="choixPseudo" id="nouveauExth" value="nouveauExth"><br>
  
<label for="nouveauExth">Pseudo hors OVS</label>
<input type="text" name="nomPseudoHors" id="nomPseudoHors">';
}

//fffffffffffffffffffffffffffff
function isAmongAllPseudos() {
    
}

//fffffffffffffffffffffffffffff
function askForMdp() {

    echo '<br> <input type="text" name="mdp" placeholder="mdp nec que pr les nouv"  id="mdp">';
}

//fffffffffffffffffffffffffffff
function echoDeb($chnn) {
    //echo $chnn;
}

//fffffffffffffffffffffffffffff
function echoDeb3($chnn) {
    //echo $chnn;
}

//fffffffffffffffffffffffffffff
//fffffffffffffffffffffffffffff
/* * TODO TEST; reporter sur inscrits() de tennisOVS2016.php 
  corriger l ori de la copie TD en TH ds matchs ou inscrits
  called from  deliriumTennisClub.php
  out : void (ne fait que afficher dans un div)
  TODO rajouter alias
 * KO!!!!!!!!!!!!! */
function affichTableAlias($reqVars, $tableName, $aliases) {
    //TODO verifier que meme taille $reqVars $aliases
    echo '<DIV  class="container-fluid">'; //TODO peut etre n afficher qu a partir de TABLE
    //   $GLOBALS['query']  = "select `nomOVS`  from  `tennisOVS2016`;";//!!!backticks sont VITAUX, quotes ne fontionnent pas!!
    $nameses = "";
    for ($ik = 0; $ik <= count($reqVars); $ik++) {
        $nameses = $nameses . "," . $reqVars[$ik]; //KO  // "` as `".$aliases.
    }
    echoDeb('<BR>lbl47966' . $nameses);
    $nameses = substr($nameses, 2);
    $nameses = substr($nameses, 0, -2);
    // echo '<BR> lbl2448 $nameses='.$nameses;

    $GLOBALS['query'] = "select " . $nameses . "  from  `" . $tableName . "`;";
//  echo '<BR> lbl834 query='.  $GLOBALS['query'] ;

    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //TODO test sur ce qu il y a en table
        echoDeb('<BR> lbl827');
    } else {

        echoDeb('<BR> lbl829');
    }

    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        // echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);


        echo '<table>';
//      echo "  <TR >  <TD> <b>"."Pseudo OVS inscrits"."</b> </TD>      </TH> ";
        // $chnTH= "  <TR > ";//TODO corriger ori
        $chnTH = "  <TR> ";

        for ($ij = 0; $ij < count($reqVars); $ij++) {
            //  echo '<BR>lbl037 reqVars ij='.$reqVars[$ij];
            $chnTH = $chnTH . " <TH> <b>" . $reqVars[$ij] . "</b> </TH> ";
        }

        $chnTH = $chnTH . "</TR>";
        //  echo '<BR>lbl038 chnTH='. $chnTH;
        echo $chnTH;
        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            //	echo 'lbl45';
            //print  nl2br("<BR>params");
            //    $minn =  $i[ "min"];
            // echo  nl2br("<BR>jour different");
            //  else{

            echo '<TR> ';
            for ($cpt4 = 0; $cpt4 < count($reqVars); $cpt4++) {

                $varr = $reqVars[$cpt4];

                $nomOVS = $i["nomOVS"];
                //	echo "lbl58 nomOVS=$nomOVS";
                //   echo ' <TD>'.$nomOVS.'</TD>';
                echo ' <TD>' . $i[$varr] . '</TD>';
            }
            echo ' </TR>';
            //	echo "lbl60";
            // echo   "jourSov=".$jourSov;
            $i++;
        }//fin while
    } else {
        echo '<BR>lbl36';
    }

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE>";




    echo ' </DIV>';
}

//fffffffffffffffffffffffffffff
function debugDeclaration() {
    echo '<DIV class="container-fluid>Site fonctionnel, mais en mode debug. Si un bug, faites des Save as... et envoyer à mouezapeter@gmail.com</DIV>';
}

//fffffffffffffffffffffffffffff
function declarCookiesNavigateurs() {
    echo '<DIV  class="container-fluid">Attention, activez les cookies dans votre navigateur(pour éviter de toujours entrer les mots de passe) '
    . '</DIV>'
    . '<BR>Si ça ne fonctionne toujours pas, essayez un autre navigateur : Firefox, Chrome, Internet Explorer</div>';
}

//fffffffffffffffffffffffffffff
function setAleaPassMail() {

    for ($i = 1; $i < 100; $i++) {

        $req = "update  `tennisOVS2Le20160919`  set  aleaMdP = 
rand( )where id = " . $i;
    }



    // if 
    //   if(1){
    //heure inscription avant minuit
    //  }else{
    //alea apres aleas d AV
    //  }
    //  }
//}
}

//fffffffffffffffffffffffffffff
function declarDebug() {
    echoDeb('<BR><DIV class="declar">Site FONCTIONNEL, mais en mode debug; envoyer la page par Save as...par mail pour debugage<BR></DIV>');
}

//fffffffffffffffffffffffffffff
function boutonCookiesReset() {
    echo'<BR><DIV class="boutonCookiesReset">'
    . '<form id="formCookiesReset" action="resultForm_boutonCookiesReset.php"    method="post">'
    . '<input type="submit" value="reset cookies"> ' . '</form>' . '<BR></DIV>';
}

//fffffffffffffffffffffffffffff
function affichTableWhereOrderby($reqVars, $tableName, $wheree, $orderby) {
    echo '<DIV  class="container-fluid">'; //TODO peut etre n afficher qu a partir de TABLE
    //   $GLOBALS['query']  = "select `nomOVS`  from  `tennisOVS2016`;";//!!!backticks sont VITAUX, quotes ne fontionnent pas!!
    $nameses = "";
    for ($ik = 0; $ik <= count($reqVars); $ik++) {
        $nameses = $nameses . "`,`" . $reqVars[$ik];
    }
    $nameses = substr($nameses, 2);
    $nameses = substr($nameses, 0, -2);
    // echo '<BR> lbl2448 $nameses='.$nameses;

    $GLOBALS['query'] = "select " . $nameses . "  from  `" . $tableName . "` where " . $wheree . " order by " . $orderby;
// echo '<BR> lbl834 query='.  $GLOBALS['query'] ;

    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //  	echo '<BR> lbl827';
    } else {

        echo '<BR> lbl829';
    }

    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        // echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);


        echo '<table>';
//      echo "  <TR >  <TD> <b>"."Pseudo OVS inscrits"."</b> </TD>      </TH> ";
        // $chnTH= "  <TR > ";//TODO corriger ori
        $chnTH = "  <TR> ";

        for ($ij = 0; $ij < count($reqVars); $ij++) {
            //  echo '<BR>lbl037 reqVars ij='.$reqVars[$ij];
            $chnTH = $chnTH . " <TH> <b>" . $reqVars[$ij] . "</b> </TH> ";
        }

        $chnTH = $chnTH . "</TR>";
        //  echo '<BR>lbl038 chnTH='. $chnTH;
        echo $chnTH;
        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            //	echo 'lbl45';
            //print  nl2br("<BR>params");
            //    $minn =  $i[ "min"];
            // echo  nl2br("<BR>jour different");
            //  else{

            echo '<TR> ';
            for ($cpt4 = 0; $cpt4 < count($reqVars); $cpt4++) {

                $varr = $reqVars[$cpt4];

                $nomOVS = $i["nomOVS"];
                //	echo "lbl58 nomOVS=$nomOVS";
                //   echo ' <TD>'.$nomOVS.'</TD>';
                echo ' <TD>' . $i[$varr] . '</TD>';
            }
            echo ' </TR>';
            //	echo "lbl60";
            // echo   "jourSov=".$jourSov;
            $i++;
        }//fin while
    } else {
        echo '<BR>lbl36';
    }

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE>";




    echo ' </DIV>';
}

//fffffffffffffffffffffffffffff
function affichTableWhere($reqVars, $tableName, $wheree) {
    echo '<DIV  class="container-fluid">'; //TODO peut etre n afficher qu a partir de TABLE
    //   $GLOBALS['query']  = "select `nomOVS`  from  `tennisOVS2016`;";//!!!backticks sont VITAUX, quotes ne fontionnent pas!!
    $nameses = "";
    for ($ik = 0; $ik <= count($reqVars); $ik++) {
        $nameses = $nameses . "`,`" . $reqVars[$ik];
    }
    $nameses = substr($nameses, 2);
    $nameses = substr($nameses, 0, -2);
    // echo '<BR> lbl2448 $nameses='.$nameses;

    $GLOBALS['query'] = "select " . $nameses . "  from  `" . $tableName . "` where " . $wheree;
//  echo '<BR> lbl834 query='.  $GLOBALS['query'] ;

    $result = [];
    //	echo 'lbl25';
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //  	echo '<BR> lbl827';
    } else {

        echo '<BR> lbl829';
    }

    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        // echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);


        echo '<table>';
//      echo "  <TR >  <TD> <b>"."Pseudo OVS inscrits"."</b> </TD>      </TH> ";
        // $chnTH= "  <TR > ";//TODO corriger ori
        $chnTH = "  <TR> ";

        for ($ij = 0; $ij < count($reqVars); $ij++) {
            //  echo '<BR>lbl037 reqVars ij='.$reqVars[$ij];
            $chnTH = $chnTH . " <TH> <b>" . $reqVars[$ij] . "</b> </TH> ";
        }

        $chnTH = $chnTH . "</TR>";
        //  echo '<BR>lbl038 chnTH='. $chnTH;
        echo $chnTH;
        $i = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            //	echo 'lbl45';
            //print  nl2br("<BR>params");
            //    $minn =  $i[ "min"];
            // echo  nl2br("<BR>jour different");
            //  else{

            echo '<TR> ';
            for ($cpt4 = 0; $cpt4 < count($reqVars); $cpt4++) {

                $varr = $reqVars[$cpt4];

                $nomOVS = $i["nomOVS"];
                //	echo "lbl58 nomOVS=$nomOVS";
                //   echo ' <TD>'.$nomOVS.'</TD>';
                echo ' <TD>' . $i[$varr] . '</TD>';
            }
            echo ' </TR>';
            //	echo "lbl60";
            // echo   "jourSov=".$jourSov;
            $i++;
        }//fin while
    } else {
        echo '<BR>lbl36';
    }

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE>";




    echo '</DIV>';
}

//fffffffffffffffffffffffffffff
/**  affichage 
  TODO .par affichTableWhereOrderby()
  .test pr eviter de tt casser à la modif
  ........AFFICHE MAL COMME HADRIEN */
function matchsEnr2($tournoiNo) {
    echoDeb2('lbl5187 in');
    switch ($tournoiNo) {
        case 1:
            $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2016`j1, `tennisOVS2016`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id  and secret = null order by datee

    ;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!
            echoDeb2('lbl460453 case T1');

            break;
        case 2:
            // $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2Le20160919`j1, `tennisOVS2Le20160919`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id and tournoiNo = " . " 2 " . " and secret = null order by datee ;";
            /* pas besoin de where NI FROMMMMMM car heritage type1, ms la tout est deja dans la table $GLOBALS['query'] = " SELECT j1.`mail` ml1, `scoreJ1`, `scoreJ2`, `isScoreNormal`,            `score2J1`, `score2J2`, `isScoreNormal2`,       `score3J1`, `score3J2`, `isScoreNormal3`      ,j2.`mail` ml2
              FROM `tennisOVS2016matchs` matchh, `tennisOVS2Le20160919` j1, `tennisOVS2Le20160919` j2
              WHERE matchh.mail1 = j1.mail
              AND matchh.mail2 = j2.mail
              AND tournoiNo =2 ;"; */
            $GLOBALS['query'] = " SELECT `mail1` , `scoreJ1`, `scoreJ2`, `isScoreNormal`,            `score2J1`, `score2J2`, `isScoreNormal2`,       `score3J1`, `score3J2`, `isScoreNormal3`      ,`mail2` 
FROM `tennisOVS2016matchs` matchh
WHERE tournoiNo =2 and secret is null order by jourMatch, startHeur;";
            echoDeb2('lbl460457 case T2 quer=' . $GLOBALS['query']);
            break;
        default:
            echo('lbl460463 case default jamais');
            $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2Le20160919`j1, `tennisOVS2Le20160919`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id and tournoiNo = " . $tournoiNo . " and secret = null order by datee
 
    ;";
    }
    echoDeb2('<BR> lbl114535 func.MatchEnr2');

    $result = [];
    echoDeb2('lbl00025');
    if (mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        echoDeb2('lbl527');
    } else {
        echoDeb2('lbl529');
    }

    echoDeb2('<BR> lbl114540 func.MatchEnr2');

    if ($result = mysqli_query($GLOBALS['conn'], $GLOBALS['query'])) {
        //	 echo 'lbl35';
        //i de poub.php


        $num = mysqli_num_rows($result);



        echo '<DIV id="matchsEnr" class="container-fluid"> <b>Matchs enregistrés</b>
 <BR><b>Simples</b>  <table>';
        echo "<TR>  <TH>Joueur1</TH>   <TH> Set1 J1</TH>   <TH> Set1 J2</TH>   <TH>Score normal?(ou tie) </TH>  

  <TH> Set2 J1</TH>   <TH> Set2 J2</TH>   <TH>Score normal?(ou tie) </TH>  
  <TH> Set3 J1</TH>   <TH> Set3 J2</TH>   <TH>Score normal?(ou tie) </TH>  

 <TH>Joueur2</TH></TR>
      ";
        $i = 0;
        $cpt = 0;
        while ($i = mysqli_fetch_assoc($result)) {
            echoDeb2('<BR>lbl3333345 i=' . $i);
            echoDeb2('<BR>lbl3333346 cpt=' . $cpt);
            //print  nl2br("\nparams");
            //    $minn =  $i[ "min"];
            // echo  nl2br("\njour different");
            //  else{
            //echo 'lbl6 poub.php852';


            $nomOVS1 = $i["nam1"];
            $scoreJ1 = $i["scoreJ1"];
            $scoreJ2 = $i["scoreJ2"];
            $isScoreNormal = $i["isScoreNormal"];


            $score2J1 = $i["score2J1"];
            $score2J2 = $i["score2J2"];
            $isScoreNormal2 = $i["isScoreNormal2"];

            $score3J1 = $i["score3J1"];
            $score3J2 = $i["score3J2"];
            $isScoreNormal3 = $i["isScoreNormal3"];
            $nomOVS2 = $i["nam2"];

            $mail1 = $i["mail1"];
            $mail2 = $i["mail2"];
            //	echo "lbl58 nomOVS=$nomOVS";

            switch ($tournoiNo) {
                case 1:
                    echo '<TR>  <TD>' . $nomOVS1 . '</TD> <TD>' . $scoreJ1 . '</TD> <TD>' . $scoreJ2 . '</TD> <TD>' . $isScoreNormal . '</TD> <TD>' . $nomOVS2 . '</TD> </TR>';
                    break; //++++++++
                case 2:
                    echoDeb2('<BR>lbl8524502 case2 mail1=' . $mail1 . ' mail2=' . $mail2);

                    echo '<TR>  <TD>' . $mail1 . '</TD> <TD>' . $scoreJ1 . '</TD> <TD>' . $scoreJ2 . '</TD> <TD>' . $isScoreNormal . '</TD>








 <TD>' . $score2J1 . '</TD> <TD>' . $score2J2 . '</TD> <TD>' . $isScoreNormal2 . '</TD>
 <TD>' . $score3J1 . '</TD> <TD>' . $score3J2 . '</TD> <TD>' . $isScoreNormal3 . '</TD>






 <TD>' . $mail2 . '</TD> </TR>';
                    break; //++++++++
                default:
                    echoDeb('lbl7864001 jamais');
            }
            //	echo "lbl60";

            $i++;
            $cpt++;
        }//fin while
    }//endif
    echoDeb2('<BR> lbl114546 func.MatchEnr2');

    /* free result set */
    //mysqli_free_result($result);//http://php.net/manual/en/mysqli-result.fetch-assoc.php
    echo "</TABLE></DIV>";

    echoDeb2('lbl5188 out');
}

//fffffffffffffffffffffffffffff
function echoDeb2($chn) {
    // echo $chn;
}

//fffffffffffffffffffffffffffff
/**  affichage 
  TODO .par affichTableWhereOrderby()
  .test pr eviter de tt casser à la modif
  ........AFFICHE MAL COMME HADRIEN */
function matchsEnr2poub($tournoiNo) {
    echoDeb2('lbl5187 in');
    switch ($tournoiNo) {
        case 1:
            $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2016`j1, `tennisOVS2016`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id  and secret = null order by datee

    ;"; //!!!backticks sont VITAUX, quotes ne fontionnent pas!!
            echoDeb2('lbl460453 case T1');

            break;
        case 2:
            // $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2Le20160919`j1, `tennisOVS2Le20160919`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id and tournoiNo = " . " 2 " . " and secret = null order by datee ;";
            /* pas besoin de where NI FROMMMMMM car heritage type1, ms la tout est deja dans la table $GLOBALS['query'] = " SELECT j1.`mail` ml1, `scoreJ1`, `scoreJ2`, `isScoreNormal`,            `score2J1`, `score2J2`, `isScoreNormal2`,       `score3J1`, `score3J2`, `isScoreNormal3`      ,j2.`mail` ml2
              FROM `tennisOVS2016matchs` matchh, `tennisOVS2Le20160919` j1, `tennisOVS2Le20160919` j2
              WHERE matchh.mail1 = j1.mail
              AND matchh.mail2 = j2.mail
              AND tournoiNo =2 ;"; */
//           $GLOBALS['query'] = " SELECT `mail1` , `scoreJ1`, `scoreJ2`, `isScoreNormal`,            `score2J1`, `score2J2`, `isScoreNormal2`,       `score3J1`, `score3J2`, `isScoreNormal3`      ,`mail2` 
//FROM `tennisOVS2016matchs` matchh
//WHERE tournoiNo =2 and secret is null order by jourMatch, startHeur, startMin;";
//          
            $reqVars = ["jourMatch", "startHeur", "startMin", "mail1", "scoreJ1", "scoreJ2", "isScoreNormal", "score2J1", "score2J2", "isScoreNormal2", "score3J1", "score3J2", "isScoreNormal3", "mail2"
            ];
            affichTableWhereOrderby($reqVars, "tennisOVS2016matchs", " tournoiNo =2 and secret is null ", " jourMatch, startHeur, startMin ");
            echoDeb3('lbl460457 case T2 quer=' . $GLOBALS['query']);
            break;
        default:
            echo('lbl460463 case default jamais');
            $GLOBALS['query'] = " select  j1.nomOVS nam1, 	 scoreJ1 	, scoreJ2, isScoreNormal, j2.nomOVS nam2 from  `tennisOVS2016matchs` , `tennisOVS2Le20160919`j1, `tennisOVS2Le20160919`j2 where  tennisOVS2016matchs.idJoueur1= j1.id AND tennisOVS2016matchs.idJoueur2 = j2.id and tournoiNo = " . $tournoiNo . " and secret = null order by datee
 
    ;";
    };
}

//fffffffffffffffffffffffffffff
function aleaCreateSafe($bddTabl2, $col) {
    echoDeb3('<BR>bddTabl='.$bddTabl2);
        echoDeb3('<BR>quer AV='.$quer);
    
   $quer = "update " . $bddTabl2 . " set " . $col . " = rand() where " . $col . " is null ";
 //$GLOBALS['query'] = 'INSERT INTO `u386024038_visit`'. ' (`aleaMdP`) VALUES (rand())'; 

    $result = [];
    echoDeb3("<BR>lbl826 query=" .$quer);
    if (mysqli_query($GLOBALS['conn'],$quer)) {
        echoDeb3( 'lbl827 OK request'); 
    } else {
        echoDeb3('<BR>lbl829 KO request'); 
    }
}

//fffffffffffffffffffffffffffff
function aleaCreateForce($bddTabl, $col) {
    
}

//fffffffffffffffffffffffffffff
/** */
function deleteEraseColValues(){

    
}
//
 //fffffffffffffffffffffffffffff
 //

 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff
 //fffffffffffffffffffffffffffff