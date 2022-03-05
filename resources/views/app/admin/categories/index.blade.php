@extends('layouts.admin')

@section('content')
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
                                <h4 class="card-title">Categories</h4>
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

                                @include('layouts.includes.alerts.success')
                                @include('.layouts.includes.alerts.errors')

                            <div class="card-content collapse show overflow-auto">
                                <div class="card-body card-dashboard ">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>name</th>
                                                <th>slug</th>
                                                <th>description</th>
                                                <th>info</th>
                                                <th>is_main</th>
                                                <th>parent_category_id</th>
                                                <th>image</th>
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <tr @if (!$category->Active) class="bg-red-300" @endif>
                                                        <td>{{ $category->name }}</td>
                                                        <td><a href="#">{{ $category->slug }}</a></td>
                                                        <td>{{ $category->description }}</td>
                                                        <td>{{ $category->info }}</td>
                                                        <td>{{ $category->is_main }}</td>
                                                        <td>{{ $category->parent_category_id }}</td>
                                                        <td>
                                                            <img class="img-thumbnai img-fluid rounded-circle width-150 height-150"
                                                                src="{{ $category->getImage() }}"
                                                                alt="{{ $category->name }} image">
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('admin.categories.edit', $mainCategory->id) }}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>

                                                                <a href="{{ route('admin.categories.delete', $mainCategory->id) }}"
                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                    id="delte-link">Delete</a>
                                                                {{-- </form> --}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    {{-- <div class="justify-content-center d-flex mt-5">
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
@endsection
