<template>
	<v-app>
		<resource-view
			type="Programs"
			:headers="headers"
			:items="programs"
			viewRoute="parent.programs.details"
		/>
	</v-app>
</template>

<script>
import ResourceView from "@/components/general/ResourceView";
export default {
	components: {
		ResourceView
	},
	data: () => ({
		search: "",
		dialog: false,
		headers: [
			{
				text: "NAME",
				align: "left",
				sortable: false,
				value: "name"
			},
			{ text: "DEPARTMENT", value: "department" },
			{ text: "DURATION (YEARS)", value: "duration" },
			// { text: "PHONE NUMBER", value: "protein" },
			// { text: "Residence", value: "residence" },
			{ text: "ACTIONS", value: "action", sortable: false }
		],
		desserts: []
		// editedIndex: -1,
		// editedItem: {
		// 	name: "",
		// 	calories: 0,
		// 	fat: 0,
		// 	carbs: 0,
		// 	protein: 0
		// },
		// defaultItem: {
		// 	name: "",
		// 	calories: 0,
		// 	fat: 0,
		// 	carbs: 0,
		// 	protein: 0
		// }
	}),

	computed: {
		programs() {
			return this.$store.state.programs;
		}
	},

	watch: {
		dialog(val) {
			val || this.close();
		}
	},

	async mounted() {
		try {
			await this.$store.dispatch("getPrograms");
		} catch (error) {
			console.log(error);
		}
	},

	methods: {
		editItem(item) {
			this.editedIndex = this.desserts.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) {
			const index = this.desserts.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.desserts.splice(index, 1);
		},

		goToPage(v) {
			// console.log(v);
			this.$router.push({
				name: "parent.students.view",
				params: { id: v.id }
			});
		},

		close() {
			this.dialog = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		save() {
			if (this.editedIndex > -1) {
				Object.assign(this.desserts[this.editedIndex], this.editedItem);
			} else {
				this.desserts.push(this.editedItem);
			}
			this.close();
		}
	}
};
</script>