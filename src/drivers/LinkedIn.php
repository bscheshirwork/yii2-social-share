<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\Driver;

/**
 * Driver for LinkedIn.
 * @link https://linkedin.com
 *
 * @property bool|string $siteName
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class LinkedIn extends Driver
{
    /**
     * @var bool|string
     */
    public $siteName = false;


    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_link = 'https://www.linkedin.com/shareArticle?mini=true'
                    . '&url={url}'
                    . '&title={title}'
                    . '&summary={description}';

        if ($this->siteName) {
            $this->_data['{siteName}'] = $this->siteName;
            $this->addUrlParam('source', '{siteName}');
        }

        return parent::getLink();
    }

    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->title = static::encodeData($this->title);
        $this->description = static::encodeData($this->description);

        if (is_string($this->siteName)) {
            $this->siteName = static::encodeData($this->siteName);
        }
    }
}
