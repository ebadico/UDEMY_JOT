<template>
    <div v-if="dataIsLoaded">
        <div class="flex justify-between">
            <a href="#" class="text-blue-400" @click="$router.back()">
                < Back
            </a>
            <div class="relative">
                <router-link :to="'/contacts/' + this.$route.params.id + '/edit'"
                             class="px-4 py-2 rounded text-sm font-bold text-green-500 border border-green-500 mr-2">
                    Edit
                </router-link>
                <a href="#" class="px-4 py-2 rounded border border-red-500 text-sm font-bold text-red-500" @click="modal = !modal">Delete</a>

                <div v-if="modal" class="absolute bg-blue-900 text-white rounded-lg z-20 p-8 w-64 right-0  mt-2 mr-6">
                    <p>Are you sure you want to delete this record ?</p>

                    <div class="flex items-center mt-6 justify-end">
                        <button @click="modal = !modal" class="text-white pr-4">Cancel</button>
                        <button class="px-4 py-2 bg-red-500 rounded text-sm font-bold text-white" @click="destroy">Delete</button>
                    </div>
                </div>

            </div>

            <div v-if="modal" class="bg-black opacity-25 absolute right-0 left-0 top-0 bottom-0 z-10" @click="modal = false"></div>
        </div>

        <div class="flex items-center pt-6">
            <UserCircle :name="contact.name"></UserCircle>

            <p v-text="contact.name" class="pl-5 text-xl"></p>
        </div>

        <p class="pt-6 text-gray-600 font-bold uppercase  text-sm">Contact</p>
        <p class="pt-2 text-blue-400" v-text="contact.email"></p>
        <p class="pt-6 text-gray-600 font-bold uppercase  text-sm">Company</p>
        <p class="pt-2 text-blue-400" v-text="contact.company"></p>
        <p class="pt-6 text-gray-600 font-bold uppercase  text-sm">Birthday</p>
        <p class="pt-2 text-blue-400" v-text="contact.birthday"></p>
    </div>
</template>

<script>
    import UserCircle from "../UserCircle";

    export default {
        name: "ContactsShow",
        components: {UserCircle},
        mounted() {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(response => {
                    this.contact = response.data.data;
                    this.dataIsLoaded = true;
                })
                .catch(errors => {
                    this.dataIsLoaded = true;

                    if( errors.response.status === 404) {
                        this.$router.push('/contacts');
                    }
                })
        },
        data() {
            return {
                dataIsLoaded: false,
                modal: false,
                contact: null,
            }
        },
        methods: {
            destroy() {
                axios.delete('/api/contacts/' + this.$route.params.id)
                    .then(response => {
                        this.$router.push('/contacts');
                    })
                    .catch(errors => {
                        alert('Internal Error ! Unable to delete the record')
                    })
            }
        }
    }
</script>

<style scoped>

</style>
