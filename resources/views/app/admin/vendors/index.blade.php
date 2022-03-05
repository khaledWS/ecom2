@extends('layouts.admin.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('admin.components.breadcrumps-header',
        ['current' => "الباعة", 'index' => ""])
        <!--------------------------- END Navigagion breadcrumps header -------------------------->
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <!--------------------------- Card -------------------------->
                        <div class="card">
                            <!--------------------------- Card Header -------------------------->
                            @include('admin.maincategories.components.card-header',
                            ['cardHeader' =>"قائمة الباعة"])
                            <!--------------------------- END Card Header -------------------------->


                            <!-------------------- Alerts -------------------->
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->
                            <!-------------------- Card Content -------------------->

                            <div class="card-content collapse show overflow-auto">
                                <div class="card-body card-dashboard overflow-auto">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>الأسم</th>
                                                <th>البريد الالكتروني</th>
                                                <th>الهاتف</th>
                                                <th>العنوان</th>
                                                <th>القسم الرئيسي</th>
                                                <th>اشتراك</th>
                                                <th>الشعار</th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($dataset)
                                                @foreach ($dataset as $row)
                                                    <tr>
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ $row->email }}</td>
                                                        <td>{{ $row->mobile }}</td>
                                                        <td>{{ $row->address }}</td>
                                                        <td>{{ $row->main_category_id }}</td>
                                                        <td>{{ $row->subscription_id }}</td>
                                                        <td>
                                                            <img class="img-thumbnai img-fluid rounded-circle width-150 height-150"
                                                                src="{{ $row->getPhoto() }}" alt="">
                                                        </td>

                                                        <td>
                                                            @if ($row->status)
                                                                <div class=" p-0 alert alert-success">Active</div>
                                                            @else
                                                                <div class="alert alert-danger">Not</div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('admin.vendors.edit', $row->id) }}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                                <a href="{{ route('admin.vendors.delete', $row->id) }}"
                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                    id="delte-link">حذف</a>

                                                                <a href="{{ url('/shop/vendor/' . $row->mc_slug) }}"
                                                                    class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1"
                                                                    id="visit-link">زر</a>
                                                                {{-- </form> --}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="justify-content-center d-flex mt-5">
                                            {{ $dataset->links() }}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            <!-------------------- END Card Content -------------------->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
