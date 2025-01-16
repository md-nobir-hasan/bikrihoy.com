@extends('backend.layouts.app')

@section('title', 'Edit Confirmed Order')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">
                        <h4>Edit Confirmed Order</h4>
                    </span>
                    <span class="float-right">
                        <a href="{{ route('confirmed-order.index') }}" class="btn btn-info">Back</a>
                    </span>
                </div>

                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    @include('backend.partial.flush-message')

                    <form action="{{ route('confirmed-order.update', $confirmedOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                                   value="{{ old('date', $confirmedOrder->date->format('Y-m-d')) }}" required>
                            @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        @foreach(App\Models\ConfirmedOrder::getHeaders() as $key => $header)
                                            <th>{{ $header['display'] }}</th>
                                        @endforeach
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="excelDataRows">
                                    @php
                                        $excelData = $confirmedOrder->getFormattedExcelData();
                                    @endphp

                                    @foreach($excelData->first() ?: [] as $index => $__)
                                        <tr>
                                            @foreach(App\Models\ConfirmedOrder::getHeaderDisplayNames() as $header)
                                                <td>
                                                    <input type="text"
                                                           name="excel_data[{{ $index }}][{{ str_replace(' ', '_', $header) }}]"
                                                           class="form-control"
                                                           value="{{ $excelData[$header][$index] ?? '' }}"
                                                           required>
                                                </td>
                                            @endforeach
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success" id="addRow">Add Row</button>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
$(document).ready(function() {
    // Add new row
    $('#addRow').click(function() {
        const rowCount = $('#excelDataRows tr').length;
        let newRow = '<tr>';

        @foreach(App\Models\ConfirmedOrder::getHeaderDisplayNames() as $header)
            newRow += `<td>
                <input type="text"
                       name="excel_data[${rowCount}][{{ str_replace(' ', '_', $header) }}]"
                       class="form-control"
                       required>
            </td>`;
        @endforeach

        newRow += `<td>
            <button type="button" class="btn btn-danger btn-sm removeRow">
                <i class="fas fa-trash"></i>
            </button>
        </td></tr>`;

        $('#excelDataRows').append(newRow);
    });

    // Remove row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endpush
