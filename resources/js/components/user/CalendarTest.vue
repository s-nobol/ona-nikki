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
            <span v-for="item in days_title" class="Calender__item">{{ item }}</span>
            
            <span v-for="item in before_days" class="Calender__item">X</span>
            <span 
                v-for="item in month_data" 
                class="Calender__item"
            ><span :class="{ 'Calender__item__select ' : item.actived }">{{ item.number }}</span></span>
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
        dataSet: {
            type: Array,
            require: true,
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
            console.log("月初め",before_days)
            for (var i = 0; i < before_days ; i++ ) {
                this.before_days.push(i)
            }
            
            // 月末のデータ
            var Month_last_day = new Date(this.date.getFullYear(),this.date.getMonth() + 1, 0).getDate();
            for (var i = 0; i < Month_last_day; i++ ) {
                let  hash = { 'number': i+1, 'actived': false, 'other': 'その他' }
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
            
        }
    },
    
    watch: {
        dataSet: function(dataSet){
        // console.log("カレンダーの変更", this.dataSet)
            this.getDataSet()
         }   
    },
    created(){
        // console.log("カレンダーの起動", this.date)
        this.createCalender()
    }
}
</script>