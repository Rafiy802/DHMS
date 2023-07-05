@extends('dentists.dentistIndex')

@section('content')
    <main id="main">
        <div class="container mt-4">

            <a href="{{ route('receptionist.invoice.create', $receipt->id) }}" class="btn btn-primary"
                style="margin-top: 100px;">Generate Invoice</a>

            <div class="card mb-4 mt-4">
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
                                @foreach ($medicines as $med)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $med->name }}</td>
                                        <td>{{ $med->price }}</td>
                                        <td>{{ $med->pivot->quantity }}</td>
                                        @php
                                            $total = $med->pivot->quantity * $med->price;
                                        @endphp
                                        <td>{{ $total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                                @foreach ($treatments as $treat)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $treat->name }}</td>
                                        <td>{{ $treat->price }}</td>
                                        <td>{{ $treat->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                                value="{{ $receipt->Notes }}" disabled required autocomplete="notes">{{ $receipt->Notes }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>Dummy</td>
                <td>
                    <input type="number" class="form-control input-w-md " name="quantity[]" required autocomplete="quantity" value="1" min="1">
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

                // if (deleteButtons.length === 1) {
                //     deleteButtons.prop('disabled', true);
                // }
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
        });
    </script> --}}
@endsection
