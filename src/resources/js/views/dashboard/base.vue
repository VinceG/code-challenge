<template>
  <wrapper>
    <router-view :key="$route.path" />
  </wrapper>
</template>

<script>
import Wrapper from "layouts/main";
export default {
  components: {
    Wrapper
  }
};
</script>
