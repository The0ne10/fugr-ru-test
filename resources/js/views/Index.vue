<script>
import Notebook from "../components/notebook.vue";
import show from "./Show.vue";
import { TailwindPagination } from 'laravel-vue-pagination';


export default {
    name: 'Index',
    computed: {
        show() {
            return show
        }
    },
    components: {Notebook, TailwindPagination},

    data() {
        return {
            notebooks: {},
            fullName: '',
            company: '',
            phone: '',
            email: '',
            birthday: '',
            image: null,
            noteImage: null,
        }
    },

    watch: {
        noteImage(to, from) {
            console.log(this.noteImage)
        }
    },

    mounted() {
        this.getNote()
    },


    methods: {
        getNote(page = 1) {
            axios.get(`/api/v1/notebook?page=${page}`)
                .then(res => {
                    this.notebooks = res.data
                    console.log(res.data)
                })
        },

        store() {
            axios.post('/api/v1/notebook', {
                fullName: this.fullName,
                company: this.company,
                phone: this.phone,
                email: this.email,
                birthday: this.birthday,
                image_url: this.image.url
            })
                .then(res => {
                    this.fullName = ''
                    this.company = ''
                    this.phone = ''
                    this.email = ''
                    this.birthday = null
                    this.image = null
                    this.getNote()
                })
                .catch(e => {
                    this.errors = e.response.data.errors
                })
        },

        noteDelete(id) {
            axios.delete(`/api/v1/notebook/${id}`)
                .then(res => {
                    this.getNote()
                })
        },

        selectFile() {
            this.fileInput = this.$refs.file;
            this.fileInput.click();
        },

        storeImage(e) {
            const file = e.target.files[0]
            const formData = new FormData()
            formData.append('image', file)
            axios.post('/api/v1/image', formData)
                .then(res => {
                    this.image = res.data.data
                })
        }
    }


}

</script>

<template>
    <div class="mb-4">
        <div class="mb-3">
            <input v-model="fullName" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="text"
                   placeholder="ФИО">
<!--            <div v-if="errors.fullName">-->
<!--                <p v-for="error in errors.fullName" class="text-sm text-red-500">{{ error }}</p>-->
<!--            </div>-->
        </div>
        <div class="mb-3">
            <input v-model="company" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="text"
                   placeholder="Компания">
        </div>
        <div class="mb-3">
            <input v-model="phone" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="number"
                   placeholder="Телефон">
        </div>
        <div class="mb-3">
            <input v-model="email" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="email"
                   placeholder="Почта">
        </div>
        <div class="mb-3">
            <input v-model="birthday" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="date"
                   placeholder="Дата Рождения">
        </div>
        <div class="flex mb-3 items-center">
            <div>
                <input @change="storeImage" ref="file" type="file" class="hidden">
                <a href="#" class="block p-2 w-16 text-center text-sm rounded-3xl bg-sky-500 text-white"
                   @click.prevent="selectFile()">Image</a>
            </div>
            <div>
                <a v-if="image" @click.prevent="image = null" class="ml-3" href="#">Cancel</a>
            </div>
        </div>
        <div v-if="image">
            <img :src="image.url" alt="preview">
        </div>
        <div>
            <a @click.prevent="store" href="#" class="block p-2 w-32 text-center rounded-3xl bg-green-600 text-white
                hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border ml-auto">Publish</a>
        </div>
            </div>
        <div v-if="notebooks.data">
            <div class="mb-4 border-b" v-for="note in notebooks.data">
                <RouterLink :to="{ name: 'show', params: {id: note.id}}">
                    <p class="flex">ФИО: <div class="ml-2 text-slate-500">{{ note.fullName }}</div></p>
                    <p class="flex">Компания: <div class="ml-2 text-slate-500"> {{ note.company ?? 'Компания не указана' }}</div></p>
                    <p class="flex">Телефон: <div class="ml-2 text-slate-500"> {{ note.phone }}</div></p>
                    <p class="flex">Почта: <div class="ml-2 text-slate-500"> {{ note.mail }}</div></p>
                    <p class="flex">Дата рождения: <div class="ml-2 text-slate-500"> {{ note.birthday ?? '-' }}</div></p>
                    <p class="flex">Фото: <img class="w-40 ml-2 mb-2" :src="note.image" :alt="note.fullName"></p>
                </RouterLink>
                <div>
                    <a @click.prevent="noteDelete(note.id)" href="#" class="block p-2 w-32 text-center rounded-3xl bg-red-600 text-white
                hover:bg-white hover:border hover:border-red-600 hover:text-red-600 box-border ml-auto">Delete</a>
                </div>
            </div>
            <TailwindPagination
                :data="notebooks"
                @pagination-change-page="getNote"
            />
        </div>
</template>

<style scoped>

</style>
