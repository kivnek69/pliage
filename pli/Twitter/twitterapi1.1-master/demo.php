
		
		  
		  
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
                    
                    
                

                    if(!empty($consumer_key) && !empty($consumer_secret) && !empty($oauth_token) && !empty($oauth_token_secret)) {
                        
                            if(!empty($content)){ foreach($content as $tweet){
                                echo'
								<div class="tweet">
                                <div class="twitter_status">
                                    <div class="bloc_content">
                                        <p class="status tw_status">'.parseTweet($tweet->text).'</p>
                                    </div>
                                    <div class="bloc_caption">
                                        <a href="http://twitter.com/'.$tweet->user->screen_name.'">
                                            <img src="'.$tweet->user->profile_image_url.'" alt="@'.$tweet->user->name.'" class="userimg tw_userimg"/>
                                            <span class="username tw_username">@'.$tweet->user->screen_name.'</span>
                                        </a>
                                        <span class="timestamp tw_timestamp">'.date('d M / H:i',strtotime($tweet->created_at)).'</span>
                                    </div>
								</div>
                                </div>';
                            }}
                                echo'
                            </p>
                            <div class="visualClear"></div>
                        </div>';
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
			
		
		
		  