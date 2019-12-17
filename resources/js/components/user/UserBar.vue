<template>
<div>
    <div class="row UserBaer">
    
    
    
        <div class="col-3 card">
            <div class="row ">
                <div class="col-3 text-center">
                    <i class="fas fa-globe-americas fa-2x bg__total"></i>
                </div>
                <div class="col-9">
                    <div class="card-body">
                        <span >合計射精回数</span> 
                        <h4 class="card-title ">
                            <span>1580</span><small>回</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        
        
    
        <div class="col-3 card">
            <div class="row ">
                <div class="col-3 text-center">
                    <i class="fas fa-clock  fa-2x bg__total"></i>
                </div>
                <div class="col-9">
                    <div class="card-body">
                        <span >月間射精回数</span> 
                        <h4 class="card-title ">
                            <span>180</span><small>回</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    
        
        
    
        <div class="col-3 card">
            <div class="row ">
                <div class="col-3 text-center">
                    <i class="fas fa-cheese  fa-2x bg__total"></i>
                </div>
                <div class="col-9">
                    <div class="card-body">
                        <span >カロリー</span> 
                        <h4 class="card-title ">
                            <span>68</span><small>cal</small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    
        
        
    
        <div class="col-3 card">
            <div class="row ">
                <div class="col-3 text-center">
                    <i class="fas  fa-yen-sign  fa-2x bg__total"></i>
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
        
    </div>
</template>
<style type="text/css">
.UserBaer{
}
.UserBaer i{ 
    display: inline-block;
    vertical-align: top;
    margin-top: 80%;
}
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
