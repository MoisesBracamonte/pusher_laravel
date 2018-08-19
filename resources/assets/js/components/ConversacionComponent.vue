<template>
  <div class="row">
    <div class="col-md-12 conver">
        <transition-group name="bounce" class="list-complete" tag="p">
        <MessageComponent 
       class="list-complete-item"
        v-for="(message,key) in messages"
        :key="key"
        :written-by-me='message.written_by_me'>
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
<script>
import axios from 'axios';
import MessageComponent from './MessageComponent.vue';
export default {
    components:{
        MessageComponent
    },
    props:{
        contactId : Number
    },
    data:function(){
        return{
            messages : [],
            message : '',
        }
    },
    mounted:function(){
        this.getMessages()
    },
    watch : {
        contactId:function(identity){
            console.log("CONTACT ID => "+identity);
            this.getMessages()
        }
    },
    methods:{
        getMessages:function(){
            axios.get(`/api/messages?contact_id=${this.contactId}`)
            .then(response => {
                this.messages = response.data;            
            }).catch(error => {
                console.log(error);
            })
        },

        postMessage:function(){
            let myForm = document.getElementById('form-message');
            let formData = new FormData(myForm);
            formData.append('to_id',this.contactId);
            axios.post(`/api/messages`,formData)
            .then(response=>{
                if(response.statusText == 'OK'){
                    this.message='';
                    this.getMessages();      
                }
            }).catch(error=>{
                console.log(error);
            })
            
        }
    }
  
}
</script>

