@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-responsive">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Role Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $roles as $index => $v )
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $v->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('role.edit', $v->id) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('role.destroy', $v->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
