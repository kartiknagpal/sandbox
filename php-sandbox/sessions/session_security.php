<?php
session_start();
/*
* It’s possible to use packet sniffing (sampling of data) to discover
* session IDs passing across a network. Additionally, if the session ID is passed in the
* GET part of a URL, it might appear in external site server logs. The only truly secure way
* of preventing these from being discovered is to implement a Secure Sockets Layer (SSL)
* and run HTTPS instead of HTTP web pages.
* Preventing session hijacking:
* When SSL is not a possibility, you can further authenticate users by storing their IP
* address along with their other details.
*/
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) different_user();

/*
* Of course, you need to be aware that users on the same proxy server, or sharing the
* same IP address on a home or business network, will have the same IP address. Again,
* if this is a problem for you, use SSL. You can also store a copy of the browser’s user
* agent string (a string that developers put in their browsers to identify them by type and
* version), which, due to the wide variety of browser types, versions, and computer platforms,
* might help to distinguish users.
*/
$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
if ($_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT']) different_user();

/*
* Or, better still, combine the two checks like this and save the combination as an md5
* hexadecimal string:
*/
$_SESSION['check'] = md5($_SERVER['REMOTE_ADDR'] .
$_SERVER['HTTP_USER_AGENT']);
if ($_SESSION['check'] != md5($_SERVER['REMOTE_ADDR'] .
$_SERVER['HTTP_USER_AGENT'])) different_user();

/*
* Preventing session fixation:
* Session fixation happens when a malicious user tries to present a session ID to the server
* rather than letting the server create one. It can happen when a user takes advantage of
* the ability to pass a session ID in the GET part of a URL, like this:
* http://yourserver.com/authenticate.php?PHPSESSID=123456789
* To prevent this, you can use the function session_regenerate_id to change the session
* ID. This function keeps all current session variable values, but replaces the session ID
* with a new one that an attacker cannot know.
* Now, when you receive a request, you can check for a special session variable that you
* arbitrarily invent. If it doesn’t exist, you know that this is a new session, so you simply
* change the session ID and set the special session variable to note the change.
*/
if (!isset($_SESSION['initiated']))
{
session_regenerate_id();
$_SESSION['initiated'] = 1;
}

/*
* Forcing cookie-only sessions
* If you are prepared to require your users to enable cookies on your website, you can
* use the ini_set function like this:
*/
ini_set('session.use_only_cookies', 1);
ini_set('session.save_path', '/home/user/myaccount/sessions');
?>