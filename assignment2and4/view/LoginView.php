<?php

namespace view;

use model\LoginModel;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $loginModel;

	public function __construct(LoginModel $loginModel)
	{
		$this->loginModel = $loginModel;
	}


	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {

		if($this->loginModel->getIsAuthenticated())
		{
			$message =  $this->loginModel->getResponseMessage();
			$response = $this->generateLogoutButtonHTML($message);
		}
		else
		{
			$message = $this->loginModel->getResponseMessage();

			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {

		//Start AutoRefill form from $_POST
		if(isset($_POST[self::$name]))
		{
			$name = $_POST[self::$name];
		}
		else
		{
			$name = "";
		}
		//End AutorRefill form from $_POST

		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $name . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	/**
	 * @return string
     */
	public function getValueOfPostUserName()
	{
		return $_POST[self::$name];
	}

	public function setValueOfPostUserName($name)
	{
		$_POST[self::$name] = $name;
	}

	public function hasCookieName()
	{
		if(isset($_COOKIE[self::$cookieName]))
		{
			return TRUE;
		}
	}

	public function hasCookiePassword()
	{
		if(isset($_COOKIE[self::$cookiePassword]))
		{
			return TRUE;
		}
	}

	/**
	 * @return string
	 */
	public function getValueOfCookieUserName()
	{
		return $_COOKIE[self::$cookieName];
	}

	/**
	 * @return string
	 */
	public function getValueOfCookiePassWord()
	{
		return $_COOKIE[self::$cookiePassword];
	}

	/**
	 * @return string
	 */
	public function getValueOfPostPassword()
	{
		return $_POST[self::$password];
	}

	public function setValueOfPostPassword($password)
	{
		$_POST[self::$password] = $password;
	}

	/**
	 * @return bool
	 */
	public function didEnterUserName()
	{
		if(isset($_POST[self::$name]))
		{
			if($_POST[self::$name] !== "") {
				return true;
			}
		}
		return false;
	}

	/**
	 * @return bool
	 */
	public function didEnterPassword()
	{
		if(isset($_POST[self::$password]))
		{
			if($_POST[self::$password] !== "") {
				return true;
			}
		}
		return false;
	}

	/**
	 * @return bool
	 */
	public function didNotEnterUserName()
	{
		if(isset($_POST[self::$name]))
		{
			if($_POST[self::$name] !== "") {
				return false;
			}
		}
		return true;
	}

	/**
	 * @return bool
	 */
	public function didNotEnterPassword()
	{
		if(isset($_POST[self::$password]))
		{
			if($_POST[self::$password] !== "") {
				return false;
			}
		}
		return true;
	}

	public function didClickLogin()
	{
		if(isset($_POST[self::$login]))
		{
			return TRUE;
		}
	}

	public function didClickLogout()
	{
		if(isset($_POST[self::$logout]))
		{
			return TRUE;
		}
	}

	public function createSessionCookies()
	{
		setcookie(self::$cookieName, 		$this->getValueOfPostUserName(), 	time()+3600);
		setcookie(self::$cookiePassword, 	$this->getValueOfPostPassword(), 	time()+3600);
	}

	public function deleteSessionCookies()
	{
		setcookie(self::$cookieName, 		$this->getValueOfCookieUserName(), 		time()-3600);
		setcookie(self::$cookiePassword, 	$this->getValueOfCookiePassWord(),	 	time()-3600);
	}

	public function deactivateLogoutButton()
	{
		unset($_POST[self::$login]);
	}

	public function didUserMarkKeepMeLoggedIn()
	{
		if(isset($_POST[self::$keep]))
		{
			return TRUE;
		}
	}
}