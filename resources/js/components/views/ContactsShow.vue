<template>
    <div v-if="dataIsLoaded">
        <div class="flex justify-between">
            <div class="text-blue-400">
                < Back
            </div>
            <div>
                <router-link :to="'/contact/' + contact.id + '/edit'"
                             class="px-4 py-2 rounded text-sm font-bold text-green-500 border border-green-500 mr-2">
                    Edit
                </router-link>
                <a href="#" class="px-4 py-2 rounded border border-red-500 text-sm font-bold text-red-500">Delete</a>
            </div>
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

                })
        },
        data() {
            return {
                dataIsLoaded: false,
                contact: null,
            }
        },
    }
</script>

<style scoped>

</style>
