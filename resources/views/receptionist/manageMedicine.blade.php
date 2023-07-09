@extends('receptionist.receptionistIndex')

@section('content')
    <main id="main">

        <div class="container mt-4">

            <div class="card mb-4" style="margin-top: 100px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">All Medicines</h2>
                            <p class="text-muted"><a href="{{ route('receptionist.medicine.add') }}"><code>Add
                                        Medicine</code></a></p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Medicine Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentPage = $medicines->currentPage();
                                    $perPage = $medicines->perPage();
                                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                @foreach ($medicines as $medicine)
                                    <tr>
                                        <th scope="row">{{ $loop->index + $startingNumber }}</th>
                                        <td>{{ $medicine->name }}</td>
                                        <td>{{ $medicine->price }}</td>
                                        <td>{{ $medicine->quantity }}</td>
                                        <td>
                                            <a href="{{ route('receptionist.medicine.edit', $medicine->id) }}"><button
                                                    type="button" class="btn btn-outline-primary">Edit</button></a>
                                            /
                                            <form action="{{ route('receptionist.medicine.delete', $medicine->id) }}"
                                                style="display:inline;" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" name="deleteMedicine" value="Delete"
                                                    class="btn btn-danger"></input>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pagination custom-style">
                    {{ $medicines->links() }}
                </div>
            </div>

        </div>

    </main>
@endsection
