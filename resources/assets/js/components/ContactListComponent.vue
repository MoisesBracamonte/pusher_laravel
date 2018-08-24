<template>
  <div>
      <ContactComponent
        v-for="(conversation,key) in conversationsFiltered"
        :key="key"
        :variant="''"
        :conversation="conversation"
        v-on:click.native="selectConversation(conversation)"
        >
       </ContactComponent>
  </div>
</template>
<script>
import axios from 'axios';
import ContactComponent from './ContactComponent';
export default {
  components : {
    ContactComponent,
  },
  methods:{
    selectConversation:function(conversation){
      this.$store.dispatch('getMessages',conversation)
    }
  },
  computed:{
    conversationsFiltered:function(){
      return this.$store.getters.conversationsFilter;
    }
  }
}
</script>
