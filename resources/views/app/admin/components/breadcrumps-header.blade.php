<div class="content-header row justify-content-between">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> {{__('main')}} </a>
                    </li>
                    @isset($section)
                        <li class="breadcrumb-item"><a href="{{ route($sectionRoute) }}"> {{ __($section) }}
                            </a>
                        </li>
                    @endisset
                    <li class="breadcrumb-item active">{{ __($current) }}
                    </li>
                </ol>
            </div>
        </div>
    </div>

    @isset($index)
        <div>
            <a href="{{ route('admin.vendors.create') }}"><button type="button"
                    class="btn btn-info btn-min-width mr-1 mb-1">{{__('new')}}</button></a>
        </div>
    @endisset
</div>
