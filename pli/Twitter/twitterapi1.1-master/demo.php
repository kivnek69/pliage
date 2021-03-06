<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="fr"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Intégration API Twitter 1.1 | NOE interactive</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<meta name='robots' content='noindex,nofollow' />
<link rel='stylesheet' id='demo-css'  href='css/twitterapi.css' type='text/css' media='all' />

<meta name="description" content="How to use the latest Twitter 1.1 API, by NOE Interactive, by NOE Interactive" />
<meta name="keywords" content="Twitter, oAuth, NOE Interactive, php" />
<link rel="canonical" href="http://noe-interactive.com/demo/!/twitterapi"/>
</head>

<body class="page lang-fr">
		
		  
		  
                <?php
				
                    //1 - Settings (please update to math your own)
                    $consumer_key='3FhMfyyBiWRErK01r1YQVOWIS'; //Provide your application consumer key
                    $consumer_secret='JlKHJiOtRf6E5ozfzPCUfauepYC7gegbo0Zu2Ytj7hIOUkGrmn'; //Provide your application consumer secret
                    $oauth_token = '2978062462-ScTEgyxTKoiyqsQGOeFiiF6rtLhLOLZ2bZp3v8H'; //Provide your oAuth Token
                    $oauth_token_secret = 'gg9Xx5wPN24spqwlEW1lEHi8Hc6LgAzI54eJlqvJFJN3P'; //Provide your oAuth Token Secret
					  
                    //You can now copy paste the folowing

                    if(!empty($consumer_key) && !empty($consumer_secret) && !empty($oauth_token) && !empty($oauth_token_secret)) {

                    //2 - Include @abraham's PHP twitteroauth Library
                    require_once('twitteroauth/twitteroauth.php');

                    //3 - Authentication
                    /* Create a TwitterOauth object with consumer/user tokens. */
                    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);

                    //4 - Start Querying
                    $query = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=c_hebdo'; //Your Twitter API query
                                      
                    $content = $connection->get($query);  
				
                    }
                    
                    
					
				echo '<div style="width:200px; height:200px; display:inline-block;">';
                    if(!empty($consumer_key) && !empty($consumer_secret) && !empty($oauth_token) && !empty($oauth_token_secret)) {
                       
                            if(!empty($content)){ foreach($content as $tweet){
                                echo '
							
								<a class="tooltip" title="'.($tweet->text).'" > 
									<div class="twitter_status">                                       
										<span class="timestamp tw_timestamp" style="display: none;">'.date('d M / H:i',strtotime($tweet->created_at)).'</span>
								   </div>                               
								</a>';
							
								}}
									echo'
								</p>
								<div class="visualClear"></div>';
						} else {
							echo'<p>Please update your settings to provide valid credentials</p>';
						}
                echo '</div>';

/*
 * Transform Tweet plain text into clickable text
 */
function parseTweet($text) {
    $text = preg_replace('#http://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text); //Link
    $text = preg_replace('#@([a-z0-9_]+)#i', '@<a  target="_blank" href="http://twitter.com/$1">$1</a>', $text); //usernames
    $text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a target="_blank" href="http://search.twitter.com/search?q=%23$1">$1</a>', $text); //Hashtags
    $text = preg_replace('#https://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text); //Links
    return $text;
}
 
                ?>
			
		
		
		  
				
            </section>
        </div>
    </article>
</section>
	</div><!-- #main -->

	<div class="visualClear"></div>

 </div><!-- #wrapper -->

</body>
</html>