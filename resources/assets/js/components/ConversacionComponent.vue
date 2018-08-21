<template>
  <div class="row">
    <div class="col-md-12 conver">
        <transition-group name="bounce" class="list-complete" tag="p">
        <MessageComponent 
       class="list-complete-item"
        v-for="(message,key) in messages"
        :key="key"
        :written-by-me='message.written_by_me'
        :my-image="message.written_by_me ? imageUser : imageContact">
        {{message.content}}
        </MessageComponent>
        </transition-group>
    </div>
    <div class="col-md-12">
        <form v-on:submit.prevent="postMessage" id="form-message">
            <div class="input-group">
                <input type="text" v-model="message" class="form-control text-center" placeholder="Comentar ... "  name="content" autocomplete="off" >
                <div class="input-group-append">
                    <input type="submit" class="btn btn-outline-secondary" value="Button">
                </div>
            </div>
        </form>
    </div>
</div>
</template>
<style>
.conver{
    max-height: 590px;
    overflow-y: scroll;
}
</style>

<script>
import axios from 'axios';
import MessageComponent from './MessageComponent.vue';
export default {
    components:{
        MessageComponent
    },
    props:{
        messages:Array,
        contactId :Number,
        imageContact:String,
        imageUser:String
    },
    data(){
        return{
            message:''
        }
    },
    watch:{
        messages(){
            setTimeout(() => {
                this.scrollBottom()
            }, 200);
        }
    },
    methods:{
        postMessage(){
            let myForm = document.getElementById('form-message');
            let formData = new FormData(myForm);
            formData.append('to_id',this.contactId);
            axios.post(`/api/messages`,formData)
            .then(response=>{
                if(response.statusText == 'OK'){
                    let m = response.data;
                    this.message='';
                    m.written_by_me = true;
                    this.$emit('createdMessage',m)
                }
            }).catch(error=>{
                console.log(error);
            })
        },
        scrollBottom:function(){
            let element = document.querySelector('.conver');
            element.scrollTop = element.scrollHeight;            
        }
    }
  
}
</script>

