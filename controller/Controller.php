<?php

namespace controller;

class Controller
{
	private $query    = [];	// GET Query
	private $display  = []; // Result Array (delete, update and new)
	private $model;			// Model of table "Data"

	public function __construct( array $query )
	{
		if( empty($query)) exit('GET query is empty');

		$this->query = $query;
		$this->model = new \model\ Model();
	}

	public function index()
	{
		// if isset query but not isset in database
		$this->setDelete( $this->query['ident'] );

		// if query version is less then version in database
		$this->setUpdate( ['ident' => $this->query['ident'], 'version' => $this->query['version']] );

		// if not isset in query but isset in database
		$this->setNew( $this->query['ident'] );

		return $this->getDisplay();
	}

	private function setDelete( array $ident )
	{
		$this->display['delete'] = [];

		foreach ($ident as $key => $value)
		{
			if( !$this->model->getIdent($value) )
			{
				$this->display['delete'][] = $value;	
			}
		}
	}

	private function setUpdate( array $data )
	{
		$this->display['update'] = [];

		for( $a = 0, $b = 0; $a < count($data['ident']), $b < count($data['version']); $a++, $b++ )
		{
			if( !isset($data['ident'][$a]) || !isset($data['version'][$b]))
			{
				exit('GET query is not correct!');
			}

			if( $result = $this->model->getVersion($data['ident'][$a], $data['version'][$b]) )
			{
				$this->setDisplay($result, 'update');
			}
		}
	}

	private function setNew( array $ident )
	{
		$this->display['new'] = [];
		
		$result = $this->model->getNotRequest($ident);

		if( !empty($result) )
		{
			$this->setDisplay($result, 'new');
		}
	}

	private function setDisplay( array $result, string $key )
	{
		foreach( $result as $item )
		{
			$this->display[$key][$item['ident']] = [
				'value'   => $item['value'],
				'version' => $item['version'],
			];
		}
	}

	public function getDisplay()
	{
		return $this->display;
	}
}