<template>
  <wrapper>
    <router-view :key="$route.path" />
  </wrapper>
</template>

<script>
import Wrapper from "layouts/auth";
export default {
  components: {
    Wrapper
  }
};
</script>