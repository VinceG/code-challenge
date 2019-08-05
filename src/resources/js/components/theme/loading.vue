<template>
    <div>
        <div class="loading-overlay"/>
        <div class="loading-wrapper">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.loading-overlay {
    z-index: 800;
    border: none;
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    background-color: rgb(0, 0, 0);
    opacity: 0.0521228;
    cursor: wait;
    position: absolute;
}

.loading-wrapper {
    z-index: 1011;
    position: absolute;
    padding: 0px;
    margin: 0px;
    width: auto;
    top: 105px;
    left: 45%;
    text-align: center;
    color: rgb(0, 0, 0);
    border: 0px;
    cursor: wait;
    opacity: 0.740877;
}
</style>

<div>
        <div class="loading-overlay"/>
        <div class="loading-wrapper">
            <div class="blockui">
                <span>
                    <slot>Loading, Please Wait...</slot>
                </span>
                <span>
                    <div class="kt-spinner kt-spinner--v2 kt-spinner--success"/>
                </span>
            </div>
        </div>
    </div>