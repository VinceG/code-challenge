<template>
  <wrapper>
    <router-view :key="$route.path" />
  </wrapper>
</template>

<script>
import Wrapper from "layouts/error";
export default {
  components: {
    Wrapper
  }
};
</script>
