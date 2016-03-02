<?php

namespace meumobi\sitebuilder\services;

use meumobi\sitebuilder\Logger;
use meumobi\sitebuilder\services\PdfThumbnailer;

class MediaThumbnailer
{
	const COMPONENT = 'media_thumbnailer';

	public function perform($item, $medium)
	{
		Logger::info(self::COMPONENT, 'creating medium thumbnail', [
			'item_id' => $item->id(),
		]);

		list($thumbnail, $error) = $this->createThumbnail($medium);

		if ($thumbnail) {
			$medium['thumbnails'] = [ $thumbnail ];

			Logger::info(self::COMPONENT, 'thumbnail created', [
				'item_id' => $item->id(),
				'medium_url' => $medium['url'],
				'thumbnail_url' => $thumbnail['url'],
			]);
		} else {
			Logger::notice(self::COMPONENT, 'thumbnail generation failed', [
				'item_id'  => $item->id(),
				'medium_url' => $medium['url'],
				'type' => $medium['type'],
				'error' => $error,
			]);
		}

		return $medium;
	}

	public function createThumbnail($medium)
	{
		if ($medium['type'] == 'application/pdf') {
			$thumbnail = PdfThumbnailer::perform([
				'url' => $medium['url'],
				'extension' => 'png'
			]);

			return [$thumbnail, null];
		} else {
			$error = sprintf('file type "%s" not supported', $medium['type']);
			return [null, $error];
		}
	}
}
