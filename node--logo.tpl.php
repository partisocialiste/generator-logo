<?php
// $Id$
/**
* @defgroup node Node Templates
* All of the node templates
*/
/**
 * @file node.tpl.php
 * Default node template.
 * @ingroup node
 */
 
 
?>

<script type="text/javascript">
/* LOGO MACHINE */

var pslmselected = -1;

/* Mise à jour de l'image depuis les données du form */
function pslm_preview_update () {
	(function ($) {
		form = $("#pslm_form");
		image = $("#pslm_logo");
		version = $("#pslm_form_version").val();
		text = $("#pslm_form_text").val();
		image.attr('src', encodeURI ( form.attr('action') + '?version=' + version + '&text=' + text ));
	})(jQuery);
}

/* Capte les frappes clavier (up) du input text */
/* Et si != fonctions : update de preview et actu du sugest */
function pslm_stroke(e,hdl) {
	(function ($) {
		if ( e.which != 38 && e.which !=40 && e.which !=13 ) {
			pslm_preview_update();
			pslm_sugest_update(hdl);
		}
	})(jQuery);
}

/* Met à jour le sugest et l'affiche si résultats */
function pslm_sugest_update(hdl) {
	(function ($) {
  	var structures = new Array (
  		<?php $out = array();
  		foreach ( unserialize(file_get_contents("http://api.parti-socialiste.fr/v1/regions.ser")) as $r ) $out[]=$r['name'];
  		foreach ( unserialize(file_get_contents("http://api.parti-socialiste.fr/v1/departements.ser")) as $f ) $out[]=$f['name'];
  		echo '"'.implode('","', $out).'"'; ?>
  	);
  	
  	out = " "; alt = 1; count=0;
  
  	for ( x in structures ) {
  		idx = structures[x].toLowerCase().indexOf(hdl.value.toLowerCase());
  		if ( idx >= 0 ) {
  			name = structures[x].substr(0, idx) + '<strong>' + structures[x].substr(idx, hdl.length) + '</strong>';
  			alt = alt ^ 1;
  			if ( alt == 0 ) {
  				out = out + '<li class="sugestion" onmouseover="pslm_sugest_set('+count+')" onclick="pslm_sugest_go('+count+')">' + name +'</li>';
  			} else {
  				out = out + '<li class="sugestion alt" onmouseover="pslm_sugest_set('+count+')" onclick="pslm_sugest_go('+count+')">' + name +'</li>';
  			}
  			count++;
  		}
  	}
  
  	if ( out.length > 1 ) {
  		box = $("#pslm_sugest");
  		box.width(hdl.offsetWidth);
  		$('#pslm_sugest').html( '<ul>' + out + '</ul>' ).fadeIn();
  	} else {
  		pslm_sugest_hide();
  	}
		})(jQuery);
}

/* Masque le bloc de sugest */
function pslm_sugest_hide() {
	(function ($) {
		$('#pslm_sugest').fadeOut();
	})(jQuery);
}

/* Active l'élement du sugest choisi (n°X) */
function pslm_sugest_set(count) {
	(function ($) {
		$("li.sugestion").removeClass("active").slice(count, count + 1).addClass("active");
		sugestselected = count;
	})(jQuery);
}

/* Execute l'émement du sugest choisi ( n°X) */
function pslm_sugest_go(count) {
	(function ($) {
		thevalue = $(".sugestion").slice(count, count + 1).html().replace(/(<([^>]+)>)/ig,"");
		$("#pslm_form_text").val(thevalue);
		pslm_sugest_hide();
		pslm_preview_update();
	})(jQuery);
}

/* Capte les frapes (down) du clavier */
/* Si UP/DOWN/ENTER => modification ou validation du sugest */
function pslm_sugest_action(e) {
	(function ($) {
		if ($("#pslm_sugest").css({display:'block'})) {
			if ( e.which == 40 ) {
				pslmselected++;
				pslm_sugest_set ( pslmselected );
			} else if ( e.which == 38 ) {
				pslmselected--;
				pslm_sugest_set ( pslmselected );
			} else if ( e.which == 13 ) {
				pslm_sugest_go ( sugestselected );
			}
		}
	})(jQuery);
}
</script>

<section id="presentation" class="arrondi3px">
  <div id="contenu" class="logo">
        <header>
            <h1>Logo et charte du Parti socialiste</h1>
        </header>
        
        <blockquote>
          <p>
              Le parti socialiste met à disposition son logo, sa charte et sa typographie pour que vous puissiez faire campagne.
            </p>
        </blockquote>
        
        <ul class="nav nav-tabs">
            <li class="active"><a href="#logops" data-toggle="tab">Le logo PS</a></li>
            <li><a class="tab" href="#logoerreur" data-toggle="tab">Le logo : les erreurs &agrave; &eacute;viter</a></li>
            <li><a class="tab" href="#generateur" data-toggle="tab">Le générateur de logo</a></li>
            <li><a class="tab" href="#couleur" data-toggle="tab">Les couleurs</a></li>
            <li><a class="tab" href="#jaures" data-toggle="tab">La police de caract&egrave;res &laquo;Jaures&raquo;</a></li>
            <li><a class="tab" href="#papier" data-toggle="tab">La pap&eacute;terie</a></li>
        </ul>
        
        <div class="tab-content">
        <div id="logops" class="tab-pane active">
          <h2>Le logotype du PS</h2>
            
            <div id="telechargement">
              <h3>T&eacute;l&eacute;charger les diff&eacute;rentes versions du logo PS</h3>
                <ul>
                  <li class="titre">Format jpeg</li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/logo/ps.jpg" title="Télécharger le logo carré (jpg)">Logo carré</a></li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/logo/ps-fil-fin.jpg" title="Télécharger le logo avec fil fin (jpg)">Logo avec fil fin</a></li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/logo/ps-fil-large.jpg" title="Télécharger le logo avec fil large (jpg)">Logo avec fil large</a></li>
                </ul>
                
                <ul>
                  <li class="titre">Format png transparent</li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/logo/ps.png" title="#">Logo carré</a></li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/logo/ps-fil-fin.png" title="Télécharger le logo avec fil fin (png)">Logo avec fil fin</a></li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/logo/ps-fil-large.png" title="Télécharger le logo avec fil large (png)">Logo avec fil large</a></li>
                </ul>
                
                <ul>
                  <li class="titre">Kit graphique</li>
                  <li><a href="http://download.parti-socialiste.fr/charte-ps/kit-graphique-ps.zip" title="Télécharger le kit graphique">Tous les logos PS</a></li>
                </ul>
            </div>
            
            <div id="versions">
              <h3>Les différentes versions du logo</h3>
                <blockquote>
                  <p class="titre">Le logo national</p>
                  <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-national.png" alt="Logo national du Parti socialiste" width="330" height="256">
                </blockquote>

                <blockquote>
                  <p class="titre">Les logos locaux</p>
                  <p>Il est recommandé d'utiliser les versions personnalisées pour tous les documents émanant de fédération ou section en utilisant notre générateur de logo.</p>
                  <span>
                    <strong>Le logo de fédération</strong>
                    <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-federation.png" alt="Exemple de logo d'une f&eacute;d&eacute;ration du Parti socialiste" width="165" height="149">
                  </span>
                    
                    <span>
                      <strong>Le logo de section</strong>
                      <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-section.png" alt="Exmeple de logo d'une section du Parti socialiste" width="165" height="149">
                    </span>
                </blockquote>
            </div>
            
            <div id="couleurs-logo">
              <h3>Les différentes couleurs du logo</h3>
                <blockquote>
                  <p class="titre">Le logo en couleur</p>
                  <p>Il est recommandé d'utiliser le plus souvent possible le logo dans sa version couleur.</p>
                  <p><img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-national.png" alt="Logo national du Parti socialiste" width="330" height="256"></p>
                </blockquote>
              
                <blockquote>
                  <p class="titre">Le logo monochrome noir et niveau de gris</p>
                    <p>Il existe 2 versions noires du logo. Il est recommandé de les utiliser pour tous les documents photocopiés.</p>
                  <p>
                      <strong>Niveau de gris</strong>
                        <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-niveau-de-gris.png" alt="Exemple de logo du PS en niveau de gris" width="165" height="134">
                        Cette version est recommandée pour les documents administratifs pouvant être photocopiés (ex : version noir et blanc de la lettre).
                    </p>
                    <p>
                      <strong>Monochrome noir</strong>
                        <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-monochrome-noir.png" alt="Exemple de logo du PS monochrome noir" width="165" height="134">
                        Cette version est recommandée pour les faxs et les marquages objets.
                    </p>
                </blockquote>
                
                <blockquote>
                  <p class="titre">Le logo monochrome rouge et blanc</p>
                    <p>Ces versions du logo en monochrome sont à utiliser exclusivement pour les marquages d'objets.</p>
                  <span>
                      <strong>Monochrome rouge</strong>
                      <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-monochrome-rouge.png" alt="Exemple de logo du PS monochrome rouge" width="165" height="134">
                        à utiliser uniquement sur fond blanc
                    </span>
                    <span>
                      <strong>Monochrome blanc</strong>
                      <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/versions/logo-monochrome-blanc.png" alt="Exemple de logo du PS monochrome blanc" width="165" height="128">
                        à utiliser uniquement sur fond rouge
                    </span>
                </blockquote>
            </div>
        </div>
        
        <div id="generateur" class="tab-pane">
          <h2>Le générateur de logo</h2>
            <form id="pslm_form" action="/tools/logomachine/machine.php" method="get" >
              <fieldset>
                  <legend class="invisible">G&eacute;n&eacute;rateur du logos pour les sections et les f&eacute;d&eacute;rations PS</legend>
                  <p>
                      <label class="invisible">Version du logo</label>
                      <select id="pslm_form_version" name="version" onchange="pslm_preview_update();">
                          <option value="couleur">Couleur</option>
                          <option value="niveaugris">Niveau de gris</option>
                          <option value="mononoir">Monochrome noir</option>
                          <option value="monorouge">Monochrome rouge</option>
                          <option value="monoblanc">Monochrome blanc</option>
                        </select>
                    </p>
                    
                    <p>
                      <label class="invisible">Nom de la section ou de la fédération</label>
                      <input id="pslm_form_text" autocomplete="off" onkeydown="pslm_sugest_action(event);" value="<?php if(isset($_REQUEST['logo_text'])) echo $_REQUEST['logo_text']; ?>" onblur="pslm_sugest_hide();" onkeyup="pslm_stroke(event, this);" name="text" type="text" placeholder="Nom de la section ou de la fédération">
                      <input id="pslm_form_submit" class="special" type="submit" value="Télécharger">
                      
                    </p>
                    <p id="pslm_sugest"></p>
                </fieldset>
            </form>
            
            <div id="apercu">
                <img id="pslm_logo" src="/tools/logomachine/machine.php" width="300" alt="Logo" />
            </div>
        </div>
        
        <div id="couleur" class="tab-pane">
          <h2>Les couleurs PS</h2>
        
          <blockquote>
              <h3>Les couleurs institutionnelles</h3>
              <p>Ces 3 couleurs sont à utiliser pour hierarchiser des textes (Titres, exergues, chapeaux, pour des pictogrammes…).
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/couleurs/couleurs-institutionnelles.png" alt="#" width="330" height="88">
              </p>
            </blockquote>
            
            <blockquote>
              <h3>Les couleurs d'accompagnement</h3>
            <p>
              Une gamme de 4 couleurs a été définie pour segmenter les différentes prises de parole du PS.
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/couleurs/couleurs-accompagnement.png" alt="#" width="330" height="64">
            </p>
            </blockquote>
        </div>
        
        <div id="jaures" class="tab-pane">
          <h2>La police de catact&egrave;res &laquo;Jaures&raquo;</h2>
            
            <p>
              <strong>Le PS dispose d'une police de caractère baptisée Jaurès !</strong>
                <br />
                Elle a été réalisée spécialement pour le PS. Téléchargeable librement, son utilisation est réservée aux documents réalisé par les sections, les fédérations du PS dans le cadre d'un usage militant.
                <br />
                N'hésitez donc pas à l'utiliser largement pour vos tracts, affiches et visuels !
            </p>
            
            <h3>Comment installer la police Jaures ?</h3>
          <ul>
              <li class="titre">Pour Mac</li>
              <li><a href="http://download.parti-socialiste.fr/charte-ps/typo/Typo-Jaures-Mac.zip" title="Télécharger la police Jaures pour Mac">Télécharger Jaures pour Mac (.zip)</a></li>
                <li>
                  <strong>Sous Mac OS X 10.3 ou plus, donc incluant le Livre des polices.</strong>
                  Décompressez le fichier, et double cliquez sur le fichier téléchargé Puis cliquez sur Installer la police en bas de la fenêtre
                </li>
                <li>
                  <strong>Sous n'importe quelle version de Mac OS X.</strong>
                  Copiez les fichiers dans /Library/Fonts, ou bien si vous avez un code pour votre session, dans /Users (ou /Utilisateurs)/Votre_nom_utilisateur/Library (ou Bibliothèque)/Fonts.
                </li>
            </ul>
            <ul>
              <li class="titre">Pour Windows</li>
              <li><a href="http://download.parti-socialiste.fr/charte-ps/typo/Typo-Jaures-Windows.zip" title="Télécharger la police Jaures pour Windows">Télécharger Jaures pour Linux (.zip)</a></li>
                <li>
                  <strong>Pour Windows 7 - Vista</strong>
                    <br />
                    Sélectionnez les fichiers téléchargés et dézippés puis faire clic droit puis installer
                </li>
                <li>
                  <strong>Sous n'importe quelle version de Windows.</strong>
                  <br />
                    Transférez le fichier dans le dossier Fonts, en passant par le menu Démarrer / Panneau de configuration / Apparence et thèmes / Polices
                </li>
            </ul>
            <ul>
              <li class="titre">Pour Linux</li>
              <li><a href="http://download.parti-socialiste.fr/charte-ps/typo/Typo-Jaures-Linux.tgz" title="Télécharger la police Jaures pour Linux">Télécharger Jaures pour Linux (.tgz)</a></li>
              <li>
                  Sélectionnez les fichiers téléchargés et dézippés et transférez les dans fonts:// avec le File manager.
                    <br />
                    <br />
                    Ou bien,dans le dossier racine /home, dans le menu, cliquez sur View / Show hidden files. Vous trouverez le dossier caché .fonts, où vous pourrez copier le dossier. Si le dossier n'existe pas, créez le.
                </li>
            </ul>
        </div>
        
        <div id="papier" class="tab-pane">
          <h2>La papeterie</h2>
            
            <p>
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/papetrie/papeterie1.png" alt="#" width="714" height="367">
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/papetrie/papeterie3.png" alt="#" width="594" height="959">
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/papetrie/papeterie4.png" alt="#" width="593" height="959">
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/papetrie/papeterie5.png" alt="#" width="720" height="344">
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/papetrie/papeterie6.png" alt="#" width="720" height="454">
            </p>
        </div>
        
        <div id="logoerreur" class="tab-pane">
          <h2>Le logo : les erreurs &agrave; &eacute;viter</h2>
          <p>Ces règles s'appliquent au logo générique comme aux logos personnalisés</p>
            
            <blockquote>
              <p class="titre">Utilisation sur fond</p>
              <p>Toute application du logo sur fond de couleur est interdite. Le logo doit toujours être sur fond blanc.</p>
              <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/erreurs/interdits-fonds.png" alt="Exemple d'erreur d'utilisation du logo PS sur fond de couleur" width="330" height="138">
            </blockquote>
            
            <blockquote>
              <p class="titre">Effet sur le logo</p>
              <p>Tout effet sur le logo est interdit.</p>
              <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/erreurs/interdits-effets.png" alt="Exemple d'erreur d'utilisation du logo PS avec des effets" width="330" height="126">
            </blockquote>
            
            <blockquote>
              <p class="titre">Ne pas dissocier les éléments du logo</p>
              <p>(rose, typographie et logo)</p>
              <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/erreurs/interdits-dissocier.png" alt="Exemple d'erreur : la dissociation des éléments du logo PS" width="330" height="269">
            </blockquote>
            
            <blockquote>
              <p class="titre">Ne pas modifier les proportions</p>
              <p>(rose et typographie)</p>
              <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/erreurs/interdits-proportions.png" alt="Exemple d'erreur : la modification des proportions du logo PS" width="330" height="127">
            </blockquote>
        
          <blockquote>
              <p class="titre">Déformation et modification</p>
              <p>Toute déformation et modification du logo est interdite</p>
              <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/erreurs/interdits-couleurs.png" alt="Exemple d'erreur : la modification des couleurs du logo PS" width="330" height="126">
                <img src="/sites/all/themes/partisocialiste/ps-ui/images/charte/logo/erreurs/interdits-deformation.png" alt="Exemple d'erreur : la déformation du logo PS" width="330" height="124">
            </blockquote>
        </div>
        </div>
    </div>
</section><!-- FIN : Logo -->
