<?php

namespace meumobi\sitebuilder;

use Sites; // TODO
use Model; // TODO

class Site
{
	protected $attr;

	public static function findByDomain($domain)
	{
		// TODO
		$site = Model::load('Sites')->firstByDomain($domain);
		return new static($site->data);
	}

	public function __construct($attr = array())
	{
		$this->attr = $attr;
	}

	public function __get($attr)
	{
		return $this->attr[$attr];
	}

	public function categories($scope = null)
	{
		return Category::findBySite($this->attr['id'], $scope);
	}

	public function findCategory($categoryId)
	{
		$scope = (object) array('site' => $this->attr['id']);
		return Category::find($categoryId, $scope);
	}

	public function buildCategory($attr = array())
	{
		$attr['site_id'] = $this->attr['id'];
		return new Category($attr);
	}

	public function extensions($scope = null)
	{
		return Extension::findBySite($this->attr['id'], $scope);
	}

	public function findExtension($extensionId)
	{
		$scope = (object) array('site' => $this->attr['id']);
		return Extension::find($extensionId, $scope);
	}

	public function buildExtension($attr = array())
	{
		$attr['site_id'] = $this->attr['id'];
		return new Extension($attr);
	}
}