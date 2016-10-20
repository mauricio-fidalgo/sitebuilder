<?php

namespace meumobi\sitebuilder\services;

use Gomoob\Pushwoosh\Client\Pushwoosh;
use Gomoob\Pushwoosh\Model\Notification\Android;
use Gomoob\Pushwoosh\Model\Notification\IOS;
use Gomoob\Pushwoosh\Model\Notification\Notification;
use Gomoob\Pushwoosh\Model\Request\CreateMessageRequest;
use meumobi\sitebuilder\validators\ParamsValidator;

class SendPushwooshNotification
{
	const COMPONENT = 'pushnotif_pushwoosh';

	public function perform(array $auth, array $notif)
	{
		list($app, $authToken) = ParamsValidator::validate($options, [
			'app', 'authToken']);

		$client =  Pushwoosh::create()
			->setApplication($app)
			->setAuth($authToken);

		$notification = $this->notification($notif);
		$request = CreateMessageRequest::create()
			->addNotification($notification);

		$response = $client->createMessage($request);

		if ($response->isOk()) {
			return [
				'status_code' => $response->getStatusCode(),
				'status_message' => $response->getStatusMessage()
			];
		} else {
			throw new Exception("Error sending push notification, "
				. "status_code: {$response->getStatusCode()}, "
				. "status_message: {$response->getStatusMessage()}"
			);
		}
	}

	protected function notification(array $options)
	{
		list($header, $content, $banner, $icon, $data, $devices) =
			ParamsValidator::validate($options, [
				'header', 'content', 'banner', 'icon', 'data', 'devices'
			]);

		$android = Android::create()
			->setHeader($header)
			->setBadges('+1');

		$ios = IOS::create()
			->setBadges('+1');

		if ($icon) {
			$android
				->setIcon($icon)
				->setCustomIcon($icon);
		}

		if ($banner) {
			$android->setBanner($banner);
		}

		$notification = Notification::create()
			->setContent($content)
			->setData($data)
			->setIOS($ios)
			->setAndroid($android);

		if ($devices) $notification->setDevices($devices);

		return $notification;
	}

	protected function client($app, $authToken)
	{
		return Pushwoosh::create()
			->setApplication($app)
			->setAuth($authToken);
	}
}