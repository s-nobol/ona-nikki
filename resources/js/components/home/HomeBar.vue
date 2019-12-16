<template>
    <div>
            
            <!--今月のトータル-->
            <div class="card_item card">
                <div class="row ">
                    <div class="col-3 text-center">
                        <i class="fas fa-globe-americas fa-2x bg__total"></i>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >月間射精回数</span> 
                            <h4 class="card-title ">
                                <span>1580</span><small>回</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        
            <!--日別合計射精回数-->
            <div class="card_item card">
                <div class="row ">
                    <div class="col-3 text-center">
                        <i class="far fa-clock fa-2x"></i>
                        <!--<i class="fas fa-clock fa-2x"></i>-->
                        <!--<i class="fas fa-globe-americas fa-2x"></i>-->
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >日別射精回数</span> 
                            <h4 class="card-title">
                                <span>548</span><small>回</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        
        
            <!--男性利用者数-->
            <div class="card_item card ">
                <div class="row ">
                    <div class="col-3 text-center">
                        
                            <i class="fas fa-male fa-2x bg__man "></i>
                    
                    </div>
                    <div class="col-9">
                        <div class="card-body ">
                            <span >男性利用数</span> 
                            <h4 class="card-title ">
                                <span>578</span><small>人</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <!--女性利用者数-->
            <div class="card_item card ">
                <div class="row ">
                    <div class="col-3 text-center">
                        <i class="fas fa-female fa-2x bg__woman"></i>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >女性利用数</span> 
                            <h4 class="card-title ">
                                <span >78</span><small>人</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>  
            
            
            <!--募金合計金額-->
            <div class="card_item card ">
                <div class="row ">
                    <div class="col-3 text-center ">
                    <i class="fas fa-yen-sign fa-2x bg__green"></i>                    
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >合計支援金</span> 
                            <h4 class="card-title ">
                                <span>688</span><small>円</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
    
    </div>
</template>
<style type="text/css">

.card_item{
    display: inline-block;
    width:19.8%;
    height: 120px;
    background-color:  white;
    margin-left:  -1px;
    color: gray;
    /*text-align: center;*/
}

.card_item i{
    margin-top: 35px;
    margin-left: 25%;
    padding: 10px 0px;
    width: 50px;
    color: white;
    background-color: tomato;
    border-radius: 55px;
}

.card-title{
    text-align: center;
}
.card-title span{
    color: black;
    font-size: 35px; 
    font-weight: bold;
}

/*.bg__total{*/
/*    background-color: dodgerblue;*/
/*}*/
/*.bg__man{*/
/*    background-color: dodgerblue;*/
/*}*/
/*.bg__woman{*/
/*    background-color: crimson;*/
/*}*/
/*.bg__green{*/
/*    background-color: mediumseagreen;*/
/*}*/

</style>
<script>

export default {
    props: {
        
        total_count: { type: Number, required: false, default: null },
        id: { type: String, required: false, default: 'name' },
        woman_count: { type: Number, required: false, default: null },
        man_count: { type: Number, required: false, default: null },
        donation_count: { type: Number, required: false, default: null },
        
        
    },
    
}
</script>
