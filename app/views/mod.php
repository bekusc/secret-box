<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Insegreto</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
 	<nav id="top-bar">
		<div class="wrap">

	        <a id="publish-btn">
	            <i class="fa fa-pencil-square-o"></i>
	        </a>
	        <a id="logo" href="#"></a>
	                        
	        <ul class="menu">                
	            <li>
	                <a href="/insegreto">Home</a>
				</li>
				<li class="current-menu-item">
	                <a href="mod.html"><span>Moderazione</span></a>
				</li>
				<li>
	                <a href="users/top-50">Utenti</a>
				</li>

			</ul>

        </div>
    </nav> <!-- /top-bar -->

    <header class="secret-box hidden">

    	<div class="wrap">
    		<div id="tell-your-secret">

	    		<h2 id="form-title">Benvenuto, vuoi raccontarci il tuo segreto ?</h2>
	    		
	    		<form method="post">
	    			
	    			<div id="form-secret-box">
		    			<div id="secret-counter" data-max="500" data-min="40">500</div>
		    			<div id="form-message-box">
		                    <textarea id="form-message" name="form-message" placeholder="Scrivi qualcosa..."></textarea>
		                </div>
		                
		                <div id="form-info">
			                <input type="text" name="age" id="age" placeholder="età">

							<ul id="gender-picker">
			                    <li>
			                        <a class="gender-icon" id="form-gender" data-value="uomo">uomo</a>
			                    </li>
			                    <li>
			                        <a class="gender-icon" id="form-gender" data-value="donna">donna</a>
			                    </li>
			                </ul>

							<a class="disabled" id="form-submit">pubblica</a>
						</div>
					</div>

	    		</form>

    		</div>
    	</div>

    </header><!-- /secret-form -->

    <header class="hero-header text">
        <div class="wrap">
            <h2>Benvenuto nell'area di moderazione</h2>

            <p>Di seguito ti verranno mostrati uno alla volta i segreti che sono in attesa di essere pubblicati sul sito. Il tuo compito è quello di decidere se il messaggio inviato è un segreto oppure no.
            Non importa quanto sia divertente o quanto tu sia d'accordo con ciò che è stato scritto, la regola principale è una sola: <strong>è un segreto oppure no</strong>.</p>
        </div>
    </header>

    <section id="main" class="mod">
    	
    	<div class="wrap">
    		
    		<div class="wide">
    			
    			<div class="secrets-navigation">
	    			<ul class="section-menu">
	                    <li class="current-menu-item">
	                    	<a href="mod.html">Moderazione</a>
	                	</li>
	                </ul>
                </div><!-- /nagivation-bar -->

    			<div class="secrets-list">

	    			<article class="secret male">
					    <header>
					        <a class="age" href="http://insegreto.it/seg/cRdc">
					            <span>Uomo di </span> 17 <small>anni</small>
					        </a>
					    </header>

					    <div class="content">
					        <p>nella mia camera ho un peluche che tengo sin da piccolo. mia mamma mi domanda sempre come mai lo voglia tenere, ma non sa che ogni sera prima di addormentarmi simulo un rapporto con il peluche e gli vengo pure addosso. credo di avere dei seri problemi</p>
					    </div>
					                            
					    <footer>
					        <div class="moderation" data-id="1185842">
							    <a href="#" class="btn error">Non è un segreto</a>
							    <a href="#" class="btn success">É un segreto</a>

							    <div class="mod-bar">
							        <div class="like" style="width: 26.153846153846%;"></div>
							        <div class="dislike" style="width: 73.846153846154%;"></div>
							    </div>
							</div>
					    </footer>
					    
					</article>

					<article class="secret">
						<div class="collapsed-message">
						    I messaggi che stai leggendo non sono ancora stati pubblicati<br>
						    Ricordati che devi approvare solamente i segreti, mentre il resto deve essere scartato.<br>
						    Scegli segreti che risultino interessanti e che siano scritti bene.<br>
						    Il tuo compito come moderatore è importantissimo, cerca di seguire i piccoli consigli riportati qui sopra e vedrai che farai un ottimo lavoro.
						</div>
					</article>

				</div><!-- /secrets-list -->

    		</div><!-- /left-side -->
    		
    		<aside class="side">
    			<a id="moderation-widget" href="mod.html">
        			<font><font>Become moderator!</font></font>
    			</a>

    			<div class="widget" id="search-widget">
			        <div class="widget-title">Cerca nel sito</div>
			        
			        <form id="search-form">
			            
			            <div class="field text-field">
			                <input type="text" name="query" placeholder="parole da cercare" id="search-query">
			                <span id="search-icon"></span>
			            </div>
			            
			            <div class="field">
			                <input type="text" name="age" placeholder="età" id="age">
			                
			                <ul id="gender-picker">
			                    <li>
			                        <a class="gender-icon" id="search-gender" data-value="uomo">uomo</a>
			                    </li>
			                    <li>
			                        <a class="gender-icon" id="search-gender" data-value="donna">donna</a>
			                    </li>
			                </ul>
			                
			                <input type="hidden" name="gender" value="" id="search-gender">
			                
			                <a id="search-submit" href="#">cerca</a>
			            </div>
			            
			        </form>
			    </div><!-- /search -->
    		</aside><!-- /right-side -->
            <div class="clear"></div>
    	
    	</div>
    	
    </section>

	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="js/script.js"></script>
</body>

</html>