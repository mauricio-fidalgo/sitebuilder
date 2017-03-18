<?php

namespace meumobi\sitebuilder\workers;

use DateTime;
use Exception;
use app\models\Extensions;
use meumobi\sitebuilder\Logger;
use meumobi\sitebuilder\roles\Updatable;
use meumobi\sitebuilder\services\UpdateNewsFeed;
use meumobi\sitebuilder\services\CreateJobEvent;
use meumobi\sitebuilder\validators\ParamsValidator;
use lithium\util\Collection;

class UpdateFeedsWorker extends Worker
{
    use Updatable;

    const COMPONENT = 'update_news_feed';

    public function perform()
    {
        list($priority, $extensionId) = ParamsValidator::validate($this->params,
            ['priority', 'extension_id'], false);

        $start = new DateTime();

        $priorities = [
            'high' => Extensions::PRIORITY_HIGH,
            'low' => Extensions::PRIORITY_LOW
        ];
        $priority = $priorities[$priority ?: 'low'];

        $extensions = $extensionId
            ? Extensions::find('all', [
                    'conditions' => ['_id' => $extensionId]
                ])
            : $this->getExtensionsByPriorityAndType($priority, 'rss');
        $extensions = Collection::toArray($extensions);
        foreach ($extensions as $extension) {
            try {
                $category = $this->getCategory($extension);
                $updateNewsFeed = new UpdateNewsFeed();

                $updateNewsFeed->perform(compact('category', 'extension'));
            } catch (Exception $e) {
                Logger::error(self::COMPONENT, 'caught exception', [
                    'extension_id' => $extension['_id'],
                    'category_id' => $extension['category_id'],
                    'site_id' => $extension['site_id'],
                    'message' => $e->getMessage(),
                    'exception'  => $e,
                ]);
            }
        }

        $end = new DateTime();

        if (!is_null($priority)) {
            $createJobEvent = new CreateJobEvent();
            $createJobEvent->perform([
                'worker' => get_class($this),
                'start' => $start,
                'end' => $end,
                'params' => compact('priority'),
            ]);
        }
    }
}
