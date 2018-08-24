<template>
  <div class="row">
    <div class="col-md-12 conver">
        <transition-group name="bounce" class="list-complete" tag="p">
        <MessageComponent 
       class="list-complete-item"
        v-for="(message,key) in messages"
        :key="key"
        :written-by-me='message.written_by_me'
        :my-image="message.written_by_me ? getUser.image_perfil : selectedConversation.image_perfil">
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
    data(){
        return{
            message:''
        }
    },
    computed:{
        messages(){
            return this.$store.state.messages;
        },
        selectedConversation(){
            return this.$store.state.selectConversation;
        },
        getUser(){
            return this.$store.state.user
        }
    },
    watch:{
        messages(){
            setTimeout(() => {
                this.scrollBottom()
            }, 200);
        }
    },
    mounted(){
      console.log(this.getUser);
        
    },
    methods:{
        postMessage(){
            let myForm = document.getElementById('form-message');
            this.$store.dispatch('postMessage',myForm)
            this.message='';
        },
        scrollBottom:function(){
            let element = document.querySelector('.conver');
            element.scrollTop = element.scrollHeight;            
        }
    }
  
}
</script>

