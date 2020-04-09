<a href="{{ $editUrl }}" class="btn btn-primary float-left mr-1">{{__('Edit')}}</a>
<form action="{{ $deleteUrl }}" method="POST">
    @csrf
    {{ method_field('DELETE') }}
    <button type="submit" onclick="return confirm('{{__('Are you sure?')}}')" class="btn btn-danger">{{__('Delete')}}</button>
</form>
