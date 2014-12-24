<?php 
class TwitterAuth
{
	protected $client;
	protected $clientCallback = 'http://local.dev/TwitterAuth/callback.php';
	protected $pdo;
	public $data = [];

	public function __construct(\Codebird\Codebird $client)
	{
		$this->client = $client;
		$this->pdo = new PDO('mysql:host=localhost;dbname=twitter_auth', 'root', '');
	}
	public function getAuthUrl()
	{
		$this->requestTokens();
		$this->verifyTokens();

		return $this->client->oauth_authenticate();
	}

	public function requestTokens()
	{
		$reply = $this->client->oauth_requestToken([
			'oauth_callback' => $this->clientCallback
		]);
		$this->storeTokens($reply->oauth_token, $reply->oauth_token_secret);
	}

	public function storeTokens($token, $tokenSecret)
	{
		$_SESSION['oauth_token'] = $token;
		$_SESSION['oauth_token_secret'] = $tokenSecret;
	}

	public function verifyTokens()
	{
		$this->client->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	}

	public function signedIn(){
		if(isset($_SESSION['user_id']))
			return true;
	}

	public function signOut(){
		unset($_SESSION['user_id']);
	}

	public function signIn(){
		if($this->hasCallback())
		{
			$this->verifyTokens();
			$reply = $this->client->oauth_accessToken([
				'oauth_verifier' => $_GET['oauth_verifier']
			]);
			if($reply->httpstatus === 200)
			{
				$this->storeTokens($reply->oauth_token, $reply->oauth_token_secret);
				$_SESSION['user_id'] = $reply->user_id;
				$this->storeUser($reply);
				array_push($data, $reply);
				return true;
			}
			return true;
		}
		return false;
	}

	public function hasCallback(){
		return isset($_GET['oauth_verifier']);
	}

	public function storeUser($reply)
	{
		$store = $this->pdo->prepare("
			INSERT INTO users (twitter_id, twitter_username)
			VALUES (:user_id, :username)
			ON DUPLICATE KEY UPDATE twitter_id = :user_id
		");
		$store->execute([
		'user_id' => $reply->user_id,
		'username' => $reply->screen_name
		]);

	}

	 
	 
} 
?>