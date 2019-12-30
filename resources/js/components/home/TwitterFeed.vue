<template>
<div class="card">
  
        <!--タイムライン（現在サポートされていない）-->
        <!--  <div :index="i" v-for="(tw,i) in tweets" :key="tw.title">-->
        <!--    <v-timeline-->
        <!--    :id="tw.title"-->
        <!--    :source-type="'profile'"-->
        <!--    :options="{ 'height': twitterHeight }" />-->
        <!--  </div>-->
        
        
        
    <div class="Timeline ">
        <h4 class="p-3 border- m-0"><b>タイムライン</b></h4>
        <div class="Timeline__item ">
            <Tweet id="1210108158691012610"></Tweet>
            <Tweet id="1207499345789980672"></Tweet>
            <Tweet id="1211300252877115392"></Tweet>
            <Tweet id="1207499345789980672"></Tweet>
        </div>
    </div>
</div>
</template>
<style type="text/css">
.Timeline{
    max-height:350px;
    overflow-y: scroll;
    margin: 0px;
    padding: 0px;
    /*background-color: ;*/
}    
</style>
<script>
import { Tweet, Moment, Timeline } from 'vue-tweet-embed'
// import { Tweet } from 'vue-tweet-embed'
 
export default{
  components: {
    'v-timeline': Timeline,
    Tweet: Tweet
  },
  data() {
    return {
      twitterHeight: '400',
      tweets: []
    }
  },
  created() {
        // axios.get('https://twitter.com/Test2019501').then(response => {
        //         console.log('twitter',response);
        // })  
  }
}
</script>

