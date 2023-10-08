<script>
export default {
    name: 'App',
}

</script>

<template>
    <div class="mx-auto w-96">
        <router-link :to="{name: 'index' }">Index</router-link>
        <RouterView></RouterView>
    </div>
</template>

<style scoped>

</style>
