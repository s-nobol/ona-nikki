<template>
<div>
    <div class="row UserBaer">
    
    
    
        <div class="col-sm-3 card">
            <div class="row ">
                <div class="col-2 UserBar__icon">
                    <i class="fas fa-globe-americas fa-2x text__all"></i>
                </div>
                <div class="col-10  pr-0 pl-1">
                    <div class="card-body">
                        <span class="card-body_title bg__all" >合計射精回数</span> 
                        <h4 class="card-title ">
                            <span>{{ total_all }}</span><small>回</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        
        
    
        <div class="col-sm-3 card">
            <div class="row ">
                <div class="col-2 UserBar__icon">
                    <i class="fas fa-clock  fa-2x text__month"></i>
                </div>
                <div class="col-10  pr-0 pl-1">
                    <div class="card-body">
                        <span class="card-body_title bg__month">月間射精回数</span> 
                        <h4 class="card-title ">
                            <span>{{ total_month }}</span><small>回</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    
        
        
    
        <div class="col-sm-3 card">
            <div class="row ">
                <div class="col-2 UserBar__icon">
                    <i class="fas fa-cheese  fa-2x "></i>
                </div>
                <div class="col-10 pr-0 pl-1">
                    <div class="card-body">
                        <span class="card-body_title ">カロリー消費</span> 
                        <h4 class="card-title ">
                            <span>{{ total_calorie }}</span><small>cal</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    
        
        
    
        <div class="col-sm-3 card">
            <div class="row ">
                <div class="col-2 UserBar__icon">
                    <i class="fas  fa-yen-sign  fa-2x"></i>
                </div>
                <div class="col-10  pr-0 pl-1">
                    <div class="card-body">
                        <span class="card-body_title ">合計支援金</span> 
                        <h4 class="card-title">
                            <span>{{ total_donation }}</span><small>円</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
        
    </div>
</template>
<style type="text/css">
.UserBaer{
    /*padding: 0px;*/
}
.UserBar__icon{
    text-align: center;
    position: relative;
}
.UserBaer i{ 
    position: absolute;
    top: 30%;
    display: inline-block;
    
    padding: 10px;
    border-radius: 30px;
    color: white;
    background-color: rgba(255,75,75,1) ;
    
}
.card-body_title{
    padding: 2px 10px;
    border-radius: 15px;
    
}
.card-body{
    text-align: center;
    padding: 15px 0px;
}
.card-title {
    padding-left: 25px;
}
</style>
<script>

export default {
    props: {
        
        id: { type: String, required: false, default: 'name' },
        total_all: { type: Number, required: false, default: 0 },
        total_month: { type: Number, required: false, default: 0 },
        total_calorie: { type: Number, required: false, default: 0 },
        total_donation: { type: Number, required: false, default: 0 },
        
        
    },
    
}
</script>
