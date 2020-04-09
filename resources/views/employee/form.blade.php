@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" enctype="multipart/form-data">
                        @csrf
                        @isset($employee)
                            {{ method_field('PUT') }}
                            <input type="hidden" name="contract_old" value="{{$employee->contract}}">
                        @endisset

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $employee->name ?? '' }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $employee->email ?? '' }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $employee->phone ?? ''}}" required>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $employee->address ?? '' }}" required>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contract_date" class="col-md-4 col-form-label text-md-right">{{ __('Contract Date') }}</label>

                            <div class="col-md-6">
                                <input id="contract_date" type="date" class="form-control @error('contract_date') is-invalid @enderror" name="contract_date" value="{{ old('contract_date') ?? isset($employee) ? $employee->contract_date->toDateString() : '' }}" required>

                                @error('contract_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contract_expiration_date" class="col-md-4 col-form-label text-md-right">{{ __('Contract Expiration Date') }}</label>

                            <div class="col-md-6">
                                <input id="contract_expiration_date" type="date" class="form-control @error('contract_expiration_date') is-invalid @enderror" name="contract_expiration_date" value="{{ old('contract_expiration_date') ?? isset($employee) ? $employee->contract_expiration_date->toDateString() : '' }}" required>

                                @error('contract_expiration_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contract" class="col-md-4 col-form-label text-md-right">{{ __('Contract PDF file') }}</label>

                            <div class="col-md-6">
                                <input id="contract" type="file" class="form-control @error('contract') is-invalid @enderror" name="contract" value="{{ old('contract') }}"  @if(!isset($employee))required @endif>
                                @error('contract')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manager" class="col-md-4 col-form-label text-md-right">{{ __('Manager') }}</label>

                            <div class="col-md-6">
                                <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                    <option value="">{{ __('Select Manager') }}</option>
                                    @foreach($managers as $manager)
                                        <option @if(old('user_id') == $manager->id || (isset($employee) && $employee->user_id == $manager->id)) selected="selected" @endif value="{{$manager->id}}">{{__($manager->name)}}</option>
                                    @endforeach
                                </select>

                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
