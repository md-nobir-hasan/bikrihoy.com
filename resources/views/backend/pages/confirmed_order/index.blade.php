@extends('backend.layouts.app')

@section('title', 'Confirmed Orders')

@push('third_party_stylesheets')
    <link href="{{ asset('assets/backend/js/DataTable/datatables.min.css') }}" rel="stylesheet">
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

                    <div class="table-responsive">
                        <table id="confirmedOrderTable" class="table table-striped">
                            <thead>
                                <tr>
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
                                    @php
                                        // Group excels by row number
                                        $excel_rows = $order->excels->groupBy('row');
                                    @endphp
                                    @foreach($excel_rows as $row_number => $excel_row)
                                        @php
                                            $row_data = $excel_row->pluck('value', 'property');
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="order-checkbox"
                                                       data-order-id="{{ $order->id }}"
                                                       data-row="{{ $row_number }}">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $row_data['Invoice ID'] }}</td>
                                            <td>{{ $row_data['Name'] }}</td>
                                            <td>{{ $row_data['Phone'] }}</td>
                                            <td>{{ $row_data['Address'] }}</td>
                                            <td>{{ $row_data['Total'] }}</td>
                                            <td>{{ $row_data['Quantity'] }}</td>
                                            <td>
                                                <div class="btn-group">

                                                    {{-- Single edit button --}}
                                                    <button type="button"
                                                            class="btn btn-sm btn-warning editSingleItem"
                                                            data-order-id="{{ $order->id }}"
                                                            data-row="{{ $row_number }}"
                                                            title="Edit Item">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>

                                                    {{-- Single print button --}}
                                                    <button type="button"
                                                            class="btn btn-sm btn-success printSingleLabel"
                                                            data-order-id="{{ $order->id }}"
                                                            data-row="{{ $row_number }}"
                                                            title="Print Label">
                                                        <i class="fas fa-print"></i>
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
                                @endforeach
                            </tbody>
                        </table>
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
@endsection

@push('third_party_scripts')
    <script src="{{ asset('assets/backend/js/DataTable/datatables.min.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('#confirmedOrderTable').DataTable({
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
            pageLength: 25,
            order: [[0, 'desc']]
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
            const selectedItems = $('.order-checkbox:checked').map(function() {
                return {
                    orderId: $(this).data('order-id'),
                    row: $(this).data('row')
                };
            }).get();

            if (selectedItems.length === 0) {
                alert('Please select at least one item to print');
                return;
            }

            const orderIds = selectedItems.map(item => item.orderId);
            const rows = selectedItems.map(item => item.row);

            printLabels(orderIds, rows);
        });

        // Single label print button click
        $(document).on('click', '.printSingleLabel', function() {
            const orderId = $(this).data('order-id');
            const row = $(this).data('row');

            // Open print window using properly formatted URL
            const url = "{{ route('confirmed-order.print-single-label', ['orderId' => ':orderId', 'row' => ':row']) }}"
                .replace(':orderId', orderId)
                .replace(':row', row);

            const printWindow = window.open(
                url,
                '_blank',
                'width=800,height=800'
            );

            if (!printWindow) {
                alert('Please allow popups for this website to print labels');
            }
        });

        // Function to handle label printing
        function printLabels(orderIds, rows) {
            const printWindow = window.open(
                `{{ route('confirmed-order.print-labels') }}?ids=${orderIds.join(',')}&rows=${rows.join(',')}`,
                '_blank',
                'width=800,height=800,menubar=yes,toolbar=yes,location=no,status=no'
            );

            if (!printWindow) {
                alert('Please allow popups for this website to print labels');
                return;
            }
        }

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
    });
</script>
@endpush
