@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @role(App\User::USER_ROLE_ADMIN)
                    <table class="table">
                        <tr>
                            <td class="font-weight-bolder">{{__('Name')}}:</td>
                            <td>{{$manager->name}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bolder">{{__('Email')}}:</td>
                            <td>{{$manager->email}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bolder">{{__('Expiration date')}}:</td>
                            <td>{{$manager->expiration_at->format(config('app.date_time_format'))}}</td>
                        </tr>
                    </table>
                    @endrole
                    <h3>Employees</h3>
                    <x-employee.table :employees="$employees" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
