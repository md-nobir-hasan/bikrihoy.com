@extends('backend.layouts.app')

@section('title', 'Confirmed Orders')

@push('third_party_stylesheets')
    <link href="{{ asset('assets/backend/js/DataTable/datatables.min.css') }}" rel="stylesheet">
    <style>
        .bg-17a2b85c{
            background-color: #17a2b85c !important;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">
                        <h4>Confirmed Orders</h4>
                    </span>
                    <span class="float-right">

                        @if(check('Confirmed Order')->delete)
                            {{-- bulk delete button --}}
                            <button id="bulkDeleteBtn" class="btn btn-danger mr-2" disabled>
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>

                            {{-- bulk print label button --}}
                            <button id="bulkPrintLabelBtn" class="btn btn-primary mr-2" disabled>
                                <i class="fas fa-print"></i> Print Labels
                            </button>

                            {{-- Global style button --}}
                            <button id="globalStyleBtn" class="btn btn-info mr-2">
                                <i class="fas fa-paint-brush"></i> Global Style
                            </button>
                        @endif
                        @if(check('Confirmed Order')->add)
                            <a href="{{ route('confirmed-order.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Order
                            </a>
                        @endif
                    </span>
                </div>

                <div class="card-body">
                    @include('backend.partial.flush-message')
                    <div style="float: right;">
                            <label for="dateFilter">Filter by Date:</label>
                            <select id="dateFilter">
                                <option value="all">All Dates</option>
                            </select>
                        </div>
                    <div class="table-responsive">

                        <table id="confirmedOrderTable" class="table table-striped">
                            <thead>
                                <tr>
                                     <td>Date</td>
                                    <th>
                                        <input type="checkbox" id="selectAll">
                                    </th>

                                    <td>S.L</td>
                                    @foreach(App\Models\Excel::getHeaders() as $key => $header)
                                        <th style="width: {{ $header['width'] }}">{{ $header['display'] }}</th>
                                    @endforeach
                                    <th style="width: 100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @if(count($order->excels ?: []))

                                        @php
                                            // Group excels by row number
                                            $excel_rows = $order->excels->groupBy('row');
                                        @endphp

                                        @foreach($excel_rows as $row_number => $excel_row)
                                            @php
                                                $row_data = $excel_row->pluck('value', 'property');
                                            @endphp
                                            <tr>
                                               <td>{{$order->date->format('d-m-Y')}}</td>
                                                <td>
                                                    <input type="checkbox" class="order-checkbox"
                                                        data-order-id="{{ $order->id }}"
                                                        data-row="{{ $row_number }}">
                                                </td>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $row_data['Invoice'] ?? ($row_data['Invoice ID'] ?? '') }}</td>
                                                <td>
                                                    {{ $row_data['Name'] }}

                                                    {{-- Single print label button --}}
                                                    <span class="badge badge-success printSingleLabel"
                                                        style="cursor: pointer"
                                                        data-order-id="{{ $order->id }}"
                                                        data-row="{{ $row_number }}"
                                                        title="Print Label">
                                                        <i class="fas fa-print"></i>
                                                    </span>

                                                </td>
                                                <td>{{ $row_data['Address'] }}</td>
                                                <td>{{ $row_data['Phone'] }}</td>
                                                <td>{{ $row_data['Amount'] ?? ($row_data['Total'] ?? '') }}</td>
                                                <td>{{ $row_data['Note'] ?? '' }}</td>
                                                <td>
                                                    <div class="btn-group">

                                                        {{-- Single print style button --}}
                                                        <button class="btn btn-sm btn-info styleControl"
                                                                data-order-id="{{ $order->id }}"
                                                                data-row="{{ $row_number }}"
                                                                title="Label Style">
                                                            <i class="fas fa-paint-brush"></i>
                                                        </button>

                                                        {{-- Single edit button --}}
                                                        <button type="button"
                                                                class="btn btn-sm btn-warning editSingleItem"
                                                                data-order-id="{{ $order->id }}"
                                                                data-row="{{ $row_number }}"
                                                                title="Edit Item">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>

                                                        {{-- Single delete button --}}
                                                        @if(check('Confirmed Order')->delete)
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger deleteRow"
                                                                    data-order-id="{{ $order->id }}"
                                                                    data-row="{{ $row_number }}"
                                                                    title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination" style="justify-content: flex-end;">
                                <li class="paginate_button page-item previous" id="prevPage"><a href="#" aria-controls="table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active page-link" id="pageNumber" style="background-color: #007bff;color:black;"></li>
                                <li class="paginate_button page-item next" id="nextPage"><a href="#" aria-controls="table" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editItemForm">
                <div class="modal-body">
                    @foreach(App\Models\Excel::getHeaderDisplayNames() as $header)
                        <div class="form-group">
                            <label>{{ $header }}</label>
                            <input type="text"
                                   name="{{ str_replace(' ', '_', $header) }}"
                                   class="form-control"
                                   required>
                        </div>
                    @endforeach
                    <input type="hidden" name="excel_id" id="editExcelId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add this modal at the bottom of the page --}}
<div class="modal fade" id="styleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Label Style Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="styleForm">
                    <div class="form-group">
                        <label>Font Size (pt)</label>
                        <input type="number" class="form-control" id="fontSize" value="9" min="6" max="12" step="0.5">
                    </div>
                    <div class="form-group">
                        <label>Font Weight</label>
                        <select class="form-control" id="fontWeight">
                            <option value="normal">Normal</option>
                            <option value="bold" selected>Bold</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Line Height</label>
                        <input type="number" class="form-control" id="lineHeight" value="1.1" min="0.8" max="2" step="0.1">
                    </div>
                    <div class="form-group">
                        <label>Text Overflow</label>
                        <select class="form-control" id="textOverflow">
                            <option value="visible">Show All</option>
                            <option value="hidden">Hide Overflow</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printWithStyle">Print with Style</button>
            </div>
        </div>
    </div>
</div>

{{-- Add this after the existing style modal --}}
<div class="modal fade" id="globalStyleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Global Label Style Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="globalStyleForm">
                    <div class="form-group">
                        <label>Font Size (pt)</label>
                        <input type="number" class="form-control" id="globalFontSize" value="9" min="6" max="12" step="0.5">
                    </div>
                    <div class="form-group">
                        <label>Font Weight</label>
                        <select class="form-control" id="globalFontWeight">
                            <option value="normal">Normal</option>
                            <option value="bold" selected>Bold</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Line Height</label>
                        <input type="number" class="form-control" id="globalLineHeight" value="1.1" min="0.8" max="2" step="0.1">
                    </div>
                    <div class="form-group">
                        <label>Text Overflow</label>
                        <select class="form-control" id="globalTextOverflow">
                            <option value="visible">Show All</option>
                            <option value="hidden">Hide Overflow</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveGlobalStyle">Save Global Style</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('third_party_scripts')
    <script src="{{ asset('assets/backend/js/DataTable/datatables.min.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    $(document).ready(function() {
        var table = $('#confirmedOrderTable');
            var tableData = [];
            table.find('tbody tr').each(function () {
                var row = $(this);
                var date = row.find('td:eq(0)').text().trim();
                tableData.push({ date: date, rowHTML: row.prop('outerHTML') });
            });

            tableData.sort((a, b) => b.date.localeCompare(a.date));

            var groupedData = {};
            tableData.forEach(entry => {
                if (!groupedData[entry.date]) {
                    groupedData[entry.date] = [];
                }
                groupedData[entry.date].push(entry.rowHTML);
            });

            var dateKeys = Object.keys(groupedData);
            var currentPageIndex = 0;
            var totalPages = dateKeys.length;

            var dateFilter = $("#dateFilter");
            dateKeys.forEach(date => {
                dateFilter.append(`<option value="${date}">${date}</option>`);
            });

            function updatePageControls() {
                $("#pageNumber").text(`Page ${currentPageIndex + 1} of ${totalPages}`);

                $("#prevPage").prop("disabled", currentPageIndex === 0);
                $("#nextPage").prop("disabled", currentPageIndex === totalPages - 1);
            }

            function loadPage(pageIndex) {
                if (pageIndex < 0 || pageIndex >= totalPages) return;

                currentPageIndex = pageIndex;
                var tbody = table.find('tbody');
                tbody.empty();

                var date = dateKeys[currentPageIndex];
                groupedData[date].forEach(rowHTML => tbody.append(rowHTML));

                updatePageControls();
            }

            $("#prevPage").click(() => {
                if (currentPageIndex > 0) {
                    loadPage(currentPageIndex - 1);
                }
            });

            $("#nextPage").click(() => {
                if (currentPageIndex < totalPages - 1) {
                    loadPage(currentPageIndex + 1);
                }
            });

            $("#dateFilter").change(function () {
                var selectedDate = $(this).val();
                var tbody = table.find('tbody');
                tbody.empty();

                if (selectedDate === "all") {
                    dateKeys.forEach(date => {
                        groupedData[date].forEach(rowHTML => tbody.append(rowHTML));
                    });
                    $(".dataTables_paginate").show();
                } else {
                    groupedData[selectedDate]?.forEach(rowHTML => tbody.append(rowHTML));
                    $(".dataTables_paginate").hide();
                }
            });

            loadPage(0);
            table.DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Export Excel',
                        className: 'btn btn-success btn-sm',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> Export PDF',
                        className: 'btn btn-danger btn-sm',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-info btn-sm',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ],
                ordering: false,
                searching: true,
                paging: false
            });

        // Select all checkbox
        $('#selectAll').change(function() {
            $('.order-checkbox').prop('checked', $(this).prop('checked'));
            updateBulkButtons();
        });

        // Individual checkbox change
        $('.order-checkbox').change(function() {
            updateBulkButtons();
        });

        // Update bulk buttons state
        function updateBulkButtons() {
            const checkedCount = $('.order-checkbox:checked').length;
            $('#bulkDeleteBtn, #bulkPrintLabelBtn').prop('disabled', checkedCount === 0);
        }

        // Bulk print labels button click
        $('#bulkPrintLabelBtn').click(function() {
            const selectedRows = $('.order-checkbox:checked');
            const orderIds = [];
            const rows = [];
            const serials = [];

            selectedRows.each(function() {
                const $row = $(this).closest('tr');
                orderIds.push($(this).data('order-id'));
                rows.push($(this).data('row'));
                serials.push($row.find('td:eq(2)').text()); // Get serial number from second column
            });

            const globalStyles = JSON.parse(localStorage.getItem('labelGlobalStyles') || '{}');
            const url = `{{ route('confirmed-order.print-labels') }}?ids=${orderIds.join(',')}&rows=${rows.join(',')}&serials=${serials.join(',')}&styles=${encodeURIComponent(JSON.stringify(globalStyles))}`;

            const printWindow = window.open(url, '_blank', 'width=800,height=800');
            if (!printWindow) {
                alert('Please allow popups for this website to print labels');
            }
        });

        // Single label print button click
        $(document).on('click', '.printSingleLabel', function() {
            const orderId = $(this).data('order-id');
            const row = $(this).data('row');
            const serialNumber = $(this).closest('tr').find('td:eq(2)').text(); // Get the S.L number

            // Get global styles from localStorage
            const globalStyles = JSON.parse(localStorage.getItem('labelGlobalStyles') || '{}');

            // Create URL with styles parameter and serial number
            const url = "{{ route('confirmed-order.print-single-label', ['orderId' => ':orderId', 'row' => ':row']) }}"
                .replace(':orderId', orderId)
                .replace(':row', row) + `?styles=${encodeURIComponent(JSON.stringify(globalStyles))}&serial=${serialNumber}`;

            const printWindow = window.open(
                url,
                '_blank',
                'width=800,height=800'
            );

            if (!printWindow) {
                alert('Please allow popups for this website to print labels');
            }
        });

        // Bulk delete button click
        $('#bulkDeleteBtn').click(function() {
            if (confirm('Are you sure you want to delete all selected rows?')) {
                const selectedRows = $('.order-checkbox:checked').map(function() {
                    return {
                        orderId: $(this).data('order-id'),
                        row: $(this).data('row')
                    };
                }).get();

                $.ajax({
                    url: '{{ route("confirmed-order.bulk-delete") }}',
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rows: selectedRows
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });

        // Edit single item
        $('.editSingleItem').click(function() {
            const orderId = $(this).data('order-id');
            const row = $(this).data('row');

            // Store row number in modal
            $('#editItemModal').data('row', row);

            // Fetch item data
            $.get(`/confirmed-order/${orderId}/item/${row}`, function(data) {
                // Populate modal form
                Object.keys(data).forEach(key => {
                    $(`#editItemModal input[name="${key}"]`).val(data[key]);
                });
                $('#editExcelId').val(orderId);
                $('#editItemModal').modal('show');
            });
        });

        // Handle form submission
        $('#editItemForm').submit(function(e) {
            e.preventDefault();
            const orderId = $('#editExcelId').val();
            const row = $('#editItemModal').data('row');

            $.ajax({
                url: `/confirmed-order/${orderId}/update-item`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    row: row,
                    ...Object.fromEntries(new FormData(this))
                },
                success: function(response) {
                    if (response.success) {
                        $('#editItemModal').modal('hide');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error updating item');
                }
            });
        });

        // Single row delete
        $(document).on('click', '.deleteRow', function() {
            if (confirm('Are you sure you want to delete this row?')) {
                const orderId = $(this).data('order-id');
                const row = $(this).data('row');

                $.ajax({
                    url: `/confirmed-order/${orderId}/row/${row}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });

        // Add this to your existing JavaScript
        $(document).on('click', '.styleControl', function() {
            const orderId = $(this).data('order-id');
            const row = $(this).data('row');

            // Store the current item details for printing
            $('#styleModal').data('orderId', orderId);
            $('#styleModal').data('row', row);

            // Show the modal
            $('#styleModal').modal('show');
        });

        // Handle print with style button click
        $('#printWithStyle').click(function() {
            const orderId = $('#styleModal').data('orderId');
            const row = $('#styleModal').data('row');

            const globalStyles = JSON.parse(localStorage.getItem('labelGlobalStyles') || '{}');
            const customStyles = {
                fontSize: $('#fontSize').val(),
                fontWeight: $('#fontWeight').val(),
                lineHeight: $('#lineHeight').val(),
                textOverflow: $('#textOverflow').val()
            };

            // Merge global and custom styles, with custom styles taking precedence
            const styles = { ...globalStyles, ...customStyles };

            const stylesParam = JSON.stringify(styles);
            const url = "{{ route('confirmed-order.print-single-label', ['orderId' => ':orderId', 'row' => ':row']) }}"
                .replace(':orderId', orderId)
                .replace(':row', row) + `?styles=${encodeURIComponent(stylesParam)}`;

            const printWindow = window.open(url, '_blank', 'width=800,height=800');

            if (!printWindow) {
                alert('Please allow popups for this website to print labels');
            }

            $('#styleModal').modal('hide');
        });

        // Global style button click
        $('#globalStyleBtn').click(function() {
            $('#globalStyleModal').modal('show');
        });

        // Save global style
        $('#saveGlobalStyle').click(function() {
            const globalStyles = {
                fontSize: $('#globalFontSize').val(),
                fontWeight: $('#globalFontWeight').val(),
                lineHeight: $('#globalLineHeight').val(),
                textOverflow: $('#globalTextOverflow').val()
            };

            // Store in localStorage
            localStorage.setItem('labelGlobalStyles', JSON.stringify(globalStyles));

            // Close modal
            $('#globalStyleModal').modal('hide');

            alert('Global styles saved successfully!');
        });

        // Load global styles when opening style modal
        $('.styleControl').click(function() {
            const globalStyles = JSON.parse(localStorage.getItem('labelGlobalStyles') || '{}');
            if (globalStyles) {
                $('#fontSize').val(globalStyles.fontSize || 9);
                $('#fontWeight').val(globalStyles.fontWeight || 'bold');
                $('#lineHeight').val(globalStyles.lineHeight || 1.1);
                $('#textOverflow').val(globalStyles.textOverflow || 'visible');
            }
        });
    });
</script>
@endpush
