@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
            
            <table class="table table-hover mt-2">
                <thead class="thead-light">
                    <tr>
                        <th>題名</th>
                        <th>作成日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at->format('m/d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection