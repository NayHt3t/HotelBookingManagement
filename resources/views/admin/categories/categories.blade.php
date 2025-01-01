@extends('layouts.user_type.auth') 
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="{{route('categories.create')}}" class="btn btn-primary">Add New Category</a>
            </div>

        </div>

        <div class="row mt-1">
            <di class="col-md-8">
                <div class="row">
                    <div class="col-md-3"></div>

                    <div class="mt-2 mb-3 text-center">


                        @if($message = Session::get('success'))
                        <span class="text-success">{{ $message }}</span>
                        @endif
                        @if($message = Session::get('unsuccess'))
                        <span class="text-danger">{{ $message }}</span>
                        @endif

                    </div>



                </div>

                <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($categories as $category)
                        <tr>
                            <td>{{++ $i }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <!-- Delete Button (Opens the Modal) -->
                                <button type="button" class="btn btn-outline-danger rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $category->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the category <strong>{{ $category->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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

                            <td colspan="4">
                                <span class="text-danger">*Not available Category data. Empty List.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </di>

        </div>

    </div>
</div>

<!-- Add DataTables Scripts -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#user_table').DataTable(); // Initialize DataTable
    });
</script>

@endsection