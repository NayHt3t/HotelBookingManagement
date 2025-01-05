@extends('layouts.auth-master')
@section('content')
<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="{{ route('price-types.create') }}" class="btn btn-primary">Add New Price Type</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-8">
                <div class="row">
                    <div class="mt-2 mb-3">
                        @if($message = Session::get('success'))
                        <span class="text-success">{{ $message }}</span>
                        @elseif ($message = Session::get('fail'))
                        <span class="text-danger">{{ $message }}</span>
                        @endif
                    </div>
                </div>

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
                                <a href="{{ route('price-types.edit', $price_type) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('price-types.destroy', $price_type->id) }}" class="d-inline" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-danger ml-2 rounded-pill btn-delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
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
