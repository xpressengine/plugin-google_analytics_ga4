{{ XeFrontend::css('plugins/google_analytics/assets/skin.css')->load() }}
{{ XeFrontend::translation(['validation.mimes']) }}

@section('page_title')
    <h2>Google Analytics GA4</h2>
@endsection

@section('page_description')
    setting for google analytics 4(GA4)
@endsection

<div class="panel">
    <div class="panel-body">
        <form method="post" action="{{ route('ga4::setting.update') }}" enctype="multipart/form-data" data-rule="analyticsSetting">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ xe_trans('ga4::measurement') }}</h3>
                </div>
                <div class="panel-body">
                    <h4 class="panel-body-subtitle">{{ xe_trans('ga4::datastream') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ xe_trans('ga4::web') }} {{ xe_trans('ga4::measurementId') }}</label>
                                <input type="text" class="form-control" name="webMeasurementId"
                                       value="{{ $setting->get('webMeasurementId') ?: Request::old('webMeasurementId') }}"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ xe_trans('xe::save') }}</button>
        </form>
    </div>
</div>

<script>
</script>
