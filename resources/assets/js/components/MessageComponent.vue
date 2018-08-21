<template>
  <div class="media m-2">
    <div v-if="!writtenByMe">
      <img :src="myImage" class="rounded-circle img-msg m-1" alt="">
    </div>
    <div class="media-body">
        <div class="card">
          <div class="card-body">
          <slot></slot>
          </div>
        </div>
    </div>
    <div v-if="writtenByMe">
      <img :src="myImage" class="rounded-circle img-msg m-1" alt="">
    </div>
</div>
</template>
<script>
export default {
  props : {
    writtenByMe : Boolean,
    myImage:String
  }
  
}
</script>
