<?php
load()->func('communication');
if (empty($_SESSION['role'])){
	define('FX_MERCHANTID', '');
	define('FX_ID', '');
	define('MERCHANTID', 0);	
}