<template>
<div class="row">
    <div class="col-md-3 list-contactos list-group list-group-flush">
        <contactlist-component v-on:selectConversation="changeConversation($event)">

        </contactlist-component>
    </div>
    <div class="col-md-7">
        <conversacion-component
          v-if="selectConversation"
          :messages="messages"
          :contact-id="selectConversation.contact_id"
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
      messages:[]
    }
  },
  mounted(){
    let self  = this;
    Echo.channel('example')
    .listen('MessageSent',function(data){
      let m = data.message;
      m.written_by_me = (self.userId == m.from_id)
      self.messages.push(m);
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
  }
}
</script>
