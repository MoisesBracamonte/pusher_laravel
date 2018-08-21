<template>
  <div>
      <ContactComponent
        v-for="(conversation,key) in conversations"
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
  props:{
    conversations:Array
  },
  components : {
    ContactComponent,
  },
  methods:{
    selectConversation:function(conversation){
      this.$emit('selectConversation',conversation);
    }
  }
}
</script>
