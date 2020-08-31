@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="GET" action="{{ route('searchArticle') }}">
                <div class="form-group row">

                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('題名：') }}</label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ $title ?? '' }}"
                            autofocus>
                    </div>

                    <label for="datefrom" class="col-md-4 col-form-label text-md-right">{{ __('期間：')}}</label>
                    <div class="col-md-6">
                        <input id="datefrom" type="date" class="form-control" name="datefrom"
                            value="{{ $dates['from'] ?? '' }}" autofocus>
                    </div>

                    <label for="dateto" class="col-md-4 col-form-label text-md-right">{{ __('〜')}}</label>
                    <div class="col-md-6">
                        <input id="dateto" type="date" class="form-control" name="dateto"
                            value="{{ $dates['to'] ?? '' }}" autofocus>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>

            <div class="d-flex justify-content-center">
                {{ $articles->appends(request()->input())->links() }}
            </div>

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