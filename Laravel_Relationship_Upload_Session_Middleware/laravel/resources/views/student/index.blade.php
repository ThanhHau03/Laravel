@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <a class="btn btn-success mb-2" href="{{ route('students.create') }}">
                Thêm
            </a>
            <div class="form-group">
                <select id="select-course-name"></select>
            </div>
            <div class="form-group">
                <select id="select-status" class="form-control">
                    <option value="00">
                        Tất cả
                    </option>
                    @foreach($arrStudentStatus as $option => $value)
                        <option value="{{ $value }}">
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
            <table class="table table-striped table-bordered" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Status</th>
                    <th>Avatar</th>
                    <th>Course Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $("#select-course-name").select2({
                ajax: {
                    url: "{{ route('courses.api.name') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            // ajax select2
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    // cache: true
                },
                placeholder: 'Search for a Name',
                allowClear: true,
                // minimumInputLength: 1
            });

            let buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };

            let table = $('#table-index').DataTable({
                dom: 'Blrtip',
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csvHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print',
                    }),
                    'colvis'
                ],
                lengthMenu: [5, 10, 25, 50, 75, 100],
                processing: true,
                serverSide: true,
                ajax: '{!! route('students.api') !!}',
                columnDefs: [
                    {
                        className: 'not-export', targets: [3],
                    },
                    {
                        className: 'not-export', targets: [4],
                    }
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'age', name: 'age'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'avatar',
                        target: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            if (!data) {
                                return '';
                            }
                            return `<img src="{{ public_path() }}/${data}">`;
                        } // đẩy lên host để hiện thị
                    },
                    {data: 'course_name', name: 'course_name'},
                    {
                        data: 'edit',
                        target: 6,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                                        Edit
                                    </a>`;
                            }
                        },
                    {
                        data: 'destroy',
                        target: 7,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return`<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn-delete btn btn-danger">DELETE</button>
                            </form>`;
                        }
                    }
                ]
            });

            $('#select-course-name').change(function () {
                table.column(6).search($(this).val()).draw();
            });

            $('#select-status').change(function () {
                let value = $(this).val();
                table.column(4).search(value).draw();

                // xử lý search FE
                // if (value === '00') {
                //     table.column(4).search('').draw();
                // } else {
                //     table.column(4).search(value).draw();
                // }
            });

            $(document).on('click', '.btn-delete', function () {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    DataType: 'json',
                    data: form.serialize(),
                    success: function () {
                        console.log('success');
                        table.draw();
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            });
        });
    </script>
@endpush
