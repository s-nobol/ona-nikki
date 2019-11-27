<template>
    <div >
        <div v-if="dataSet" class="ranker">
            <ul v-for="user,index in dataSet" class="ranker__item">
            
                <li class="ranker__item__number">
                    <span>{{ index +1 }}</span>
                </li>
                <li class="ranker__item__image">
                    <img v-if="user.image" src="/image/noimage.jpg"></img>
                    <img v-else="user.image" src="/image/noimage.jpg"></img>
                </li>
                <li class="ranker__item__user">
                    <h3 class="user_name">{{ user.name }}</h3>
                    <span class="user_level">Lev.{{ user.level }}</span>
                </li>
                <li class="ranker__item__count">
                    <span class="p-2 bg-danger">{{ user.count }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>
<style type="text/css">
.ranker{
}
.ranker__item{
    text-align: left;
    padding: 0px;
    margin: 0px;
    cursor: pointer;
    border-bottom: solid gainsboro 1px;
}
.ranker__item__number{
  display: inline-block;
  padding: 14px;
}
.ranker__item__image{
    display: inline-block; 
}
.ranker__item__image img{
    border-radius: 35px;
    /*overflow: hidden;*/
    width: 35px;
}
.ranker__item__user{
  display: inline-block;
  padding: 14px;
  position: relative;
  
}
.user_name{
    position: absolute;
    top: 30%;
    font-size:16px;
    margin: 0px;
    font-weight: bold;
    width:100px;
}
.user_level{
    margin: 0px;
    position: absolute;
    top: 90%;
    margin-left: 5px;
    width:100px;
}
.ranker__item__count{
  display: inline-block;
  padding: 14px;
  float: right;
    
}
</style>
<script>

export default {
    props: {
        // エラーが出るので配列は一行まで
        dataSet: {
            type: Array,
            required: false,
            default: () => []
        },
    },
    watch: {
        dataSet: function(dataSet){
            console.log(dataSet)
        }
    },
}
</script>
