@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header', [
            'section' => 'vendors',
            'current' => '',
            'sectionRoute' => 'admin.categories',
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
                                'cardHeader' => 'Add a new Category',
                            ])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('layouts.includes.alerts.success')
                            @include('layouts.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            <div class="card-content collapse show overflow-auto">
                                <div class="card-body card-dashboard ">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>name</th>
                                                {{-- <th>slug</th> --}}
                                                <th>description</th>
                                                {{-- <th>info</th> --}}
                                                {{-- TODO: IF MAIN HIGHLIGHT WITH DIFFERENT COLOR --}}
                                                {{-- <th>is_main</th> --}}
                                                {{-- <th>parent_category_id</th> --}}
                                                {{-- <th>image</th> --}}
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <tr @if (!$category->Active) class="bg-red-300" @endif>
                                                        <td><a href="{{route('admin.categories.show', $category->id)}}"> {{ $category->name }}</a></td>
                                                        {{-- <td><a href="#">{{ $category->slug }}</a></td> --}}
                                                        <td>{{ $category->description }}</td>
                                                        {{-- <td>{{ $category->info }}</td> --}}
                                                        {{-- <td>{{ $category->is_main }}</td> --}}
                                                        {{-- <td>{{ $category->parent_category_id }}</td> --}}
                                                        {{-- <td>
                                                            <img class="rounded-circle img-border height-100"
                                                                src="{{ $category->getImage() }}"
                                                                alt="{{ $category->name }} image">
                                                        </td> --}}
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>

                                                                <a href="{{ route('admin.categories.delete', $category->id) }}"
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
                                    <div class="justify-content-center d-flex mt-5">
                                        {{ $categories->links() }}
                                    </div>

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
