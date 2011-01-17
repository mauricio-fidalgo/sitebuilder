<?php

class ApiController extends AppController {
    protected $autoRender = false;
    protected $domain;
    
    protected function beforeFilter() {
        $params = $this->param('params');
        $this->domain = $params[0];
    }
    
    protected function respondToJSON($record) {
        header('Content-type: application/json');
        $object = $this->objectTemplate($record);
        echo json_encode($this->toJSON($object));
    }
    
    protected function toJSON($record) {
        if(is_array($record)) {
            foreach($record as $k => $v) {
                $record[$k] = $this->toJSON($v);
            }
        }
        else if($record instanceof Model) {
            $record = $record->toJSON();
        }
        
        return $record;
    }
    
    protected function objectTemplate($content) {
        $site = Model::load('Sites')->firstByDomain($this->domain);
        $controller = $this->param('controller');
        $action = substr($this->param('action'), 4); // remote "api_" from prefixed action
        $templatePath = String::insert(':controller/:action.:ext.tpl', array(
            'controller' => $controller,
            'action' => $action,
            'ext' => 'bkml',
        ));
        
        return array(
            'theme' => $site->theme,
            'templatePath' => $templatePath,
            'skin' => $site->skin,
            'siteInfo' => array(
                'title' => $site->title,
                'description' => $site->description
            ),
            'content' => $content
        );
    }
}