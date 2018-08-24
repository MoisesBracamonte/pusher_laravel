<template>
<div class="row">
    <div class="col-md-3 list-contactos list-group list-group-flush">
        <BuscadorComponent/>
        <contactlist-component />
    </div>
    <div class="col-md-7">
        <conversacion-component
          v-if="selectConversation"
          :contact-id="selectConversation.contact_id"
          :image-contact="selectConversation.image_perfil"
        ></conversacion-component>
    </div>
    <div class="col-md-2 list-contacto list-group list-group-flush pr-0">
        <sidelist-component
        v-if="selectConversation"
        :contact-name="selectConversation.contact_name"
        :image-perfil="selectConversation.image_perfil"
        ></sidelist-component>
    </div>
</div>
</template>
<script>
import ContactListComponent from './ContactListComponent.vue';
import SideListComponent from './SideListComponent.vue';
import BuscadorComponent from './BuscadorComponent.vue';

export default {
  props : {
    user : null,
  },
  components:{
    ContactListComponent : 'contactlist-component',
    SideListComponent : 'sidelist-component',
    BuscadorComponent
  },
  mounted(){
    this.$store.commit('getUser',this.user)
    this.$store.dispatch('getConversation')
    let self  = this;
    Echo.private(`users.${self.userId}`)
    .listen('MessageSent',function(data){
      data.written_by_me = false;
        self.addMessage(data.message);
    });
    Echo.join(`messenger`)
      .here((users) => { // Que usuario esta presente
        users.forEach(e => self.changeOnline(e,true))
      })
      .joining((user) => { // Que usuario acaba de ingresar
        self.changeOnline(user,true)
      }) 
      .leaving((user) => { // Que usuario acaba de salir
        self.changeOnline(user,false)
      });
  },
    computed:{
      selectConversation:function(){
        return this.$store.state.selectConversation
      }
    },
  methods:{
    changeOnline:function(user,status){
      let index = this.$store.state.conversations.findIndex(element =>{
        return element.contact_id == user.id
      });
      if(index >= 0){
        this.$set(this.$store.state.conversations[index],'online',status)
      }
    }
  }
}
</script>
