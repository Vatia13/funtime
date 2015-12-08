<?php
/*
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
*/

set_time_limit(0);
class timer
{
	private $start_time;

	private function get_time()
	{
		list($usec, $seconds) = explode(" ", microtime());
		return ((float)$usec + (float)$seconds);
	}
	
	function start_timer()
	{
		$this->start_time = $this->get_time();
	}
	
	function end_timer()
	{
		return ($this->get_time() - $this->start_time);
	}
}
