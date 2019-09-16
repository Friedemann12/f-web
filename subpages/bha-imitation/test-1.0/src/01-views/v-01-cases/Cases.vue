<template>
  <transition name="menu_transition">
    <div id="cases" @mousewheel="side_scroll">
      <logo/>
      <navMenu/>

      <caseItem v-for="(cas_e, key) in cases" v-bind="cas_e" :key="key"/>

      <scrollButtons/>
    </div>
  </transition>
</template>
<script>
import cases from "@/05-data/Cases.json";
export default {
  data() {
    return {
      cases,
      x: ""
    };
  },
  methods: {
    side_scroll(event) {
      let y = event.deltaY;
      this.x = scrollX;
      if (y >= 0) {
        window.scrollBy({
          left: 75
        });
      } else {
        window.scrollBy({
          left: -75
        });
      }
    }
  },
  watch: {
    x: function() {
      const sbtnL = document.getElementById("SbtnL").classList;
      const sbtnR = document.getElementById("SbtnR").classList;

      let end =
        Object.keys(this.cases).length *
          document.getElementById("items").offsetWidth -
        window.innerWidth +
        4;

      if (scrollX <= 100) {
        sbtnL.add("hide");
      } else if (scrollX >= end - 100 && scrollX <= end) {
        sbtnR.add("hide");
      } else {
        sbtnL.remove("hide");
        sbtnR.remove("hide");
      }
    }
  }
};
</script>
<style lang="scss" src="./Cases.scss">
</style>

