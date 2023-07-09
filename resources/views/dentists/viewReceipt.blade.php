@extends('dentists.dentistIndex')

@section('content')
    <main id="main">
        <div class="container mt-4">

            {{-- <a href="{{ route('receptionist.invoice.create', $receipt->id) }}" class="btn btn-primary"
                style="margin-top: 100px;">Generate Invoice</a> --}}

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
@endsection
