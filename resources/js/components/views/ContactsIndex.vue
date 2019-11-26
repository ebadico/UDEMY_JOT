<template>
    <div v-if="dataIsLoaded">
        <div v-if="contacts.length === 0">
            <p>No contacts yet... <rounter-link to="/contacts/create">Get started ></rounter-link></p>
        </div>
        <div v-for="contact in contacts">
            <router-link :to="'/contacts/' + contact.data.contact_id" class="flex items-center border-b border-gray-400 p-4 hover:bg-gray-100">
                <UserCircle :name="contact.data.name"></UserCircle>

                <div class="p-4">
                    <p v-text="contact.data.name" class="text-blue-400 font-bold"></p>
                    <p v-text="contact.data.company" class="text-gray-600"></p>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
    import UserCircle from "../UserCircle";

    export default {
        name: "ContactsIndex",
        components: {UserCircle},
        data() {
            return {
                dataIsLoaded: false,
                contacts: null,
            }
        },
        mounted() {
            axios.get('/api/contacts')
                .then(response => {
                    this.contacts = response.data.data;

                    this.dataIsLoaded = true;
                })
                .catch(errors => {
                    this.dataIsLoaded = true;
                });
        }
    }
</script>

<style scoped>

</style>
