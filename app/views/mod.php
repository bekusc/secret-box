<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Insegreto</title>
	<link rel="stylesheet" href="/css/style.css">
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
	                <a href="/">Home</a>
				</li>
				<li class="current-menu-item">
	                <a href="/mod"><span>Moderazione</span></a>
				</li>
				<li>
	                <a href="/users/top-50">Utenti</a>
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
	                    	<a href="/mod">Moderazione</a>
	                	</li>
	                </ul>
                </div><!-- /nagivation-bar -->

    			<div class="secrets-list">
					
					<?php if (!$article): ?>
					
						<div class="page-message">
			                <h2>Ouch... questa pagina non contiene segreti...</h2>                     
			                <p>
			                	La pagina che hai scelto non contiene nessun segreto.<br>
								Perchè non provi a cambiare numero di pagina, sezione oppure a cercare nel sito tramite il box di ricerca ?
			                </p>
						</div>
					
					<?php else: ?>

    	    			<article class="secret <?= $article->gender; ?>">
    					    <header>
    					        <a class="age" href="/seg/<?= $article->stitle; ?>">
    					            <span>Uomo di </span> <?= $article->age; ?> <small>anni</small>
    					        </a>
    					    </header>

    					    <div class="content">
    					        <p><?= $article->content; ?></p>
    					    </div>
    					                            
    					    <footer>
    					        <div class="moderation" data-title="<?= $article->stitle; ?>">
    							    <a href="#" class="mod btn error" data-type="1">Non è un segreto</a>
    							    <a href="#" class="mod btn success" data-type="2">É un segreto</a>

    							    <div class="mod-bar">
    							        <div class="like" style="width: <?= $article->validity / ($article->validity + $article->invalidity) * 100; ?>%;"></div>
    							        <div class="dislike" style="width: <?= $article->invalidity / ($article->validity + $article->invalidity) * 100; ?>%;"></div>
    							    </div>
    							</div>
    					    </footer>
    					    
    					</article>

					<?php endif; ?>

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
	<script src="/js/script.js"></script>
</body>

</html>