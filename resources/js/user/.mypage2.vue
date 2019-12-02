
        
        <!--チャートを入力-->
        <!--<div class="card">-->
        <!--    <ul class="Statusbar">-->
        <!--        <li class="Statusbar__item">-->
        <!--            <span class="Statusbar__item__title">今月の射精回数</span>-->
        <!--            <span class="Statusbar__item__content">-->
        <!--                {{ month_data_total }}-->
        <!--                <small>回</small>-->
        <!--            </span>-->
        <!--        </li>-->
        <!--        <li class="Statusbar__item">-->
        <!--            <span class="Statusbar__item__title">本日の射回数</span>-->
        <!--            <span class="Statusbar__item__content">-->
        <!--                {{ 2 }}-->
        <!--                <small>回</small>-->
        <!--            </span>-->
        <!--        </li>-->
        <!--        <li class="Statusbar__item">-->
        <!--            <span class="Statusbar__item__title">平均精回数</span>-->
        <!--            <span class="Statusbar__item__content">-->
        <!--                {{ 15 }}-->
        <!--                <small>Ave</small>-->
        <!--            </span>-->
        <!--        </li>-->
        <!--        <li class="Statusbar__item">-->
        <!--            <span class="Statusbar__item__title">合計支援金</span>-->
        <!--            <span class="Statusbar__item__content">-->
        <!--                {{ month_data_total * 5  }}-->
        <!--                <small>円</small>-->
        <!--            </span>-->
        <!--        </li>-->
        <!--        <li class="Statusbar__item">-->
        <!--            <span class="Statusbar__item__title">消費カロリー</span>-->
        <!--            <span class="Statusbar__item__content">-->
        <!--                {{ month_data_total * 48 }}-->
        <!--                <small>cal</small>-->
        <!--            </span>-->
        <!--        </li>-->
        <!--    </ul>-->
        <!--</div>-->
    
        
        <!--今月のデータグラフ-->
        <!--<div class="card">-->
        <!--    <h1><i class="fas fa-braille fa-lg"></i><i class="fas fa-th"></i>グラフ(棒・折れ線)</h1>-->
        <!--    <div>-->
        <!--        <span @click="selectTab('month')">今月</span>-->
        <!--        <span @click="selectTab('year')">年間</span>-->
        <!--        <span @click="selectTab('all')">すべて</span>-->
        <!--    </div>-->
        <!--    <div class="row">-->
        <!--        <div class="col-9">-->
        <!--            <div class="tab">-->
        <!--                <Bar -->
        <!--                :dataSet="data"-->
        <!--                :labels="data_label"-->
        <!--                />-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="col-3"> -->
        <!--            <Doughnut -->
        <!--                :dataSet="data"-->
        <!--                :labels="data_label"-->
        <!--            />-->
        <!--            <Doughnut -->
        <!--                :dataSet="data"-->
        <!--                :labels="data_label"-->
        <!--            />-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
                          
        
               
        <!--今月と先月の比較-->
        <!--<div class="row ">-->
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>月別射精回数</span>-->
        <!--            <strong>{{ last_month_data_total }}回</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>{{ (month_data_total / last_month_data_total  -1 ) * 100 }}<small>%</small></span>-->
        <!--        </div>-->
        <!--    </div>-->
            
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>平均射精回数</span>-->
        <!--            <strong>{{ msg }}回</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>{{ msg }}<small>%</small></span>-->
        <!--        </div>-->
        <!--    </div>-->
            
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>利用日数</span>-->
        <!--            <strong>{{ last_month_data_label.length }}回</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>{{ (month_data_label.length / last_month_data_label.length  -1 ) * 100 }}-->
        <!--            <small>%<i class="fas fa-level-up-alt"></i></small></span>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>ランキング</span>-->
        <!--            <strong>Lv.{{ msg }}</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>{{ msg }}<small>位</small></span>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
               
        <!--今月と先月の比較-->
        <!--<div class="row">-->
        <!--    <div class="col-3 card StatusCard">-->
            
        <!--        <div class="StatusCard__title">-->
        <!--            <span class="">消費カロリー指数</span>-->
        <!--            <strong>先月{{ last_month_data_total * 48 }}cal</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>{{ month_data_total * 48 }}<small>cal</small></span>-->
        <!--        </div>-->
        <!--    </div>-->
            
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>支援金</span>-->
        <!--            <strong>先月￥{{ last_month_data_total * 5 }}円</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>￥{{  month_data_total * 5  }}<small>円</small></span>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>ランキング</span>-->
        <!--            <strong>{{ msg }}</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <small>15位</small><i class="fas fa-arrow-right "></i><small>8位</small>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-3 card StatusCard">-->
        <!--        <div class="StatusCard__title">-->
        <!--            <span>レベル</span>-->
        <!--            <strong>Lv.{{ msg }}</strong>-->
        <!--        </div>-->
        <!--        <div class="StatusCard__content">-->
        <!--            <span>{{ msg }}<small>.Lv</small></span>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
               
        <!--3つのグラフ-->
        <!--<div class="row">-->
        <!--    <div class="col-4 card">-->
               
        <!--        <div class="Chart_title">-->
        <!--            <span><i class="fas fa-chart-bar fa-lg"></i>平均利用日数推移</span>-->
        <!--            <span>{{ active_data[0] }} 日</span>-->
        <!--        </div>-->
        <!--        <div class="Chart_content ">-->
        <!--        </div>-->
       
        <!--    </div>-->
        <!--    <div class="col-4 card">-->
        <!--        <div class="Chart_title">-->
        <!--            <span><i class="fas fa-chart-pie fa-lg"></i>利用日数</span>-->
        <!--            <span>{{ active_data[0] }} 日</span>-->
        <!--        </div>-->
        <!--        <div class="Chart_content ">-->
        <!--            <div class="DoughnutChart">-->
        <!--                <Doughnut -->
        <!--                    :dataSet="active_data"-->
        <!--                    />-->
        <!--                <span class="DoughnutChart__content">{{ active_data[0]  }} </span>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-4 card">-->
        <!--        <div class="Chart_title">-->
        <!--            <span><i class="fas fa-cloud-sun fa-lg"></i>時間帯別利用グラフ</span>-->
        <!--        </div>-->
        <!--        <div class="Chart_content ">-->
        <!--            <Bar -->
        <!--                id="time"-->
        <!--                :dataSet="time_data"-->
        <!--                :labels="time_data_label"-->
        <!--            />-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
       
        <!--<div class="row">-->
        <!--    <div class="col-6 card">-->
        <!--        <div class="Chart_title">-->
        <!--            <span><i class="fas fa-sitemap fa-lg"></i>カテゴリー別利用データ</span>-->
        <!--            <span> ( {{ category_data.length }} ) </span>-->
        <!--        </div>-->
        <!--        <div class="Chart_content">-->
        <!--            <BarHorizontal -->
        <!--                :dataSet="category_data"-->
        <!--                :labels="category_data_label"-->
        <!--            />-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-6 card">-->
        <!--        <div class="Chart_title">-->
        <!--            <span>最新のデータ</span>-->
                    <!--<span>{{ active_data[0] }} 日</span>-->
        <!--        </div>-->
        <!--        <div class="Chart_content ">-->
        <!--            <Table  :dataSet="new_data" />-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->