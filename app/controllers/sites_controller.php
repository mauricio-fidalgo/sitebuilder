<?php

class SitesController extends AppController {
	public function register() {
		$this->editRecord('/sites/customize_register', false);
	}

	public function add() {
		Model::load('users');
		if (Users::ROLE_USER == $this->getCurrentSite()->role) {
			$this->redirect('/');
			return;
		}
		
		$site = Model::load('Sites');
		if(!empty($this->data)) {
			$site->segment = MeuMobi::segment();
			$site->updateAttributes($this->request->data);
			if($site->validate() && $site->save()) {
				//Session::writeFlash('success', s('Configuration successfully saved.'));
				Session::write('Users.registering', '/sites/customize_register');
				$this->redirect('/sites/customize_register');
				return;
			}
		}
		
		$this->set(array(
				'site' => $site,
				'countries' => Model::load('Countries')->toList(array(
						'order' => 'name ASC'
				)),
				'states' => array(),
		));
	}

	public function edit() {
		$this->editRecord('/sites/edit');
	}
	
	public function remove($id = null) {
		if ($id) {
			$site = Model::load('Sites')->firstById($id);
		} else {
			$site = $this->getCurrentSite();
		}
		try {
			if ($site->userRole() == Users::ROLE_ADMIN) {
				$sucess = $site->delete($site->id);
			} else {
				$sucess = $site->removeUser(Auth::User()->id());
			}
		} catch (Exception $e) {
			$sucess = false;
		}
		
		if ($sucess) {
			Session::writeFlash('success', s('Site was successfully removed'));
		} else {
			Session::writeFlash('error', s('Sorry, can\'t remove site'));
		}
		$this->redirect('/');
	}

	public function customize_edit() {
		$this->customizeSite(s('Configuration successfully saved.'), '/sites/customize_edit');
	}

	public function customize_register() {
		$this->customizeSite(s('Configuration successfully saved.'), '/sites/finished');
	}
	
	public function finished() {
		$this->set(array(
			'site' => $this->getCurrentSite()
		));
	}
	
	public function verify_slug($slug = null) {
		$this->respondToJSON(array(
			'unique' => !$this->Sites->exists(array(
				'slug' => $slug
			))
		));
	}
	
	public function users() {
		Model::load('Users');
		if (Users::ROLE_ADMIN != $this->getCurrentSite()->role) {
			$this->redirect('/');
			return;
		}
		$users = $this->getCurrentSite()->users(true);
		$this->set(compact('users'));
	}
	
	public function remove_user($userId) {
		if ($this->getCurrentSite()->removeUser((int)$userId)) {
			Session::writeFlash('success', s('User successfully removed.'));
		} else {
			Session::writeFlash('error', s('Sorry, can\'t remove user.'));
		}
		$this->redirect('/sites/users');
	}
	
	protected function editRecord($redirect_to, $allowMessage = true) {
		$site = $this->getCurrentSite();
		if(!empty($this->data)) {
			$site->updateAttributes($this->request->data);
			if($site->validate()) {
				$site->save();
				if ($allowMessage) {
					Session::writeFlash('success', s('Configuration successfully saved.'));
				}
				if($redirect_to == '/sites/customize_register') {
					Session::write('Users.registering', '/sites/customize_register');
				}
				$this->redirect($redirect_to);
			}
		}

		if($site->state_id) {
			$states = Model::load('States')->toListByCountryId($site->country_id, array(
				'order' => 'name ASC'
			));
		}
		else {
			$states = array();
		}

		$this->set(array(
			'site' => $site,
			'countries' => Model::load('Countries')->toList(array(
				'order' => 'name ASC'
			)),
			'states' => $states
		));
	}

	protected function customizeSite($message, $redirect_to) {
		$site = $this->getCurrentSite();
		if(!empty($this->data)) {
			$site->updateAttributes($this->data);
			if($site->validate()) {
				$site->save();
				Session::writeFlash('success', $message);
				if($redirect_to == '/sites/finished') {
					Session::delete('Users.registering');
				}
				$this->redirect($redirect_to);
			}
		}

		$this->set(array(
			'site' => $site,
			'themes' => Model::load('Themes')->all()
		));
	}
}
