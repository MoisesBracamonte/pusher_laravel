<template>
<form class="m-0">
  <div class="list-group-item">
    <input type="text" class="form-control input-buscar mt-1" placeholder="Buscar" v-model="people">
  </div>
</form>
</template>
<script>
export default {
  props:{
    peopleData: String
  },
  data:function(){
    return {
      people:''
    }
  },
  watch:{
    peopleData:function(value){
      this.people = value
    }
  },
  mounted:function(){
    this.people = this.peopleData
  }
}
</script>
