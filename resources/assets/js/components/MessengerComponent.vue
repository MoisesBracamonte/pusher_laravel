<template>
<div class="row">
    <div class="col-md-3 list-contactos list-group list-group-flush">
        <contactlist-component 
          v-on:selectConversation="changeConversation($event)"
          :conversations="conversations">
        </contactlist-component>
    </div>
    <div class="col-md-7">
        <conversacion-component
          v-if="selectConversation"
          :messages="messages"
          :contact-id="selectConversation.contact_id"
          v-on:createdMessage = "addMessage($event)"
        ></conversacion-component>
    </div>
    <div class="col-md-2 list-contacto list-group list-group-flush pr-0">
        <sidelist-component
        v-if="selectConversation"
        :contact-name="selectConversation.contact_name"
        ></sidelist-component>
    </div>
</div>
</template>
<script>
import ContactListComponent from './ContactListComponent.vue';
import SideListComponent from './SideListComponent.vue';
export default {
  props : {
    userId : Number
  },
  components:{
    ContactListComponent : 'contactlist-component',
    SideListComponent : 'sidelist-component'
  },
  data(){
    return{
      selectConversation: null,
      messages:[],
      conversations:[],
    }
  },
  mounted(){
    this.getConversation();
    let self  = this;
    Echo.private(`users.${self.userId}`)
    .listen('MessageSent',function(data){
      data.written_by_me = false;
        self.addMessage(data.message);
    });
  },
  methods:{
    changeConversation(conversation){
      this.selectConversation = conversation
      this.getMessages();
    },
    getMessages(){
        axios.get(`/api/messages?contact_id=${this.selectConversation.contact_id}`)
        .then(response => {
            this.messages = response.data;
        }).catch(error => {
            console.log(error);
        })
    },
    addMessage(message){
      let conversation = this.conversations.find(element => {
        if(element.contact_id == message.from_id){
          return element
        }else if(element.contact_id == message.to_id){
          return element
        }
      });
        let author = this.userId === message.from_id ? 'Tú' : conversation.contact_name
        conversation.last_message =`${author} : ${message.content}`;
        conversation.last_time = message.created_at;
      if(this.selectConversation.contact_id == message.from_id){
        this.messages.push(message);
      }else if(this.selectConversation.contact_id == message.to_id){
        this.messages.push(message);
      }
    },
    getConversation:function(){
      axios.get(`/api/conversations`)
      .then(response => {
          this.conversations = response.data
      }).catch(error => {
        console.log(error);
      })
    },

  }
}
</script>
