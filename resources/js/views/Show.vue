<script>
export default {
    name: 'Show',

    data() {
        return{
            note: [],
            userId: this.$route.params.id
        }
    },

    mounted() {
        this.getNote()
    },

    methods: {
        getNote() {
            axios.get(`/api/v1/notebook/${this.userId}`)
                .then(res => {
                    this.note = res.data.data
                })
        },

        noteDelete(id) {
            axios.delete(`/api/v1/notebook/${id}`)
                .then(res => {
                    this.getNote()
                })
        },

    }

}
</script>

<template>
    <div class="mt-2 border-b">
        <p class="flex">ФИО: <div class="ml-2 text-slate-500">{{ note.fullName }}</div></p>
        <p class="flex">Компания: <div class="ml-2 text-slate-500"> {{ note.company ?? 'Компания не указана' }}</div></p>
        <p class="flex">Телефон: <div class="ml-2 text-slate-500"> {{ note.phone }}</div></p>
        <p class="flex">Почта: <div class="ml-2 text-slate-500"> {{ note.mail }}</div></p>
        <p class="flex">Дата рождения: <div class="ml-2 text-slate-500"> {{ note.birthday ?? '-' }}</div></p>
        <p class="flex">Фото: <img class="w-40 ml-2 mb-2" :src="note.image" :alt="note.fullName"></p>
        <div class="flex justify-between">
        <div>
            <router-link :to="{ name: 'edit', params: {id: note.id }}"><a href="#" class="block p-2 w-32 text-center rounded-3xl bg-sky-600 text-white
                hover:bg-white hover:border hover:border-sky-600 hover:text-sky-600 box-border ml-auto">Edit</a></router-link>

        </div>
        <div>
            <a @click.prevent="noteDelete(note.id)" href="#" class="block p-2 w-32 text-center rounded-3xl bg-red-600 text-white
                hover:bg-white hover:border hover:border-red-600 hover:text-red-600 box-border ml-auto">Delete</a>
        </div>
        </div>
    </div>
</template>

<style scoped>

</style>
