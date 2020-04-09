<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Phone') }}</th>
        <th>{{ __('Address') }}</th>
        <th>{{ __('Contract') }}</th>
        <th>{{ __('Contract Date') }}</th>
        <th>{{ __('Contract Expiration Date') }}</th>
        @if(isset($actions) && $actions)
        <th>{{ __('Actions') }}</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{$employee->id}}</td>
            <td>{{$employee->name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{$employee->address}}</td>
            <td><a href="{{route('employees.show', $employee)}}">View Contract</a></td>
            <td>{{$employee->contract_date->format(config('app.date_format'))}}</td>
            <td>{{$employee->contract_expiration_date->format(config('app.date_format'))}}</td>
            @if(isset($actions) && $actions)
            <td>
                <x-actions :editUrl="route('employees.edit', $employee->id)" :deleteUrl="route('employees.destroy', $employee->id)" />
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
{{$employees->links()}}
