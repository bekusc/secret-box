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
	        <a id="logo" href="/"></a>
	                        
	        <ul class="menu">                
	            <li class="current-menu-item">
	                <a href="/"><span>Home</span></a>
				</li>
				<li>
	                <a href="/mod">Moderazione</a>
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
				                        <a class="gender-icon" id="form-gender" data-value="1">uomo</a>
				                    </li>
				                    <li>
				                        <a class="gender-icon" id="form-gender" data-value="2">donna</a>
				                    </li>
				                </ul>

								<a class="disabled" id="form-submit">pubblica</a>
							</div>
						</div>

		    		</form>

		    		<div id="error-zone" class="hidden">Controlla di aver compilato correttamente la tua età.</div>

	    		</div>

    		<div id="secret-send-result" class="hidden">
                <span class="round_success">✓</span>
                <h3>Grazie per averci raccontato il tuo segreto!</h3>
                
                <div class="clear"><!-- --></div>
                
                <p class="message">
                    Il tuo segreto è ora in fase di moderazione e se verrà ritenuto idoneo verrà pubblicato nella bacheca di insegreto. Se vuoi 
                    puoi monitorare lo stato del tuo segreto in qualunque momento, tramite la seguente pagina: <a href="http://insegreto.com/monitoraggio/O" id="secret-code-link">monitoraggio segreti</a>.
                </p>
                
                <p class="message">
                	Ti ricordiamo che puoi inviare un messaggio ogni 10 minuti, grazie.
                </p>
				
            </div>
    	</div>

    </header><!-- /secret-form -->

    <section id="main">
    	
    	<div class="wrap">
    		
    		<div class="wide">
    			
    			<div class="secrets-navigation">

	    			<ul class="section-menu">
	                    <li class="current-menu-item">
	                    	<a href="/">Novità</a>
	                	</li>
	                    <li>
	                    	<a href="/hot">Hot</a>
	                	</li>
	                    <li>
	                    	<a href="/popolari">Popolari</a>
	                	</li>
	                    <li>
	                    	<a href="/random">Random</a>
	                	</li>
	                </ul>

	                <?php if (isset($current)): ?>
		                <ul class="pagination pagination-top">
			            	<li>
			                	<a id="page-number"><?= $current ?> di <?= $total ?></a>
			        			<input type="text" id="page-input">
			            	</li>
				            <li class="arrow">
				                <a href="<?= ($current > 1) ? $current - 1 : 1; ?>" class="btn"><i class="fa fa-arrow-left"></i></a>
				            </li>
				            <li class="arrow">
				                <a href="<?= ($total > $current) ? $current + 1 : $current; ?>" class="btn"><i class="fa fa-arrow-right"></i></a>
				            </li>
				        </ul>
					<?php endif ?>
                </div><!-- /nagivation-bar -->
						
    			<div class="secrets-list">
					
					<?php foreach ($articles as $article) : ?>

		    			<article class="secret <?= $article->gender; ?>">
						    <header>
						        <a class="age" href="/seg/<?= $article->stitle; ?>">
						            <span>Uomo di </span> <?= $article->age; ?> <small>anni</small>
						        </a>
						        
						        <ul class="votes" data-title="<?= $article->stitle; ?>">
						            <li class="count"><?= $article->votes; ?></li>
						            <li>
						                <a class="smile smile-like" data-type="1" original-title="Mi piace!"></a>
						            </li>
						            <li>
						                <a class="smile smile-dislike" data-type="2" original-title="Non mi piace!"></a>
						            </li>
						        </ul>
						    </header>
						                            
						    <div class="content">
						        <p><?= $article->content; ?></p>
						    </div>
						                            
						    <footer>
						        <div class="social">
						            <a class="comments" data-title="<?= $article->stitle; ?>"><strong><span class="fb-comments-count" data-href="http://beku.dev:8888/seg/<?= $article->stitle; ?>"></span></strong> commenti</a>
						            <div class="info">
						                <span><?= timeago($article->posted); ?></span> - <a href="#secret-report" class="secret-report">segnala</a>
						            </div>
						        </div>
						        <div class="comments-box" id="comments-<?= $article->stitle; ?>"></div>
						    </footer>
						    
						</article>
					    
					<?php endforeach; ?>

				</div><!-- /secrets-list -->


				<?php if (empty($articles)): ?>
					
					<div class="page-message">
		                <h2>Ouch... questa pagina non contiene segreti...</h2>                     
		                <p>
		                	La pagina che hai scelto non contiene nessun segreto.<br>
							Perchè non provi a cambiare numero di pagina, sezione oppure a cercare nel sito tramite il box di ricerca ?
		                </p>        
					</div>
				
				<?php endif ?>

				<?php if (isset($query)): ?>
				
					<div class="page-message">
						<h3>Stai cercando segreti che contengono "sa"</h3>
					</div>
				
				<?php endif; ?>

			    <?php if (isset($current, $total)): ?>
					
					<div class="secrets-navigation position-bottom">

						<ul class="pagination">
			            	<li>
			                	<a id="page-number"><?= $current ?> di <?= $total ?></a>
			        			<input type="text" id="page-input">
			            	</li>
				            <li class="arrow">
				                <a href="<?= ($current > 1) ? $current - 1 : 1; ?>" class="btn"><i class="fa fa-arrow-left"></i></a>
				            </li>
				            <li class="arrow">
				                <a href="<?= ($total > $current) ? $current + 1 : $current; ?>" class="btn"><i class="fa fa-arrow-right"></i></a>
				            </li>
				        </ul>

				    </div><!-- /bottom-pagination -->

				<?php endif ?>

    		</div><!-- /left-side -->
    		
    		<aside class="side">
    			<a id="moderation-widget" href="/mod">
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
			                        <a class="gender-icon" id="search-gender" data-value="1">uomo</a>
			                    </li>
			                    <li>
			                        <a class="gender-icon" id="search-gender" data-value="2">donna</a>
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
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script>var query = "<?= (isset($query)) ? $query : '' ?>";</script>
	<script src="/js/script.js"></script>
</body>

</html>