@extends('app')

@section('content')

    
<!--メイン-->
<div>

    <h2>user/show
    </h2>
    <a href="{{ url('users/'.$user->id.'/edit')  }} " class="btn btn-success">編集</a>

    <div class="row">
        <div class="col-6">
        
            <h3>＠てすと</h3>
        <span>lv.150</span>
        <div>次の目標まであと、、10回</div>
        <div>ランキング　155位</div>
                <ul class="data_list ">
                    <li class="data_list_item">
                        <strong class="data_list_item_title">総合射回数</strong>
                        <strong class="data_list_item_content">875<small>回</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">本日の射回数</strong>
                        <strong class="data_list_item_content">5<small>回</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">平均精回数</strong>
                        <strong class="data_list_item_content">85<small>.ave</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">合計支援金<small>※1</small></strong>
                        <strong class="data_list_item_content">152<small>円</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">消費カロリー<small>※2</small></strong>
                        <strong class="data_list_item_content">25<small>Cal</small></strong>
                    </li>
                </ul>
        
                <ul class="data_list ">
                    <li class="data_list_item">
                        <strong class="data_list_item_title">総合射時間</strong>
                        <strong class="data_list_item_content">875<small>回</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">本日の射回数</strong>
                        <strong class="data_list_item_content">5<small>回</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">平均精回数</strong>
                        <strong class="data_list_item_content">85<small>.ave</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">合計支援金<small>※1</small></strong>
                        <strong class="data_list_item_content">152<small>円</small></strong>
                    </li>
                    <li class="data_list_item">
                        <strong class="data_list_item_title">消費カロリー<small>※2</small></strong>
                        <strong class="data_list_item_content">25<small>Cal</small></strong>
                    </li>
                </ul>
                
                <!--オナニーした回数だけコマが進む-->
                <div>
                <h2>クエスト</h2>
                <img src="{{ asset('image/kuest.jpg' )}}" alt="">
                </div>
        
        </div>
        <div class="col-6"></div>
    </div>
                

    <div class="row">
        <div class="col-6">
            <h3>三角形▲　ランキング</h3>
        </div>
                
        <div class="col-6">
            <h3>カード</h3>
            <div class="card bg-danger p-4 mb-3">123132</div>
            <div class="card bg-danger p-4 mb-3">123132</div>
            <div class="card bg-danger p-4 mb-3">123132</div>
            <div class="card bg-danger p-4 mb-3">123132</div>
        </div>   
    </div>     

    <div class="row">
        <div class="col-6">
            <div class="card bg-light p-4 mb-3">123132</div>
            <div class="card bg-light p-4 mb-3">123132</div>
            <div class="card bg-light p-4 mb-3">123132</div>
            <div class="card bg-light p-4 mb-3">123132</div>
        </div>
                
        <div class="col-6">
            <div class="card bg-light p-4 mb-3">123132</div>
            <div class="card bg-light p-4 mb-3">123132</div>
            <div class="card bg-light p-4 mb-3">123132</div>
            <div class="card bg-light p-4 mb-3">123132</div>
        </div>   
    </div>
                


</div>
        
        
@endsection
