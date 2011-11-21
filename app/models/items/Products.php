<?php

namespace app\models\items;

require_once 'lib/geocoding/GoogleGeocoding.php';
use GoogleGeocoding;

class Products extends \app\models\Items {
    protected $type = 'Product';

    protected $fields = array(
        'title' => array(
            'title' => 'Title',
            'type' => 'string'
        ),
        'price' => array(
            'title' => 'Price',
            'type' => 'string'
        ),
        'description' => array(
            'title' => 'Description',
            'type' => 'richtext'
        ),
        'featured' => array(
            'title' => 'Featured?',
            'type' => 'boolean'
        )
    );

    public static function __init() {
        parent::__init();

        $self = static::_object();
        $parent = parent::_object();

        $self->_schema = $parent->_schema + array(
            'description'  => array('type' => 'string', 'default' => ''),
            'price'  => array('type' => 'string', 'default' => ''),
            'featured'  => array('type' => 'boolean', 'default' => false)
        );
    }
}

Products::applyFilter('save', function($self, $params, $chain) {
    $item = $params['entity'];

    if(!$item->id) {
        $item->created = date('Y-m-d H:i:s');
    }
    $item->modified = date('Y-m-d H:i:s');

    return $chain->next($self, $params, $chain);
});
