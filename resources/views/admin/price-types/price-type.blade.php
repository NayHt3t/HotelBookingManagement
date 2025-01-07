@extends('layouts.user_type.auth')
@section('content')
<div id="content">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Price Types</h3>
            <div class="col-md-3">
                <!-- Add Button modal -->
                <button type="button" class="btn btn-primary btn-md active px-3 text-white" data-bs-toggle="modal" data-bs-target="#addPriceType">
                    Add New Price Type
                </button>
                 <!--Create Price Type Modal -->
                <div class="modal fade" id="addPriceType" tabindex="-1" aria-labelledby="addPriceTypeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPriceTypeLabel">Add New Price Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('price-types.store') }}" method="POST">
                                @csrf

                                <label for="name">Price Type Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        value="{{old('name')}}"
                                        placeholder="Enter price type"
                                    >
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-md active px-3 text-white">Add</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Price Type Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($price_types as $price_type)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{Str::ucfirst($price_type->name)}}</td>
                            <td>
                                <!-- Edit Button modal -->
                                <button type="submit" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#editPriceType{{$price_type->id}}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <!-- Delete Button modal -->
                                <button type="submit" class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deletePriceType{{$price_type->id}}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                         <!--Edit Price Type Modal -->
                        <div class="modal fade" id="editPriceType{{$price_type->id}}" tabindex="-1" aria-labelledby="editPriceTypeLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPriceTypeLabel">Edit Price Type</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="p-4  justify-content-center">
                                        <form
                                            action="{{route('price-types.update', $price_type->id) }}"
                                            method="POST"
                                        >
                                        @csrf
                                        @method('PUT')
                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="form-control"
                                                value="{{ Str::ucfirst(old('name', $price_type->name)) }}"
                                            >
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-md active px-3 text-white">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!--Delete Price Type Modal -->
                        <div class="modal fade" id="deletePriceType{{$price_type->id}}" tabindex="-1" aria-labelledby="deletePriceTypeLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePriceTypeLabel{{ $price_type->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete This Price Type <strong>{{ Str::ucfirst($price_type->name) }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('price-types.destroy', $price_type->id) }}" method="POST">
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
