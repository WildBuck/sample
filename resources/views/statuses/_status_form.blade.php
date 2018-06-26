<form action="{{ route('statuses.store') }}" method="post">
    @include('shared._errors')
    {{ csrf_field() }}
    <textarea rows="3" class="form-control" name="content" placeholder="聊聊新鲜事...">{{ old('content') }}</textarea>
    <button type="submit" class="btn btn-primary pull-right">发布</button>
</form>