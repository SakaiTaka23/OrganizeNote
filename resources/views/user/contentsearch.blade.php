@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="GET" action="{{ route('searchContent') }}">
                <div class="form-group row">

                    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('目次：') }}</label>
                    <div class="col-md-6">
                        <input id="content" type="text" class="form-control" name="content" value="{{ $content ?? '' }}"
                            autofocus>
                    </div>

                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </form>

            <div class="d-flex justify-content-center">
                {{ $contents->appends(request()->input())->links() }}
            </div>

            <table class="table table-hover mt-2">
                <thead class="thead-light">
                    <tr>
                        <th>目次</th>
                        <th>元ページ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                    @foreach ($content->articles as $article)
                        
                    <tr>
                        <td>{{ $content->name }}</td>
                        <td>{{ $article->title }}</td>
                        <td><a href="https://note.com/{{ $noteurl }}/n/{{ $article->key }}" target="_blank"
                                rel="noopener noreferrer">noteで開く</a></td>
                    </tr>

                    @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection