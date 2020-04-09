@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-primary mb-3" href="{{route('employees.create')}}">{{__('Create Employee')}}</a>
                    <x-employee.table :actions="true" :employees="$employees" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
