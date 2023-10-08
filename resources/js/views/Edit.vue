<script>
import Notebook from "../components/notebook.vue";
import show from "./Show.vue";
import router from "../router/index.js";


export default {
    name: 'Index',
    computed: {
        show() {
            return show
        }
    },
    components: {Notebook},

    data() {
        return {
            note: [],
            fullName: '',
            company: '',
            phone: '',
            email: '',
            birthday: '',
            image: null,
            noteImage: null,
            userId: this.$route.params.id
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
        getNote() {
            axios.get(`/api/v1/notebook/${this.userId}`)
                .then(res => {
                    this.note = res.data.data
                })
        },

        store() {
            if (this.image === null) {
                this.image = this.note.image
            }
            axios.patch(`/api/v1/notebook/${this.userId}`, {
                fullName: this.note.fullName,
                company: this.note.company,
                phone: this.note.phone,
                email: this.note.email,
                birthday: this.note.birthday,
                image: this.image
            })
                .then(res => {
                    router.push({name: 'index'})
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
            <input v-model="this.note.fullName"  name="fullName" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="text"
                   placeholder="ФИО">
<!--            <div v-if="errors.fullName">-->
<!--                <p v-for="error in errors.fullName" class="text-sm text-red-500">{{ error }}</p>-->
<!--            </div>-->
        </div>
        <div class="mb-3">
            <input v-model="this.note.company" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="text"
                   placeholder="Компания">
        </div>
        <div class="mb-3">
            <input v-model="this.note.phone" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="number"
                   placeholder="Телефон">
        </div>
        <div class="mb-3">
            <input v-model="this.note.mail" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="email"
                   placeholder="Почта">
        </div>
        <div class="mb-3">
            <input v-model="this.note.birthday" class="w-96 rounded-3xl border mt-2 p-2 border-slate-300" type="date"
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
            <img class="w-32" :src="this.image.url" alt="preview">
        </div>
        <div v-else>
            <img class="w-32" :src="this.note.image" alt="preview">
        </div>
        <div>
            <a @click.prevent="store" href="#" class="block p-2 w-32 text-center rounded-3xl bg-green-600 text-white
                hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border ml-auto">Update</a>
        </div>
            </div>

</template>

<style scoped>

</style>
