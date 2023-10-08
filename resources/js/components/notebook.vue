<script>
export default {
    name: 'Notebook',

    props: ['note']
}

</script>

<template>
<div class="mb-3">
    <router-link :to="{ name: 'show', params: {id: note.id} }">{{ note }}</router-link>
</div>
</template>

<style scoped>

</style>
