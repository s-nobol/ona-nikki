@extends('app')

@section('content')

    
<!--メイン-->
<div>

    <h2>log/index</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $logs as $log  )
            <tr>
                <th scope="row">{{ $log->id }}</th>
                <td>{{ $log->time }}</td>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->comment }}</td>
                <td>{{ $log->category }}</td>
                <td><a href="/logs/1/edit" class="btn btn-success">編集</a>
                <a href="/logs/1" class="btn btn-danger">削除</a>
                </td>
                </tr>
            <tr>
            @endforeach
        </tbody>
    </table>
    

</div>
        
        
<!--</div>-->
@endsection
