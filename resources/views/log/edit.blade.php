@extends('app')

@section('content')

    
<!--メイン-->
<div>

    <h2>log/edit</h2>
    <form action="{{ url('logs', $log->id ) }}" method="POST">
        @csrf
        @method('put')
        
        <div>
            <label for="">カテゴリー</label><br>
            <input type="text" name="category" class="" value="{{  $log->category }}" />
        </div>
        
        <div>
            <label for="">コメント</label><br>
            <input type="text" name="comment" class="" value="{{ $log->comment }}"/>
        </div>
        <div>
            <input type="submit" value="送信" class=" btn btn-success"/>
        </div>
    </form>
    

</div>
        
        
<!--</div>-->
@endsection
