{{ XeFrontend::translation(['validation.mimes']) }}

@section('page_title')
    <h2>Google Analytics GA4</h2>
@endsection

@section('page_description')
    setting for tracking & widget
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ xe_trans('ga4::measurementId') }}</label>
                                <input type="text" class="form-control" name="measurementId"
                                       value="{{ $setting->get('measurementId') ?: Request::old('measurementId') }}"
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
    //  @FIXME
    window.jQuery(function ($) {
        $('#__xe_btn_remove_key_file').click(function (e) {
            e.preventDefault();

            $('#__xe_file_info').collapse('hide');
            $('#__xe_file_input').collapse('show');
        });

        window.XE.Validator.put('ga_json', function ($dst, parameters) {
            var value = $dst.val();

            if (value && 'json' !== value.split('.').pop()) {
                XE.Validator.error($dst, XE.Lang.trans('validation.mimes', {attribute: $dst.attr('name'), values: 'json'}));

                return false;
            }

            return true;
        });
    });
</script>
