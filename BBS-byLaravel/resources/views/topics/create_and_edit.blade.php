@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/simditor.css') }}" type="text/css">
@stop

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class=" card">

            <div class="card-header">
                <h2 class="text-center">
                    <i class="fa fa-edit"></i>
                    @if($topic->id)
                        编辑话题
                    @else
                        新建话题
                    @endif
                </h2>
            </div>

            @include('common.error')

            <div class="card-body">
                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                    <div class="form-group">
                        <label for="title-field">主题</label>
                        <input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required />
                    </div>

                    <div class="form-group">
                        <label for="category_id-field">分类信息</label>
                        <select class="form-control" name="category_id" id="category_id-field" required>
                            <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $topic->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                                <label for="body-field">内容</label>
                                <textarea name="body" id="editor" class="form-control" rows="3" required placeholder="请至少写三个字的内容">{{ old('body', $topic->body ) }}</textarea>
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle pr-2"></span>保存</button>
                        <a class="btn btn-link pull-right" href="{{ route('topics.index') }}"><i class="fa fa-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.js') }}"></script>

    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('topics.upload_image') }}',
                    params: { _token: '{{ csrf_token() }}' },
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>
@stop