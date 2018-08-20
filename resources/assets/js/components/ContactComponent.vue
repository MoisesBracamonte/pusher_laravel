<template>
<div :class="`list-group-item ${variant}`">
    <div class="row inf-cont mt-1 ">
        <div class="col-md-3 col-sm-3">
            <img src="https://picsum.photos/200/300" class="rounded-circle img-cont" alt="">
        </div>
        <div class="col-md-6  col-sm-6 d-none d-md-block">
            <span>{{conversation.contact_name}}</span>
            <small id="" class="form-text text-muted" >{{conversation.last_message}}</small>
        </div>
        <div class="col-md-3 col-sm-3 d-none d-md-block">
            <small id="" class="form-text text-muted float-right">{{lastTime}}</small>
        </div>
    </div>
</div>
</template>
<script>
    export default {
        props:{
            variant: String,
            conversation : Object
        },
        computed:{
            lastTime:function(){
                return moment(this.conversation.last_time,"YYYY-MM-DD hh:ms:ss").locale('es').fromNow();
            }
        }
    }
</script>
