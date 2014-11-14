<?php

namespace meumobi\sitebuilder\entities;

class VisitorDevice
{
	protected $id;
	protected $model;

	public function __construct(array $attrs = [])
	{
		$this->setAttributes($attrs);
	}

	public function setAttributes(array $attrs)
	{
		foreach ($attrs as $key => $value) {
			$key = \Inflector::camelize($key, false);
			$method = 'set' . \Inflector::camelize($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			} else if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
	}

	public function id()
	{
		return $this->id;
	}

	public function model()
	{
		return $this->model;
	}
}
