@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="{{ route('tag.index') }}">タグ一覧へ戻る</a>

            <h2>タグ「{{$name}}」がついている記事一覧</h2>

            <table class="table table-hover mt-2">
                <thead class="thead-light">
                    <tr>
                        <th>題名</th>
                        <th>作成日</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at->format('m/d H:i') }}</td>
                        <td><a href="https://note.com/{{ $noteurl }}/n/{{ $article->key }}" target="_blank"
                                rel="noopener noreferrer">noteで開く</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection