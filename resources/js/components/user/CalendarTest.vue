<template>
    <div>
            
        <!--年月-->
        <div class="Calender__header">
            <span>{{ date.getYear() +1900 }}年</span>
            <span v-if="! dateInputString">{{ date.getMonth() +1  }}月</span>
            <span v-if=" dateInputString">{{ date.getMonth() }}月</span>
        </div>
            
        <!--日曜日～土曜日-->
        <div class="Calender__content">
        
            <!--日曜日から土曜日-->
            <span v-for="item in days_title" 
            class="Calender__item" 
            :class="{ 'text__red' : item === '日',  'text-primary' : item === '土'}">{{ item }}</span>
            
            <!--先月末から今月末（31まで）-->
            <span v-for="item in before_days" class="Calender__item  before__day ">{{ item }}</span><span 
                v-for="item in month_data" 
                class="Calender__item "
            ><span :class="{ 'Calender__item__select ' : item.actived }" @click="onClickItem(item)">{{ item.number }}</span></span>
        </div>
                
    </div>
</template>
<style type="text/css">
.Calender__header{
    text-align: center;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    border-bottom: 1px solid gainsboro;
}
.Calender__content{
    margin-top: 10px;
    margin-bottom: 15px;
}
.before__day{
    color: silver;
}
.Calender__item{
    text-align: center;
    display: inline-block;
    width: 14.28%;
    height: 30px;
    line-height: 30px;
}
.Calender__item__select{
    cursor: pointer;
    color: white;
    display: inline-block;
    width: 27px;
    height: 27px;
    line-height: 27px;
    background-color: rgba(255, 74, 74, 1);
    transition-duration: 0.3s;
    border-radius: 27px;
}

.Calender__item__select:hover{
    background-color: silver;
}
</style>
<script>
export default {
     props:{
        //日付のみのデータ（1,2,3...11,13...30,31）
        dataSet: {
            type: Array,
            require: true,
            default: () => []
        },
        //Mysql用のデータ（2019-12-25T15:00:00.00, 2019-12-25T15:00:00.00）
        dataSet2: {
            type: Array,
            require: false,
            default: () => []
        },
        date:{ 
            type: Date,　 
            require: false,　  
            default: function () { return new Date() }
        },
        
        dateInputString:{ 
            type: Boolean,　 
            require: false,　  
            default: false
        },
    },
    data(){
        return{
            days_title:['日','月','火','水','木','金','土'],
            before_days: [],
            month_data:[],
            day_data:[]
        }
    },
    methods:{
        createCalender(){
            var today = this.date.getDate()
            
            // 先月分のデータ
            var before_days =  new Date(this.date.getFullYear(),this.date.getMonth(), 1).getDay()
            var before_date = new Date(this.date.getFullYear(), this.date.getMonth() + 1, 0).getDate()
            // console.log("月初め",before_days, '月初め日付' , before_date)
            for (var i = before_days-1; i >= 0 ; i--){
            	this.before_days.push(before_date-i)
            }
            
            // 月末のデータ
            var Month_last_day = new Date(this.date.getFullYear(),this.date.getMonth() + 1, 0).getDate();
            for (var i = 0; i < Month_last_day; i++ ) {
                let  hash = { 
                    'number': i+1, 
                    'actived': false, 
                    'other': 'その他', 
                    'active_date': '', 
                }
                this.month_data.push(hash)
            }
            
        },
        getDataSet(){
            var month_data_length = this.month_data.length 
            var counter = 0 //iを可変できるようにする
            var day_data = this.dataSet
            for (var i = 0; i < day_data.length ; i++ ) {
                var day = day_data[i].getDate()-1;
                for (var j = 0+day; j < month_data_length ;　j++ ) {
                    if(day_data[i].getDate() === this.month_data[j].number){
                        this.month_data[j].actived = true
                    }
                }
            }
        },
        setActiveDate(){
            
            var month_data_length = this.month_data.length
            var day_data = this.dataSet2
            
            
            for (var i = 0; i < day_data.length ; i++ ) {
                
                // 利用した日にち
                var active_date = new Date(day_data[i])
                var day = active_date.getDate()-1;
                
                // もし今月の利用の場合
                if(this.date.getMonth() === active_date.getMonth()){
                    for (var j = 0 + day; j < month_data_length ;　j++ ) {
                        if(active_date.getDate() === this.month_data[j].number){
                            this.month_data[j].actived = true
                            this.month_data[j].active_date = active_date
                        }
                    }
                }
            }
        },
        onClickItem(item){
            var message = item.active_date.getFullYear() +'年'+ 
                            item.active_date.getMonth()+1 +'月'+ 
                            item.active_date.getDate() +'日'+' '+
                            item.active_date.getHours() +':'+
                            item.active_date.getMinutes() +'　に利用しました。'
            alert(message)
            console.log(item)
        }
        
    },
    
    watch: {
        // dataSet: function(dataSet){
        // // console.log("カレンダーの変更", this.dataSet)
        //     this.getDataSet()
        //  },
        dataSet2: function(dataSet2){
            console.log("データの取得",dataSet2)
            this.setActiveDate()
         }   
    },
    created(){
        // console.log("カレンダーの起動", this.date)
        this.createCalender()
    }
}
</script>