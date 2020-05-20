@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white"> <a href="/">Dashboard</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are Admin.
                    <br>
                    <a href="/userManagement">User Management</a><br><br>
                    <a href="/admin/items">Item Management</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
