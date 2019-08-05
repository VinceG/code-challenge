<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters("auth", ["isLoggedIn", "user", "token"])
  },
  created() {
    if (!this.isLoggedIn && this.token) {
      this.me();
    }
  },
  methods: {
    ...mapActions("auth", ["me", "logout"])
  }
};
</script>
