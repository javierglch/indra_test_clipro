<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$config['base_url'] = 'http://indratest.com.localhost/';

/*
  |--------------------------------------------------------------------------
  | Session Variables
  |--------------------------------------------------------------------------
  |
  | 'sess_driver'
  |
  |	The storage driver to use: files, database, redis, memcached
  |
  | 'sess_cookie_name'
  |
  |	The session cookie name, must contain only [0-9a-z_-] characters
  |
  | 'sess_expiration'
  |
  |	The number of SECONDS you want the session to last.
  |	Setting to 0 (zero) means expire when the browser is closed.
  |
  | 'sess_save_path'
  |
  |	The location to save sessions to, driver dependent.
  |
  |	For the 'files' driver, it's a path to a writable directory.
  |	WARNING: Only absolute paths are supported!
  |
  |	For the 'database' driver, it's a table name.
  |	Please read up the manual for the format with other session drivers.
  |
  |	IMPORTANT: You are REQUIRED to set a valid save path!
  |
  | 'sess_match_ip'
  |
  |	Whether to match the user's IP address when reading the session data.
  |
  |	WARNING: If you're using the database driver, don't forget to update
  |	         your session table's PRIMARY KEY when changing this setting.
  |
  | 'sess_time_to_update'
  |
  |	How many seconds between CI regenerating the session ID.
  |
  | 'sess_regenerate_destroy'
  |
  |	Whether to destroy session data associated with the old session ID
  |	when auto-regenerating the session ID. When set to FALSE, the data
  |	will be later deleted by the garbage collector.
  |
  | Other session cookie settings are shared with the rest of the application,
  | except for 'cookie_prefix' and 'cookie_httponly', which are ignored here.
  |
 */
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'indratest';
$config['sess_expiration'] = 60 * 60 * 24 * 90;
$config['sess_save_path'] = APPPATH . '/cache/session/';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

/*
  |--------------------------------------------------------------------------
  | Cross Site Request Forgery
  |--------------------------------------------------------------------------
  | Enables a CSRF cookie token to be set. When set to TRUE, token will be
  | checked on a submitted form. If you are accepting user data, it is strongly
  | recommended CSRF protection be enabled.
  |
  | 'csrf_token_name' = The token name
  | 'csrf_cookie_name' = The cookie name
  | 'csrf_expire' = The number in seconds the token should expire.
  | 'csrf_regenerate' = Regenerate token on every submission
  | 'csrf_exclude_uris' = Array of URIs which ignore CSRF checks
 */
$config['csrf_protection'] = false;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_indratest';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array(

);
