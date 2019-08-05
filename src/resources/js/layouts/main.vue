<template>
    <div>
        <HeaderBar />

        <div class="container">
            <slot />
        </div>
    </div>
</template>

<script>
import HeaderBar from "@/components/theme/header";
export default {
    components: {
        HeaderBar
    }
};
</script>

