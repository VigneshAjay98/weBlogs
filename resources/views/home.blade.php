@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to weBlogs!<a href="{{ route('getProfile') }}">&nbspCheckout Pofile.</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
