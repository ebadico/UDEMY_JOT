<template>
	
</template>

<script>
	export default {
		name: "ContactsShow",
		data() {
			return {
				contact: '',
			}
		},
		mounted() {
			axios.get('/api/contacts/' + this.$route.params.id)
				.then(response => {
					this.contact = response.data.data;
				})
				.catch(errors => {

				})
		}
	}
</script>

<style scoped>

</style>