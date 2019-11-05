@extends('app')

@section('content')

    
<!--メイン-->
<div>

    <h2>user/edit</h2>
    <form action="{{ url('users', $user->id ) }}" method="POST">
        @csrf
        @method('put')
        <div>
            <label for="">level</label><br>
            <input type="text" name="level" value="{{ $user->level }}"/>
        </div>
        <div>
            <label for="">性別</label><br>
            <input type="text" name="sex" value="{{ $user->sex }}"/>
        </div>
        <div>
            <label for="">住所</label><br>
            <input type="text" name="address"  value="{{ $user->address }}"/>
        </div>
        <div>
            <input type="submit" value="保存" class="btn btn-primary"/>
        </div>
    </form>

</div>
        
        
<!--</div>-->
@endsection
