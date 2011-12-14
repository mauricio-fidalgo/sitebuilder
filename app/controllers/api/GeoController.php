<?php

namespace app\controllers\api;

use Model;
use Inflector;
use app\models\Items;

class GeoController extends ApiController {
   /*public function nearest() {
        $category = Model::load('Categories')->firstById($this->request->params['category_id']);

        $classname = '\app\models\items\\' . Inflector::camelize($category->type);
        $items = $classname::find('nearest', array(
            'conditions' => array(
                'site_id' => $this->site()->id,
                'parent_id' => $category->id,
                'lat' => $this->request->query['lat'],
                'lng' => $this->request->query['lng']
            ),
            'limit' => $this->param('limit', 20),
            'page' => $this->param('page', 1)
        ));

        $type = $category->type;
        $etag = $this->etag($items);
        $self = $this;

        $items = $this->toJSON($items);
        if(is_hash($items)) {
            $items = array($items);
        }

        return $this->whenStale($etag, function() use($items) {
            return $items;
        });
    }*/
	
	public function nearest() {
		$category = Model::load('Categories')->firstById($this->request->params['category_id']);
		$classname = '\app\models\items\\' . Inflector::camelize($category->type);
		$conditions = array('site_id' => $this->site()->id, 'parent_id' => $category->id,);
		
		$limit 	= $this->param('limit', 20);
		$page 	=  $this->param('page', 1);
		
		$items = $classname::find('nearest', array(
				'conditions' => $conditions + array(
						'lat' => $this->request->query['lat'],
						'lng' => $this->request->query['lng']
				),
				'limit' => $limit,
				'page' => $page,
		));
		
		if($items->count() < $limit)
			$items = $classname::getNotGeocoded($classname, $items, $conditions, $limit, $page);
		
		$type = $category->type;
		$etag = $this->etag($items);
		$self = $this;
	
		$items = $this->toJSON($items);
		if(is_hash($items)) {
			$items = array($items);
		}
	
		return $this->whenStale($etag, function() use($items) {
			return $items;
		});
	}
	
    public function inside() {
        $category = Model::load('Categories')->firstById($this->request->params['category_id']);

        $classname = '\app\models\items\\' . Inflector::camelize($category->type);
        $items = $classname::find('within', array(
            'conditions' => array(
                'site_id' => $this->site()->id,
                'parent_id' => $category->id,
                'ne_lat' => $this->request->query['ne_lat'],
                'ne_lng' => $this->request->query['ne_lng'],
                'sw_lat' => $this->request->query['sw_lat'],
                'sw_lng' => $this->request->query['sw_lng']
            ),
            'limit' => $this->param('limit', 20),
            'page' => $this->param('page', 1)
        ));

        $type = $category->type;
        $etag = $this->etag($items);
        $self = $this;

        $items = $this->toJSON($items);
        if(is_hash($items)) {
            $items = array($items);
        }

        return $this->whenStale($etag, function() use($items) {
            return $items;
        });
    }
}
