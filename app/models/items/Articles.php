<?php

namespace app\models\items;

require_once 'lib/htmlpurifier/HTMLPurifier.auto.php';
require_once 'lib/dom/SimpleHtmlDom.php';
require_once 'lib/bbcode/Decoda.php';

use Model;
use Mapper;
use DOMDocument;
use HTMLPurifier;
use HTMLPurifier_Config;
use Filesystem;
use Decoda;

use app\models\Items;

class Articles extends \app\models\Items {
    protected $type = 'Article';

    protected $fields = array(
        'title' => array(
            'title' => 'Title',
            'type' => 'string'
        ),
        'description' => array(
            'title' => 'Description',
            'type' => 'richtext'
        ),
        'author' => array(
            'title' => 'Author',
            'type' => 'string'
        )
    );

    protected static $blacklist = array(
        'gravatar.com'
    );

    public static function __init() {
        parent::__init();

        $self = static::_object();
        $parent = parent::_object();

        $self->_schema = $parent->_schema + array(
            'guid'  => array('type' => 'string', 'default' => ''),
            'link'  => array('type' => 'string', 'default' => ''),
            'pubdate'  => array('type' => 'date', 'default' => 0),
            'format'  => array('type' => 'string', 'default' => 'bbcode'),
            'description'  => array('type' => 'string', 'default' => ''),
            'author'  => array('type' => 'string', 'default' => ''),
        );
    }

    public static function addToFeed($feed, $item) {
        //$log = KLogger::instance(Filesystem::path('log'));

        $author = $item->get_author();
        $article = array(
            'site_id' => $feed->site_id,
            'parent_id' => $feed->id,
            'guid' => static::filterGuid($item->get_id()),
            'link' => $item->get_link(),
            'title' => $item->get_title(),
            'description' => static::cleanupHtml($item),
            'pubdate' => gmdate('Y-m-d H:i:s', $item->get_date('U')),
            'author' => $author ? $author->get_name() : '',
            'format' => 'html',
            'type' => 'articles'
        );

        $article = static::create($article);
        $article->save();

        $images = static::getArticleImages($item);
        foreach($images as $image) {
            $image = static::getImageUrl($image, $article['guid']);
            $result = Model::load('Images')->download($this, $image, array(
                'url' => $image
            ));

            if($result) {
                //$log->logInfo('Downloaded image "%s" to "%s"', $image, $result);
            }
            else {
                //$log->logInfo('Image "%s" could not be found', $image, $result);
            }
        }
        //$log->logInfo('Imported article "%s"', $article['guid']);
    }

    protected static function filterGuid($guid) {
        $guid = preg_replace('%;jsessionid=[\w\d]+%', '', $guid);

        if(preg_match('%rj\.gov\.br%', $guid)) {
            $guid = preg_replace('%\.lportal.*articleId=%', '?articleId=', $guid);
        }

        return $guid;
    }

    protected static function getPurifier() {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', Filesystem::path('tmp/cache/html_purifier'));
        $config->set('HTML.Allowed', 'b,i,br,p');
        return new HTMLPurifier($config);
    }

    protected static function cleanupHtml($item) {
        $html = $item->get_content();
        $purifier = static::getPurifier();
        $html = $purifier->purify($html);
        $html = mb_convert_encoding($html, 'ISO-8859-1', mb_detect_encoding($html));

        if(!empty($html)) {
            $doc = new DOMDocument();
            $doc->loadHTML($html);
            $body = $doc->getElementsByTagName('body')->item(0);
            $results = '';

            // PRODERJ only
            if(strpos($item->get_id(), 'www.rj.gov.br') !== false) {
                $body->removeChild($body->getElementsByTagName('p')->item(1));
                $body->removeChild($body->getElementsByTagName('p')->item(0));
            }

            foreach($body->childNodes as $node) {
                if($node->nodeType == XML_TEXT_NODE) {
                    $content = trim($node->textContent);
                    if($content) {
                        $new_node = $doc->createElement('p', $content);
                        $body->replaceChild($new_node, $node);
                        $node = $new_node;
                    }
                }
                if($node->nodeType == XML_ELEMENT_NODE) {
                    $results .= $doc->saveXML($node) . PHP_EOL;
                }
            }
        }
        else {
            $results = '';
        }

        return $results;
    }

    protected static function getArticleImages($item) {
        $images = static::getEnclosureImages($item);
        if(empty($images)) {
            $images = static::getContentImages($item);
        }

        foreach($images as $k => $image) {
            if(static::isBlackListed($image)) {
                unset($images[$k]);
            }
        }

        return $images;
    }

    protected static function getContentImages($item) {
        $content = str_get_html($item->get_content());
        $links = $content->find('a[rel=lightbox]');

        $images = array();

        foreach($links as $link) {
            $images []= $link->href;
        }

        return $images;
    }

    protected static function getEnclosureImages($item) {
        $images = array();
        $enclosures = $item->get_enclosures();
        if(is_null($enclosures)) return $images;

        foreach($enclosures as $enclosure) {
            $medium = $enclosure->get_medium();
            if(!$medium || $medium == 'image') {
                $images []= $enclosure->get_link();
            }
        }

        return $images;
    }

    protected static function getImageUrl($url, $article) {
        if(Mapper::isRoot($url)) {
            $domain = parse_url($article, PHP_URL_HOST);
            $url = 'http://' . $domain . $url;
        }
        else if(preg_match('%^(http://download.rj.gov.br/imagens/\d+/\d+/\d+.jpg)%', $url, $output)) {
            return $output[0];
        }

        return $url;
    }

    protected static function isBlackListed($link) {
        foreach(static::$blacklist as $i) {
            $pattern = preg_quote($i);
            if(preg_match('%' . $pattern . '%', $link)) {
                return true;
            }
        }

        return false;
    }

    public function toJSON($entity) {
        $self = parent::toJSON($entity);

        if($self['format'] == 'bbcode') {
            $parser = new Decoda($self['description']);
            $self['description'] = '<p>' . $parser->parse(true) . '</p>';
        }

        return $self;
    }
}

Articles::applyFilter('save', function($self, $params, $chain) {
    return Items::addTimestamps($self, $params, $chain);
});
