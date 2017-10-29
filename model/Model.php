<?php

namespace model;

use \core\ Database;

class Model extends Database
{
	public function getIdent( string $ident )
	{
		$sql = "SELECT `ident` FROM `data` WHERE `ident` = :ident ORDER BY `ident`";

		$stm = $this->db->prepare($sql);
		$stm->bindValue( ':ident', $ident, \PDO::PARAM_STR );
		$stm->execute();

		return $stm->fetchAll();
	}

	public function getVersion( string $ident, int $version )
	{
		$sql = "SELECT * FROM `data` WHERE `ident` = :ident AND `version` > :version ORDER BY `ident`";

		$stm = $this->db->prepare($sql);
		$stm->bindValue( ':ident',   $ident,   \PDO::PARAM_STR );
		$stm->bindValue( ':version', $version, \PDO::PARAM_STR );
		$stm->execute();

		return $stm->fetchAll();
	}

	public function getNotRequest( array $ident )
	{
		$sql = $this->createQuery('ident', '!=', $ident);
		$stm = $this->db->prepare($sql);
		$stm->execute();

		return $stm->fetchAll();
	}

	public function createQuery( string $field, string $icon, array $value, string $operotor = 'AND' )
	{
		$str = '';

		for( $i = 0; $i < count($value); ++$i )
		{
			$str .= "`{$field}` {$icon} '{$value[$i]}' ";
			
			if( $i < count($value) - 1 )
			{
				$str .= "{$operotor} ";
			}
		}

		return "SELECT * FROM `data` WHERE {$str} ORDER BY `ident`";
	}
}