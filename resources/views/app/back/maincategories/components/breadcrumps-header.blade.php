<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}"> {{$section}}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{$current}}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

