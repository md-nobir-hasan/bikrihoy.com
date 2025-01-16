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
                            <button id="bulkDeleteBtn" class="btn btn-danger mr-2" disabled>
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>
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
                                    @foreach(App\Models\ConfirmedOrder::getHeaders() as $key => $header)
                                        <th style="width: {{ $header['width'] }}">{{ $header['display'] }}</th>
                                    @endforeach
                                    <th style="width: 100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    {{-- <tr class="bg-light">
                                        <td colspan="{{ count(App\Models\ConfirmedOrder::getHeaders()) + 1 }}"
                                            class="text-center font-weight-bold text-warning">
                                            {{ $order->getFormattedDate() }}
                                        </td>
                                    </tr> --}}

                                    @php
                                        $excelData = $order->getFormattedExcelData();
                                    @endphp

                                    @foreach($excelData->first() ?: [] as $index => $__)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="order-checkbox" value="{{ $order->id }}">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            @foreach(App\Models\ConfirmedOrder::getHeaderDisplayNames() as $header)
                                                <td>{{ $excelData[$header][$index] ?? '' }}</td>
                                            @endforeach
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('confirmed-order.show', $order->id) }}"
                                                       class="btn btn-sm btn-info"
                                                       title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(check('Confirmed Order')->edit)
                                                        <a href="{{ route('confirmed-order.edit', $order->id) }}"
                                                           class="btn btn-sm btn-primary"
                                                           title="Bulk Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-warning editSingleItem"
                                                                data-order-id="{{ $order->id }}"
                                                                data-index="{{ $index }}"
                                                                title="Edit Item">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button"
                                                            class="btn btn-sm btn-success printSingleLabel"
                                                            data-order-id="{{ $order->id }}"
                                                            title="Print Label">
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                    @if(check('Confirmed Order')->delete)
                                                        <a href="#"
                                                           onclick="deleteConfirmedOrder({{ $order->id }})"
                                                           class="btn btn-sm btn-danger"
                                                           title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
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
                    @foreach(App\Models\ConfirmedOrder::getHeaderDisplayNames() as $header)
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
            const selectedIds = $('.order-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                alert('Please select at least one order to print');
                return;
            }

            printLabels(selectedIds);
        });

        // Single label print button click
        $(document).on('click', '.printSingleLabel', function() {
            const orderId = $(this).data('order-id');
            printLabels([orderId]);
        });

        // Function to handle label printing
        function printLabels(orderIds) {
            const printWindow = window.open(
                `{{ route('confirmed-order.print-labels') }}?ids=${orderIds.join(',')}`,
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
            if (confirm('Are you sure you want to delete all selected orders?')) {
                const selectedIds = $('.order-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '{{ route("confirmed-order.bulk-delete") }}',
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: selectedIds
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error deleting orders');
                    }
                });
            }
        });

        // Edit single item
        $('.editSingleItem').click(function() {
            const orderId = $(this).data('order-id');
            const index = $(this).data('index');

            // Fetch item data
            $.get(`/confirmed-order/${orderId}/item/${index}`, function(data) {
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

            $.ajax({
                url: `/confirmed-order/${orderId}/update-item`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
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
    });

    function deleteConfirmedOrder(id) {
        if (confirm('Are you sure you want to delete this order?')) {
            $.ajax({
                url: `/confirmed-order/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error deleting order');
                }
            });
        }
    }
</script>
@endpush
