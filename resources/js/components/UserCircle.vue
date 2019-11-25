<template>
    <div class="border border-gray-400 rounded-full text-white bg-blue-400 w-10 h-10 flex justify-center items-center">
        {{ initials }}
    </div>
</template>

<script>
    export default {
        name: "UserCircle",
        props: [
            'name'
        ],
        computed: {
            initials() {
                return this.name.match(/[A-Z]/g).slice(0, 2).join('');
            }
        },
    }
</script>

<style scoped>

</style>
