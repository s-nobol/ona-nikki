@extends('app')

@section('content')

    
<!--メイン-->
<div>

    <h2>user/show</h2>
    <a href="{{ url('users/'.$user->id.'/edit')  }} " class="btn btn-success">編集</a>


</div>
        
        
@endsection
