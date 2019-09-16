<template>
  <transition name="menu_transition">
    <div>
      <div class="menu">
        <span @click="isOpen = !isOpen" :class="{'menu_is_shown' : !isOpen}">{{ menuLabel }}</span>
      </div>

      <div class="MenuOpen" :class="{'is-closed' : !isOpen}">
        <transition name="slideSide">
          <div class="CasesScreen" v-if="isOpen">
            <p>
              <router-link to="/">Cases</router-link>
            </p>
          </div>
        </transition>
        <transition name="slideSide">
          <div class="ContactScreen" v-if="isOpen">
            <p>
              <router-link to="/contact">Contact</router-link>
            </p>
          </div>
        </transition>
        <transition name="slideSide">
          <div class="AboutScreen" v-if="isOpen">
            <p>
              <router-link to="/about">About</router-link>
            </p>
          </div>
        </transition>
      </div>
    </div>
  </transition>
</template>
<script>
export default {
  data: function() {
    return {
      isOpen: false
    };
  },
  computed: {
    menuLabel() {
      return this.isOpen ? "CLOSE" : "MENU";
    }
  }
};
</script>
<style lang="scss" src="./menu.scss">
</style>
