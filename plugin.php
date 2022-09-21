<?php
namespace Xpressengine\XePlugin\GoogleAnalyticsGa4;

use Illuminate\Support\Facades\Artisan;
use View;
use XeFrontend;
use Route;
use Xpressengine\Plugin\AbstractPlugin;
use Xpressengine\XePlugin\GoogleAnalyticsGa4\Handler;
use Xpressengine\XePlugin\GoogleAnalyticsGa4\Setting;
use Xpressengine\Translation\Translator;

/**
 * Plugin
 *
 * @category    GoogleAnalyticsGa4
 * @package     Xpressengine\XePlugin\GoogleAnalyticsGa4
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2022 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
 */
class Plugin extends AbstractPlugin
{
    /**
     * 이 메소드는 활성화(activate) 된 플러그인이 부트될 때 항상 실행됩니다.
     *
     * @return void
     */
    public function boot()
    {
        // implement code
        View::addNamespace('ga4', __DIR__ . '/views');
        Translator::alias('google_analytics_ga4', 'ga4');

        $this->route();
        $this->intercepts();
    }


    /**
     * get setting uri
     *
     * @return string
     */
    public function getSettingsURI()
    {
        return route('ga4::setting.edit');
    }


    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(Handler::class, function ($app) {
            return new Handler(
                $app,
                new Setting($app['xe.config'], $app['xe.storage'], $app['xe.keygen'])
            );
        }, true);

        app()->alias(Handler::class, 'xe.ga4.handler');
    }

    /**
     * 플러그인이 활성화될 때 실행할 코드를 여기에 작성한다.
     *
     * @param string|null $installedVersion 현재 XpressEngine에 설치된 플러그인의 버전정보
     *
     * @return void
     */
    public function activate($installedVersion = null)
    {
        // implement code
    }

    /**
     * 플러그인을 설치한다. 플러그인이 설치될 때 실행할 코드를 여기에 작성한다
     *
     * @return void
     */
    public function install()
    {
        $this->putLang();
    }

    /**
     * 해당 플러그인이 설치된 상태라면 true, 설치되어있지 않다면 false를 반환한다.
     * 이 메소드를 구현하지 않았다면 기본적으로 설치된 상태(true)를 반환한다.
     *
     * @return boolean 플러그인의 설치 유무
     */
    public function checkInstalled()
    {
        // implement code

        return parent::checkInstalled();
    }

    /**
     * 플러그인을 업데이트한다.
     *
     * @return void
     */
    public function update()
    {
        $this->putLang();
    }

    /**
     * 해당 플러그인이 최신 상태로 업데이트가 된 상태라면 true, 업데이트가 필요한 상태라면 false를 반환함.
     * 이 메소드를 구현하지 않았다면 기본적으로 최신업데이트 상태임(true)을 반환함.
     *
     * @return boolean 플러그인의 설치 유무,
     */
    public function checkUpdated()
    {
        // implement code

        return parent::checkUpdated();
    }

    protected function route()
    {
        // implement code

        Route::group(
            ['namespace' => 'Xpressengine\\XePlugin\\GoogleAnalyticsGa4\\Controllers', 'as' => 'ga4::'],
            function () {
                require plugins_path('google_analytics_ga4/routes.php');
            }
        );

    }

    /**
     * get measurement code
     *
     * @param string $measurementId measurement id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function getMeasurementCode($measurementId)
    {
        return view('ga4::tracking', compact('measurementId'));
    }

    /**
     * register intercept
     *
     * @return void
     */
    private function intercepts()
    {
        intercept(
            'Presenter@make',
            'googleAnalyticsGa4.addScript',
            function ($target, $id, $data = [], $mergeData = [], $html = true, $api = false) {
                /** @var \Illuminate\Routing\Route $route */
                $route = app('router')->current();
                if ($route && in_array('settings', $route->middleware()) === false) {
                    $setting = app('xe.ga4.handler')->getSetting();
                    if ($setting->get('webMeasurementId')) {
                        XeFrontend::html('ga4:tracking')->content(
                            $this->getMeasurementCode($setting->get('webMeasurementId'))
                        )->load();
                    }
                }

                return $target($id, $data, $mergeData, $html, $api);
            }
        );
    }

    /**
     * update languages
     *
     * @return void
     */
    public static function putLang()
    {
        // put board translation source
        /** @var \Xpressengine\Translation\Translator $trans */
        $trans = app('xe.translator');
        $trans->putFromLangDataSource('google_analytics_ga4', base_path('plugins/google_analytics_ga4/langs/lang.php'));
    }


}
