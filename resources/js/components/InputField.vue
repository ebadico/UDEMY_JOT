<template>
	<div class="relative pb-4">
		<label :for="name" class="text-blue-500 pt-2 uppercase text-xs font-bold absolute" v-text="label"></label>
		<input type="text" :name="name" :id="name"
		       :class="errorClassObject()"
		       class="pt-8 w-full text-gray-900 border-b pb-2 focus:outline-none focus:border-blue-400"
		       :placeholder="placeholder" v-model="value" @input="updateField()">
		<p class="text-red-600 text-sm" v-text="errorMessage()">Error Here</p>
	</div>
</template>

<script>
	export default {
		name: "InputField",

		props: [
			'name', 'label', 'placeholder', 'errors', 'data'
		],

		computed: {
			hasError() {
				return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
			}
		},

		data: () => {
			return {
				value: '',
			}
		},

		methods: {
			updateField() {
				this.clearErrors(this.name);
				this.$emit('update:field', this.value)
			},
			errorMessage() {
				if( this.hasError) {
					return this.errors[this.name][0];
				}
			},
			clearErrors() {
				if( this.hasError) {
					this.errors[this.name] = null;
				}
			},
			errorClassObject() {
				return {
					'error-field': this.hasError
				}
			}

		},
        watch: {
		    data: function(val) {
                this.value = val;
            }
        }
	}
</script>

<style scoped>
	.error-field {
		@apply .border-red-500 .border-b-2
	}
</style>
