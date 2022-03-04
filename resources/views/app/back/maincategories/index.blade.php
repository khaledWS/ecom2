<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"> main categories </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-underline-hover"
                                href="{{ route('admin.dashboard') }}">Main page</a>
                        </li>
                        <li class="breadcrumb-item active"> Main Categories
                        </li>
                        <li class="breadcrumb-item active"><a class="text-underline-hover"
                                href="{{ route('admin.categories.create') }}"> add new</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- DOM - jQuery events table -->
        <section id="dom">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                             <x-alert  type="error" message="dode">ada</x-alert>
                            <h4 class="card-title">Main Categories</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    {{-- <li><a data-action="reload" wire:click="$refresh" ><i class="ft-rotate-cw"></i></a></li> --}}
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                </ul>
                            </div>
                        </div>

                        @include('app.back.layouts.includes.alerts.success')
                        @include('app.back.layouts.includes.alerts.errors')

                        <div class="card-content collapse show overflow-auto">
                            <div class="card-body card-dashboard ">
                                <table class="table display nowrap table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>active</th>
                                            <th>name</th>
                                            <th>photo</th>
                                            <th>Description</th>
                                            <th>actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($mainCategories)
                                            @foreach ($mainCategories as $mainCategory)

                                                <tr>

                                                    <td>
                                                        @if ($mainCategory->active)
                                                            <div class=" p-0 alert alert-success">Active</div>
                                                        @else
                                                            <div class="alert alert-danger">Not</div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <img class="img-thumbnai img-fluid rounded-circle width-150 height-150"
                                                            src="{{ $mainCategory->getPhoto() }}" alt="">
                                                    </td>

                                                    <td>{{ $mainCategory->name }}</td>
                                                    <td>{{ $mainCategory->Description }}</td>


                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{ route('admin.categories.edit', $mainCategory->id) }}"
                                                                class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>

                                                            <a href="{{ route('admin.categories.delete', $mainCategory->id) }}"
                                                                class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                id="delte-link">Delete</a>

                                                            <a href="{{ url('/shop/category/' . $mainCategory->slug) }}"
                                                                class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1"
                                                                id="visit-link">Visit</a>
                                                            {{-- </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
{{--
                                    <div class="justify-content-center d-flex mt-5">
                                        {{ $mainCategories->links() }}
                                    </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
