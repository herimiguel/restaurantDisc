@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card col-md-12">
                <div class="card-header col-md-12">Dashboard</div>

                <div class="card-body col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <restaurant-component></restaurant-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>

</style>
