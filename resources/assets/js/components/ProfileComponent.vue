<template>
<div class="container mt-5">
  <div class="card">
    <div class="card-header">Editar usuario</div>
    <div class="card-body">
      <form method="POST" :action="actionForm" enctype= "multipart/form-data">
        <input type="hidden" name="_method" v-model="patch">
        <input type="hidden" name="_token" v-model="token">
        <div class="form-group">
          <label for="">Nombre</label>
          <input type="text" name="name" class="form-control form-control-danger" v-model="user.name">
          <div v-if="errors.name">
            <p class="text-danger" v-for="error in errors.name">{{error}}</p>
          </div>
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="email" class="form-control" v-model="user.email">
            <div v-if="errors.email">
              <p class="text-danger" v-for="error in errors.email">{{error}}</p>
            </div>
        </div>
        <div class="form-group">
          <label for="">Contraseña (Solo si desea modificarla) : </label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <img :src="avatar" class="rounded-circle"  width="100px" height="100px">
          <label class="label-img" for="img-load" >Subir imagen</label>
          <input id="img-load" v-on:change="loadImg" name="img_perfil" type="file" class="form-control" style="display:none;">
        </div>
        <input type="submit" name="edit_user" class="btn btn-info">
      </form>
    </div>
  </div>
</div>
</template>
<style>
.label-img{
  padding: 10px;
  border-radius:8px;
  color:dimgrey;
  font: 16px;
}
.label-img:hover{
  background-color: rgba(189,195,199 ,0.4);
  color:#000;
}
</style>

<script>
export default {
  props:{
    user:Object,
    token:String,
    actionForm:String,
    errors:null
  },
  data:function(){
    return{
      patch:"PATCH",
      avatar :''
    }
  },
  mounted:function(){
    this.avatar = this.user.image_perfil
    console.log(this.errors);
  },
  methods:{
    loadImg:function(event){
      console.log(event);
      let reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = e => {
        this.avatar = e.target.result
      }
    }
  }
}
</script>
