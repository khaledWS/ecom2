<div class="card-content collapse show overflow-auto">
    <div class="card-body card-dashboard overflow-auto">
        <table class="table display nowrap table-striped table-bordered ">
            <thead>
                <tr>
                    @isset($columnNames)
                        @foreach ($columnNames as $column)
                            @unless($column === 'id')
                                <th>{{ $column }}</th>
                            @endunless
                        @endforeach
                    @endisset
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @isset($dataset)
                    @foreach ($dataset as $data)
                        <tr>
                            @foreach ($data->getAttributes() as $column => $row)
                                @if ($column === 'id')
                                    @continue
                                @endif
                                @if ($column == 'status')
                                    <td>
                                        @if ($data->status)
                                            <div class=" p-0 alert alert-success">Active</div>
                                        @else
                                            <div class="alert alert-danger">Not</div>
                                        @endif

                                    </td>
                                @elseif ($column == 'logo')
                                    <td>
                                        <img class="img-thumbnai img-fluid rounded-circle width-150 height-150"
                                            src="{{ $data->getPhoto() }}" alt="picture">
                                    </td>
                                @else
                                    <td>{{ $row }}</td>
                                @endif
                            @endforeach
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin.categories.edit', $data->id) }}"
                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                    <a href="{{ route('admin.categories.delete', $data->id) }}"
                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                        id="delte-link">حذف</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>

        <!-------------------- Pagination -------------------->
        <div class="justify-content-center d-flex mt-5">
            {{ $dataset->links() }}
        </div>
    </div>
</div>
