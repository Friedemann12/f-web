<template>
  <div class="scroll_buttons">
    <div id="SbtnL" @click="scroll_left()">
      <i class="arrow left"></i>
    </div>
    <div id="SbtnR" @click="scroll_right()">
      <i class="arrow right"></i>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    scroll_left() {
      let width = document.getElementById("items").offsetWidth;
      window.scrollBy({
        left: -width,
        behavior: "smooth"
      });
    },
    scroll_right() {
      let width = document.getElementById("items").offsetWidth;
      window.scrollBy({
        left: width,
        behavior: "smooth"
      });
    }
  }
};
</script>
<style lang="scss" src="./scroll_buttons.scss">
</style>
