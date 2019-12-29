<template>
<div class="card">
            
            <h4 class=" p-3">Twitterタイムライン</h4>
            
            <div class="">
                <span>Twitterタイムライン</span>
                
                <!--<a class="twitter-timeline"  href="https://twitter.com/hashtag/%E6%B4%B2%E5%B4%8E%E8%A5%BF" data-widget-id="777064933750026240">#洲崎西 のツイート</a>-->
                
                <a class="twitter-timeline" href="https://twitter.com/BarackObama?ref_src=twsrc%5Etfw">Tweets by BarackObama</a> 
               
                   <v-timeline
                      :id="twitterId"
                      :source-type="'profile'"
                      :options="{ 'height': twitterHeight }" />
            </div>
       

</div>
</template>
<style type="text/css">
</style> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script>!function(d,s,id){
var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<script>

// import Timeline from 'vue-tweet-embed/timeline'

// export default{
//   components: {
//     'v-timeline': Timeline,
//   },
//   data() {
//     return {
//       twitterId: 'tsuka_rinorino',
//       twitterHeight: '400',
//     }
//   },    
// }
</script>
