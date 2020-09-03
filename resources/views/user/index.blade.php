@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="GET" action="{{ route('searchArticle') }}">
                <div class="form-group row">

                    <label for="title" class="col-md-4 col-form-label text-md-right mb-2">{{ __('題名：') }}</label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ $title ?? '' }}"
                            autofocus>
                    </div>

                    <label for="datefrom" class="col-md-4 col-form-label text-md-right mb-2">{{ __('期間：')}}</label>
                    <div class="col-md-6">
                        <input id="datefrom" type="date" class="form-control" name="datefrom"
                            value="{{ $dates['from'] ?? '' }}" min="2014-04-07" max="{{ $today }}" autofocus>
                    </div>

                    <label for="dateto" class="col-md-4 col-form-label text-md-right">{{ __('〜')}}</label>
                    <div class="col-md-6">
                        <input id="dateto" type="date" class="form-control" name="dateto"
                            value="{{ $dates['to'] ?? '' }}" min="2014-04-07" max="{{ $today }}" autofocus>
                    </div>

                </div>

                <div class="d-flex justify-content-around">
                    <button type="button" onclick="window.reset()" class="btn btn-outline-danger">リセット</button>
                    <button type="submit" onclick="window.checkdate()" class="btn btn-outline-success">検索</button>
                </div>
            </form>

            <div class="d-flex justify-content-center">
                {{ $articles->appends(request()->input())->links() }}
            </div>

            <table class="table table-borderless table-hover mt-2">
                <thead>
                    <tr>
                        <th>題名</th>
                        <th class="row">作成日</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at->format('m/d H:i') }}</td>
                        <td class="row"><a href="https://note.com/{{ $noteurl }}/n/{{ $article->key }}" target="_blank"
                                rel="noopener noreferrer">noteで開く</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

<script>
    function reset()
    {
    console.log('reset local');
    change = "";
    console.log(document.getElementById('title').value);
    document.getElementById('title').value = change;
    document.getElementById('datefrom').value = "";
    document.getElementById('dateto').value = "";
    }
    
    function checkdate()
    {
    console.log('check');
    from = document.getElementById('datefrom').value;
    to = document.getElementById('dateto').value;
    if (from > to)
    {
    tmp = from;
    document.getElementById('datefrom').value = to;
    document.getElementById('dateto').value = tmp;
    }
    }
</script>