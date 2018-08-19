<template>
<div class="row">
    <div class="col-md-3 list-contactos list-group list-group-flush">
        <contactlist-component v-on:selectConversation="changeConversation($event)">

        </contactlist-component>
    </div>
    <div class="col-md-7">
        <conversacion-component
          v-if="selectConversation"
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
  components:{
    ContactListComponent : 'contactlist-component',
    SideListComponent : 'sidelist-component'
  },
  data:function(){
    return{
      selectConversation: null
    }
  },
  mounted:function(){
    Echo.channel('example')
    .listen('MessageSent',function(e){
        console.log(e);
    });
  },
  methods:{
    changeConversation:function(conversation){
      this.selectConversation = conversation
    }
  }
}
</script>
