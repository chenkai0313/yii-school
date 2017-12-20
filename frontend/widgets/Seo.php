<?php

/**
 * Created by getpu on 16/9/1.
 */

namespace frontend\widgets;

use yii\base\Widget;
use frontend\models\Cache;

class Seo  extends Widget
{
    public $keywords;
    public $description;

    public function init()
    {
       if(!isset($this->keywords)){
          $this->keywords = Cache::getWebConfig()['web_keywords'];
       }
       if(!isset($this->description)){
           $this->description = Cache::getWebConfig()['web_description'];
       }
    }

    public function run()
    {
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $this->keywords]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $this->description]);
    }
}
