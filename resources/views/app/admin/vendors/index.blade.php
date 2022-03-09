@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header', [
            'current' => 'Vendors',
            'sectionRoute' => 'admin.vendors',
            'index' => 'admin.vendors.create',
        ])
        <!--------------------------- END Navigagion breadcrumps header -------------------------->


        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <!--------------------------- Card -------------------------->
                        <div class="card">
                            <!--------------------------- Card Header -------------------------->
                            @include('app.admin.components.card-header', [
                                'cardHeader' => __('Vendors'),
                            ])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('layouts.includes.alerts.success')
                            @include('layouts.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            <div class="card-content collapse show overflow-auto">
                                <div class="card-body card-dashboard ">
                                    <table class="table display nowrap table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-1">status</th>
                                                <th>name</th>
                                                <th>description</th>
                                                <th class="col-1">actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($vendors)
                                                @foreach ($vendors as $vendor)
                                                    <tr>
                                                        <td class="small">
                                                            @if ($vendor->active)
                                                                <div class="badge badge-success">active</div>
                                                            @elseif (!$vendor->active)
                                                                <div class="badge badge-danger">not active</div>
                                                            @endif
                                                            @if ($vendor->status)
                                                                <div class="badge badge-info">{{ $vendor->status }}</div>
                                                            @endif
                                                            @if ($vendor->featured)
                                                                <div class="badge badge-info">{{ $vendor->featured }}</div>
                                                            @endif
                                                        </td>

                                                        <td><a href="{{ route('admin.vendors.show', $vendor->id) }}">
                                                                {{ $vendor->name }}</a></td>

                                                        <td>{{ $vendor->description }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('admin.vendors.edit', $vendor->id) }}"><button
                                                                        type="button"
                                                                        class="btn btn-info btn-round mr-1 mb-1 px-1">Edit</button></a>
                                                                <a><button type="button"
                                                                        class="btn btn-danger btn-round mr-1 mb-1 px-1"
                                                                        data-toggle="modal"
                                                                        data-target="#danger">Delete</button></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog"
                                                        aria-labelledby="myModalLabel10" style="display: none;"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger white">
                                                                    <h4 class="modal-title white" id="myModalLabel10">You are
                                                                        about to
                                                                        Delete an Item</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5>are you sure you want to Delete this vendor</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn grey btn-outline-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <a
                                                                        href="{{ route('admin.vendors.destroy', $vendor->id) }}">
                                                                        <button type="button"
                                                                            class="btn btn-outline-danger">Delete</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    @isset($vendors)
                                        <div class="justify-content-center d-flex mt-5">
                                            {{ $vendors->links() }}
                                        </div>
                                    @endisset


                                </div>
                            </div>
                            <!-------------------- END Card Content -------------------->
                        </div>
                        <!--------------------------- END Card -------------------------->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('page-css')
    <!-- BEGIN PAGE VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/animate/animate.css') }}">
    <!-- BEGIN Page Level CSS-->
@endsection

@section('page-script')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/modal/components-modal.js') }}" type="text/javascript"></script>
@endsection
