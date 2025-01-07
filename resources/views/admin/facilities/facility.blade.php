@extends('layouts.user_type.auth')
@section('content')
<div id="content">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Facilities</h3>
            <div class="col-md-3">
                <a href="{{ route('facilities.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Facility</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Compensation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($facilities as $facility)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $facility->name}}</td>
                            <td>{{ $facility->price}}</td>
                            <td>{{ $facility->compensation}}</td>
                            <td>
                                <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('facilities.destroy', $facility->id) }}" class="d-inline" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-danger rounded-pill btn-delete"
                                    data-bs-toggle="modal" data-bs-target="#deleteFacility{{$facility->id}}"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!--Delete Price Type Modal -->
                        <div class="modal fade" id="deleteFacility{{$facility->id}}" tabindex="-1" aria-labelledby="deleteFacilityLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteFacilityLabel{{ $facility->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete this Facility? <strong>{{ ($facility->name) }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="9">
                                <span class="text-danger">*No room types available. Empty list.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
