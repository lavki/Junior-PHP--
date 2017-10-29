<?php

namespace core;

class Database
{
	protected $db;

	public function __construct()
	{
		require_once './core/db_connect.php';

		$this->db = $dbh;
	}
}