<?php
/**
 * Handler.php
 *
 * This file is part of the Xpressengine package.
 *
 * PHP version 7
 *
 * @category    GoogleAnalytics
 * @package     XpressengineXePlugin\GoogleAnalyticsGa4
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2019 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
 */

namespace Xpressengine\XePlugin\GoogleAnalyticsGa4;

use Google_Client;
use Google_Service_Analytics;
use Illuminate\Foundation\Application;
use Xpressengine\Widget\Exceptions\NotConfigurationWidgetException;

/**
 * Handler
 *
 * @category    GoogleAnalyticsGa4
 * @package     XpressengineXePlugin\GoogleAnalyticsGa4
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2022 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
 */
class Handler
{
    protected $app;

    protected $setting;

    /**
     * Handler constructor.
     *
     * @param Application $app     app
     * @param Setting     $setting setting
     */
    public function __construct(Application $app, Setting $setting)
    {
        $this->app = $app;
        $this->setting = $setting;
    }

    /**
     * get GA id
     * @return string
     */
    protected function getMeasurementId()
    {
        return 'ga:' . $this->getSetting('measurementId');
    }

    /**
     * get setting
     *
     * @param null|string $key key
     *
     * @return mixed|Setting|null
     */
    public function getSetting($key = null)
    {
        return !$key ? $this->setting : $this->setting->get($key);
    }

    /**
     * get service
     *
     * @param null|string $service service
     *
     * @return Application|mixed
     */
    protected function getService($service = null)
    {
        return !$service ? $this->app : $this->app[$service];
    }
}
