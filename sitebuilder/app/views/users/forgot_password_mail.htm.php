<p>
	<?= s('Hi, <b>%s</b>. <br/><br/>You have requested the reset of your MeuMobi password. In order to do that you should click on link below.', $user->firstname()) ?>
</p>
<br /><br />
<p>
	<?= $this->html->link(s('Click here to reset your password'), "/users/reset_password/{$user->id}/{$user->token}", [], true) ?>
</p>
