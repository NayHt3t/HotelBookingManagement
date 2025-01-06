@extends('layouts.auth-master')
@section('content')
<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="{{ route('facilities.create') }}" class="btn btn-primary">Add New Room Price</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3"></div>
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
