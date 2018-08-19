<template>
  <div>
      <BuscadorComponent></BuscadorComponent>
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
import BuscadorComponent from './BuscadorComponent';
export default {
  components : {
    ContactComponent,
    BuscadorComponent
  },
  data:function(){
    return{
      conversations : []
    }
  },
  mounted:function(){this.getConversation()},
  methods:{
    getConversation:function(){
      axios.get(`/api/conversations`)
      .then(response => {
          this.conversations = response.data
      }).catch(error => {
        console.log(error);
      })
    },

    selectConversation:function(conversation){
      this.$emit('selectConversation',conversation);
    }
  }
}
</script>
