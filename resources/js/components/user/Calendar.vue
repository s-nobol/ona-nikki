<template>
    <div>
            
            <!--カレンダー起動確認済み-->
            <v-date-picker
                v-model="labels"
                :color="color"
                mode="multiple"
                :update-on-input='false'
                is-inline
            />
            
            
            <!--カレンダーうまく起動しない-->
            <!--<v-calendar-->
            <!--    :attributes="attributes"-->
            <!--    :color="color"-->
            <!--    is-inline-->
            <!--/>-->
                
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
            attributes: [{
                highlight: true,
                dates: [this.labels],
            }],
            color: 'red',
        }
    },
}
</script>