@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex flex-column">
                <div class="font-weight-bolder my-3">
                    <h1>{{ $profile['nickname']}}</h1>
                </div>
                <div class="mb-2">
                    <h2>note ID:{{ $profile['urlname']}}</h2>
                </div>
                <div class="mb-4">{{ $profile['profile'] }}</div>
                <div class="d-flex flex-row mb-3">
                    <div class="ml-1 mr-5 row"><div class="font-weight-bold">{{ $profile['noteCount'] }}</div>記事</div>
                    <div class="mr-5 row"><div class="font-weight-bold">{{ $profile['followingCount'] }}</div>フォロー</div>
                    <div class="mr-5 row"><div class="font-weight-bold">{{ $profile['followerCount'] }}</div>フォロワー</div>
                </div>
                <div class="">Twitter {{ $profile['twitter'] ?? '設定なし' }}</div>
            </div>

        </div>
    </div>
</div>
@endsection