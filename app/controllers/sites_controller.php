<?php

class SitesController extends AppController {
    public function index() {
        $this->set('results', $this->Sites->all());
    }
    
    public function add() {
        if(!empty($this->data)) {
            if($this->Sites->validate($this->data)) {
                $this->Sites->save($this->data);
                $this->redirect('/sites');
            }
            else {
                die(__('Erro de Validação'));
                // TODO http://ipanemax.goplanapp.com/msb/ticket/view/8
            }
        }
        else {
            $this->set(array(
                'segments' => $this->getSegments()
            ));
        }
    }
    
    public function edit($id = null) {
        if(!empty($this->data)) {
            $this->Sites->id = $id;
            if($this->Sites->validate($this->data)) {
                $this->Sites->save($this->data);
                $this->redirect('/sites');
            }
            else {
                die(__('Erro de Validação'));
                // TODO http://ipanemax.goplanapp.com/msb/ticket/view/8
            }
        }
        $site = $this->Sites->firstById($id);
        $this->set(array(
            'site' => $site,
            'themes' => $this->getThemes($site->segment)
        ));
    }
    
    public function delete($id = null) {
        $this->Sites->delete($id);
        $this->redirect('/sites');
    }
    
    protected function getSegments() {
        $segments = Config::read('Segments');
        $normalized = array();
        
        foreach($segments as $slug => $segment) {
            $normalized[$slug] = $segment['title'];
        }
        
        return $normalized;
    }
    
    protected function getThemes($segment) {
        $segments = Config::read('Segments');
        return $segments[$segment]['themes'];
    }
}