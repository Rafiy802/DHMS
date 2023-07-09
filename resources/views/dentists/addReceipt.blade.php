@extends('dentists.dentistIndex')

@section('content')
    <main id="main">
        <div class="container mt-4">
            <form method="POST" action="{{route('dentist.receipt.new', $patient->user_id)}}">
                @csrf

                <div class="card mb-4" style="margin-top: 100px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pt-3 pb-4 font-bold font-up deep-purple-text">Medicines</h2>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="medicines-table" class="table table-striped medicine-tables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Medicine Name</th>
                                        <th>Medicine Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <button id="add-medicine" type="button" class="btn btn-primary add-row-btn">Add Medicine</button>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pt-3 pb-4 font-bold font-up deep-purple-text">Treatments</h2>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="treatments-table" class="table table-striped medicine-tables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Treatment Name</th>
                                        <th>Treatment Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <button id="add-treatment" type="button" class="btn btn-primary add-row-btn">Add Treatment</button>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pt-3 pb-4 font-bold font-up deep-purple-text">Notes</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                                    value="{{ old('notes') }}" required autocomplete="notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Add Receipt
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-row-btn').click(function() {
                let tableId = $(this).closest('.card-body').find('table').attr('id');
                let tbody = $('#' + tableId + ' tbody');
                let rowNumber = tbody.find('tr').length + 1;

                let newRow = `
                    <tr>
                        <td>${++rowNumber}</td>
                        <td>
                            <select name="medicine[]" class="form-select">
                                <option value="">Select Medicine</option>
                                @foreach ($medicines as $medicine)
                                    @if ($medicine->quantity > 0)
                                        <option value="{{ $medicine->id }}" data-quantity="{{ $medicine->quantity }}">{{ $medicine->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>Dummy</td>
                        <td>
                            <input type="number" class="form-control input-w-md" name="quantity[]" required autocomplete="quantity" value="1" min="1">
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-danger delete-row-btn">Delete</button>
                        </td>
                    </tr>
                `;

                if (tableId === 'treatments-table') {
                    newRow = `
                        <tr>
                            <td>${++rowNumber}</td>
                            <td>
                                <select name="treatment[]" class="form-select">
                                    <option value="">Select Treatment</option>
                                    @foreach ($treatments as $treatment)
                                        <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>Dummy</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger delete-row-btn">Delete</button>
                            </td>
                        </tr>
                    `;
                }

                tbody.append(newRow);
                updateDeleteButtons(tableId);
                updateRowNumbers(tableId);
            });

            function updateDeleteButtons(tableId) {
                let deleteButtons = $('#' + tableId + ' .delete-row-btn');
                deleteButtons.prop('disabled', false);
            }

            function updateRowNumbers(tableId) {
                let rows = $('#' + tableId + ' tbody tr');
                rows.each(function(index) {
                    $(this).find('td:first-child').text(index + 1);
                });
            }

            $(document).on('click', '.delete-row-btn', function() {
                let tableId = $(this).closest('table').attr('id');
                let row = $(this).closest('tr');
                row.remove();
                updateDeleteButtons(tableId);
                updateRowNumbers(tableId);
            });

            $(document).on('change', 'select[name="medicine[]"]', function() {
                let selectedOption = $(this).find(':selected');
                let quantity = selectedOption.data('quantity');
                let quantityInput = $(this).closest('tr').find('input[name="quantity[]"]');
                quantityInput.attr('max', quantity);
            });
        });
    </script>
@endsection
