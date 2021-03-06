<?php

namespace meumobi\sitebuilder\entities;

use lithium\util\Inflector;

use MongoId;
use FileUpload;

class Skin extends Entity
{
	protected $themeId;
	protected $parentId;
	protected $mainColor;
	protected $assets = array();
	protected $uploadedAssets = array();
	protected $colors = array();
	protected $html5;
	protected $tokens = array();
	protected $layoutAlternatives = array();

	public function themeId()
	{
		return $this->themeId;
	}

	public function parentId()
	{
		return $this->parentId;
	}

	public function mainColor()
	{
		return $this->mainColor;
	}

	public function colors()
	{
		return $this->colors;
	}

	public function assets()
	{
		return $this->assets;
	}

	public function html5()
	{
		return $this->html5;
	}

	public function uploadedAssets()
	{
		return $this->uploadedAssets;
	}

	public function setAsset($asset, $value)
	{
		$this->assets[$asset] = $value;
	}

	public function tokens() {
			return $this->tokens;
	}

	public function layoutAlternatives() {
			return $this->layoutAlternatives;
	}

	public function setUploadedAssets($file)
	{
		$files = array();

		foreach ($file as $key => $assets) {
			foreach ($assets as $asset => $value) {
				$files[$asset][$key] = $value;
			}
		}

		$this->uploadedAssets = array_filter($files, function($asset) {
			if ($asset['error']) return false;
			list($valid, $errors) = FileUpload::validate($asset, null, ['png',
				'jpeg', 'jpg', 'gif']);
			return $valid;
		});
	}
}
