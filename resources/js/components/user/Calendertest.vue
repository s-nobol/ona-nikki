<template>
    <div>
            
            
                
    </div>
</template>
<script>
export default {
     props:{
        labels: {
            type: Array,
            require: true,
            default: () => []
        },
    },
    data(){
        return{
            month_data:[],
            day_data:[]
        }
    },
    methods:{
        createCalender(){ 
            var Month_last_day = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            Month_last_day = Month_last_day.getDate()
            
            for (var i = 0; i < Month_last_day; i++ ) {
                month_data[i] = i;
            }
        },
        setDayData(){
            var month_data_length = month_data.length 
            var counter = 0 //iを可変できるようにする
            for (var i = 0; i < day_data; i++ ) {
                for (counter = 0; counter< month_data_length ;　counter++ ) {
                    
                    if(day_data.getDate() === month_data[i]){
                        console.log(day_data.getDate())
                        month_data[i].actived = true
                        i = month_data_length
                        
                    }
                    
                }
            }
            //データは 1日, 3日, 6日, 4日, 8日, 12日と順番にくる
            // つまり 1日を超えると1日は計算しない、3日を超えると3日未満はカウントしなくてもよい
            //counter を設定することで日付の更新回にカウンターを更新させる
            
            
        }
    }
}
</script>