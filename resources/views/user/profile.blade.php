@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <table class="table table-hover mt-2">
                <thead class="thead-light">
                    <tr>
                        <th>ニックネーム</th>
                        <th>url</th>
                        <th>プロフィール</th>
                        <th>投稿数</th>
                        <th>フォロー数</th>
                        <th>フォロワー数</th>
                        <th>twitter</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $profile['nickname'] }}</td>
                        <td>{{ $profile['urlname'] }}</td>
                        <td>{{ $profile['profile'] }}</td>
                        <td>{{ $profile['noteCount'] }}</td>
                        <td>{{ $profile['followingCount'] }}</td>
                        <td>{{ $profile['followerCount'] }}</td>
                        <td>{{ $profile['twitter'] ?? '設定なし' }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection