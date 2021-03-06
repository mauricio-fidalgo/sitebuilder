<?php

namespace app\controllers\api;

require_once 'lib/mailer/Mailer.php';

use Mailer;
use Config;
use I18n;

class MailController extends ApiController
{
	protected $skipBeforeFilter = ['requireVisitorAuth'];

	public function index()
	{
		$this->requireUserAuth();

		if (!$this->request->get('data:name') ||
			!$this->request->get('data:mail') ||
			!$this->request->get('data:message')) {
			throw new InvalidArgumentException('missing parameters');
		}

		$site = $this->site();
		I18n::locale($site->language);
		$subject = s('api_mail_contact', $site->title);
		$response = [];
		$segment = \MeuMobi::currentSegment();
		$mailer = new Mailer(array(
			'from' => $segment->email,
			'to' => array($site->email => $site->title),
			'subject' => $subject,
			'views' => array('text/html' => 'sites/contact_mail.htm'),
			'layout' => 'mail',
			'data' => array(
				'site' => $site,
				'segment' => $segment,
				'name' => $this->request->get('data:name'),
				'mail' => $this->request->get('data:mail'),
				'phone' => $this->request->get('data:phone'),
				'message' => $this->request->get('data:message'),
			)
		));
		$mailer->send();
		$response['success'] = true;
		return $response;
	}

	protected function requireUserAuth()
	{
		if (\Config::read('Api.ignoreAuth')) return;

		$token = $this->request->env('HTTP_X_AUTHENTICATION_TOKEN');

		if ($token != '9456bbf53af6fdf30a5d625ebf155b4018c8b0aephp') {
			throw new ForbiddenException();
		}
	}
}
