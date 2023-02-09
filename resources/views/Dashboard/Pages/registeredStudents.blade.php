@extends('layouts.dashboardLayout')
@section('title', 'Registered Student')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Registered Student</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-md-12">
                
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Registered Students</h5>
                    </div>
                    <div class="alert-info card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Invoice Number</th>
                                    <th>Amount</th>
                                    <th>Aadhar Number</th>
                                    <th>Class Passed</th>
                                    <th>Payment Method</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('registeredStudentsDataTable') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        "data":"DT_RowIndex",
                        "orderable":false,
                        "searchable":false
                    },
                    {
                        data: '{{ \App\Models\StudentRegistration::FIRST_NAME }}',
                        name: '{{ \App\Models\StudentRegistration::FIRST_NAME }}'
                    },
                    {
                        data: '{{ \App\Models\StudentRegistration::LAST_NAME }}',
                        name: '{{ \App\Models\StudentRegistration::LAST_NAME }}'
                    },
                    {
                        data: '{{ \App\Models\StudentRegistration::GENDER }}',
                        name: '{{ \App\Models\StudentRegistration::GENDER }}'
                    },
                    {
                        data: '{{ \App\Models\Payment::INVOICE_NUMBER }}',
                        name: '{{ \App\Models\Payment::INVOICE_NUMBER }}'
                    },
                    {
                        data: '{{ \App\Models\Payment::AMOUNT }}',
                        name: '{{ \App\Models\Payment::AMOUNT }}'
                    },
                    {
                        data: '{{ \App\Models\StudentRegistration::AADHAR_NUMBER }}',
                        name: '{{ \App\Models\StudentRegistration::AADHAR_NUMBER }}'
                    },
                    {
                        data: '{{ \App\Models\StudentRegistration::CLASS_PASSED }}',
                        name: '{{ \App\Models\StudentRegistration::CLASS_PASSED }}'
                    },                    
                    {
                        data: '{{ \App\Models\Payment::METHOD }}',
                        name: '{{ \App\Models\Payment::METHOD }}'
                    },          
                    {
                        data: 'payment_date',
                        name: '{{ \App\Models\Payment::ALIAS_CREATED_AT }}'
                    },
                    
                ]
            });

        });
        $(document).on("click", ".edit", function() {
            let row = $.parseJSON(atob($(this).data("row")));
            if (row['id']) {
                $("#id").val(row['id']);
                $("#title").val(row['title']);
                $("#url_link").val(row['url']);
                $("#url_target").val(row['url_target']);
                $("#nav_type").val(row['nav_type']);
                $("#view_in_list").val(row['view_in_list']);
                $("#position").val(row['position']);
                $("#action").val("update");

                scrollToDiv();
            } else {
                errorMessage("Something went wrong. Code 101");
            }
        });
        let all_parent = $.parseJSON('{!! json_encode($all_parent??[]) !!}');
        $("#nav_type").on("change", function() {
            let select = '<option value="">Select</option>';
            let nav_type = $(this).val();
            let id = $("#id").val();
            all_parent.forEach(element => {
                if (element.nav_type == nav_type && element.id != id) {
                    select += '<option value="' + element.id + '">' + element.title + '</option>';
                }
            });
            $("#parent_id").html(select);
        });

        function deleteNav(id) {
            if (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This item will be removed!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('deleteNavigation') }}',
                            data: {
                                id: id,
                                action: "delete",
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    successMessage(response.message);
                                    table.ajax.reload()
                                } else {
                                    errorMessage(response.message);
                                }
                            },
                            failure: function(response) {
                                errorMessage(response.message);
                            }
                        });
                    }
                });
            } else {
                errorMessage("Something went wrong. Code 102");
            }
        }
    </script>
    @include('Dashboard.include.dataTablesScript')
@endsection
