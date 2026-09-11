@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('user') }}" class="text-decoration-none text-muted">User</a></li>
    <li class="breadcrumb-item active text-main" aria-current="page">Edit User</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="d-flex justify-content-end">
                <a href="{{ url('role') }}" class="btn btn-success mb-3"><i class="bi bi-arrow-left"></i>Back</a>
            </div> --}}
            <form action="{{ route('user.update', $users->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $users->name }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $users->email }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Role</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($roles as $v)
                            <option {{ $users->role_id == $v->id ? 'selected' : '' }} value="{{ $v->id }}">
                                {{ $v->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Password</label>
                    <input type="password" name="password" id="password" class="form-control mb-2" placeholder="Fill this in if you want to change your password">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                    <div class="form-text">Click to see/hide</div>
                </div>
                <button type="submit" name="save" class="btn btn-success">Save Changes</button>
                <button type="reset" class="btn btn-outline-success">Reset</button>
            </form>
        </div>
    </div>
</div>

<script>
    const togglePasswordBtn = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');
    const toggleIcon = document.querySelector('#toggleIcon');

    togglePasswordBtn.addEventListener('click', function (e) {
        // Trik utama: Cek tipe input saat ini
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';

        // Ubah tipe input
        passwordInput.setAttribute('type', type);

        if (type === 'text') {
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    });
</script>
@endsection
