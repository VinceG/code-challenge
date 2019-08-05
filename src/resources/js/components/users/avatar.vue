<template>
    <img :src="avatar" class="img-fluid rounded-circle" />
</template>

<script>
export default {
    props: {
        avatar: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>
img {
    max-width: 64px;
}
</style>