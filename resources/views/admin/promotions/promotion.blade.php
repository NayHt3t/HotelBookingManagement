@extends('layouts.user_type.auth')
@section('content')
<div id="content">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Promotions</h3>
            <div class="col-md-3">
                <a href="{{ route('promotions.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Promotion</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <table id="data_table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Room Type</th>
                            <th>Room Price</th>
                            <th>Discount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($promotions as $promotion)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $promotion->roomPrice->roomType->name}}</td>
                            <td>{{ $promotion->roomPrice->price}}</td>
                            <td>{{ $promotion->discount}} % </td>
                            <td>{{ $promotion->start_date}}</td>
                            <td>{{ $promotion->end_date}}</td>
                            <td>
                                <a href="{{ route('promotions.edit', $promotion) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('promotions.destroy', $promotion->id) }}" class="d-inline" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-danger rounded-pill btn-delete"
                                    data-bs-toggle="modal" data-bs-target="#deletePromotion{{$promotion->id}}"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!--Delete Price Type Modal -->
                        <div class="modal fade" id="deletePromotion{{$promotion->id}}" tabindex="-1" aria-labelledby="deletePromotionLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePromotionLabel{{ $promotion->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete this promotion? <strong>{{ ($promotion->name) }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST">
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
                                <span class="text-danger">*No Promotion available. Empty list.</span>
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
