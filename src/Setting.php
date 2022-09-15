<?php
/**
 * Setting.php
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

use Xpressengine\Config\ConfigManager;
use Xpressengine\Keygen\Keygen;
use Xpressengine\Storage\File;
use Xpressengine\Storage\Storage;
use XeStorage;

/**
 * Setting
 *
 * @category    GoogleAnalyticsGa4
 * @package     XpressengineXePlugin\GoogleAnalyticsGa4
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2022 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
 */
class Setting
{
    protected $cfg;

    protected $storage;

    protected $keygen;

    protected $key = 'google_analytics_ga4';

    /**
     * @var \Xpressengine\Config\ConfigEntity
     */
    protected $config;

    protected $file;

    /**
     * Setting constructor.
     *
     * @param ConfigManager $cfg     config manager
     * @param Storage       $storage storage
     * @param Keygen        $keygen  keygen
     */
    public function __construct(ConfigManager $cfg, Storage $storage, Keygen $keygen)
    {
        $this->cfg = $cfg;
        $this->storage = $storage;
        $this->keygen = $keygen;
    }

    /**
     * exists
     *
     * @return bool
     */
    public function exists()
    {
        if ($this->config !== null) {
            return true;
        }

        if (!$config = $this->cfg->get($this->key)) {
            return false;
        }

        $this->config = $config;

        return true;
    }

    /**
     * get
     *
     * @param string $name    name
     * @param null   $default default
     *
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        $val = $this->exists() ? $this->config->get($name) : $default;

        return !empty($val) ? $val : $default;
    }

    /**
     * set
     *
     * @param array $data data
     *
     * @return void
     */
    public function set(array $data)
    {
        $this->config = $this->cfg->set($this->key, $data);

        if (!$this->config->get('uuid')) {
            $this->config->set('uuid', $this->keygen->generate());

            $this->cfg->modify($this->config);
        }
    }

    /**
     * destroy
     *
     * @return void
     */
    public function destroy()
    {
        $this->storage->unBindAll($this->get('uuid'), true);
        $this->cfg->removeByName($this->key);
    }
}
