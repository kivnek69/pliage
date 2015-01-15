<html> 
    <title> Tumblr </title>
    
    <body> 
	
	<?php 
		include_once('lib/Tumblr/API/Client.php');
	/*
		$consumerKey = 'tOM1qDsJXocch6wYDGWWxXUA4Ag2Q2NQH4j7WQ7KrltjDTgu5S';
		$consumerSecret= 'JcHJL6MVOmpcrV5Py3xR6cvrq4sAFQmNU2LRCs1KEEXWLlUNLK';
		$token= 'uPiIEEorNJXTia0a0BZyXHOwqkzJvoroVLEdFxOpbqPc5S36BW';
		$tokenSecret= '7c4GOy4etMUwaul67fEl9OIJjwvgOVyrCcRJEpq2A2fY7pkr28';
*/
		$client = new Tumblr\API\Client('tOM1qDsJXocch6wYDGWWxXUA4Ag2Q2NQH4j7WQ7KrltjDTgu5S');
		$client->setToken($token, $tokenSecret);
		
		
		foreach ($client->getUserInfo()->user->blogs as $blog) {
			echo $blog->name . "\n";
		}
		/*
		 * User Methods
		 */
		
		
		$client->getUserInfo();

		$client->getDashboardPosts($options = null);
		$client->getLikedPosts($options = null);
		$client->getFollowedBlogs($options = null);

		$client->follow($blogName);
		$client->unfollow($blogName);

		$client->like($postId, $reblogKey);
		$client->unlike($postId, $reblogKey);
		
		/*
		 * Blog Method
		 */
		
		$client->getBlogInfo($blogName);

		$client->getBlogAvatar($blogName, $size = null);

		$client->getBlogPosts($blogName, $options = null);
		$client->getBlogLikes($blogName, $options = null);
		$client->getBlogFollowers($blogName, $options = null);

		$client->getQueuedPosts($blogName, $options = null);
		$client->getDraftPosts($blogName, $options = null);
		$client->getSubmissionPosts($blogName, $options = null);
		
		/*
		 * Post Methods
		 */
		
		
		$client->createPost($blogName, $data);
		$client->editPost($blogName, $id, $data);
		$client->deletePost($blogName, $id, $reblogKey);
		$client->reblogPost($blogName, $id, $reblogKey, $options = null);
		
		
		/*
		 * Tagged Methods
		 */
		
		$client->getTaggedPosts($tag, $options = null);
		
	?>
        
    </body>
</html>    

  



