<template>
<div>
  <div class="list-group-item text-center">
      <img :src="imagePerfil" class="rounded-circle img-cont-right" alt="">
      <small id="" class="form-text text-muted">{{ contactName }}</small>
  </div>
  <div class="list-group-item text-center">
      <form>
          <small id="" class="form-text text-muted" >Silenciar notificaciones</small>
          <input type="checkbox" name="" id="">
      </form>
  </div>
</div>
</template>
<script>
export default {
  props:{
      contactName:String,
      imagePerfil:String
  }
}
</script>
