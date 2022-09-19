<?php

namespace Xpressengine\XePlugin\GoogleAnalyticsGa4\Controllers;

use XeDB;
use XeFrontend;
use XePresenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Xpressengine\XePlugin\GoogleAnalyticsGa4\Handler;

/**
 * ManageController
 *
 * @category    GoogleAnalyticsGa4
 * @package     Xpressengine\XePlugin\GoogleAnalyticsGa4
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2022 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
 */
class ManageController extends Controller
{

    /**
     * @return \Xpressengine\Presenter\Presentable
     */
    public function edit(Handler $handler)
    {
        /**
         * TODO: load css file from blade
         *
         * XeFrontend::css(Plugin::asset('assets/style.css'))->load();
         */

        $setting = $handler->getSetting();

        return XePresenter::make('ga4::settings.edit', ['setting' => $setting]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Handler $handler)
    {
        $this->validate($request, $this->getRules());

        $inputs = $request->only(
            [
                'webMeasurementId'
            ]
        );

        $setting = $handler->getSetting();

        \XeDB::beginTransaction();
        try {
            $setting->set($inputs);

            XeDB::commit();
        } catch (\Exception $e) {
            XeDB::rollBack();
        }

        // output
        return redirect()->route('ga4::setting.edit');
    }

    /**
     * get rules
     *
     * @return array
     */
    private function getRules()
    {
        return [
            'webMeasurementId' => 'required'
        ];
    }

}
