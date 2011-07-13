<?php

use app\controllers\api\ApiController;
use lithium\action\Request;

$etag = '3e07e37f57b20e32ba6e3d5e465b0368';

function build_controller($etag) {
    $request = new Request(array(
        '_env' => array(
            'HTTP_IF_NONE_MATCH' => $etag
        )
    ));
    return new ApiController(compact('request'));
}

describe('\app\controllers\api\ApiController', function() use($etag) {
    it('should be fresh when etags match', function() use($etag) {
        $controller = build_controller($etag);
        assert_equal(true, $controller->isFresh($etag));
    });

    it('should not be fresh when etags don\'t match', function() use($etag) {
        $controller = build_controller($etag);
        assert_equal(false, $controller->isFresh('$' . $etag));
    });

    it('should be stale when etags don\'t match', function() use($etag) {
        $controller = build_controller($etag);
        assert_equal(true, $controller->isStale('$' . $etag));
    });

    it('should not bestale when etags match', function() use($etag) {
        $controller = build_controller($etag);
        assert_equal(false, $controller->isStale($etag));
    });
});
