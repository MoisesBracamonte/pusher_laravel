<template>
<div>
<form class="m-0">
  <div class="list-group-item">
    <input type="text" 
    class="form-control input-buscar mt-1" 
    placeholder="Buscar" 
    v-model="myFilter">
  </div>
</form>
</div>
</template>
<script>
export default {
 computed:{
   myFilter:{
     get(){
       return this.$store.state.myfilter;
     },
     set(value){
        this.$store.commit('newFilter',value)
     }
   }
 }
}
</script>
