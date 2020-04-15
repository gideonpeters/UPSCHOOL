<template>
	<v-app>
		<resource-view
			type="Students"
			:headers="headers"
			:items="students"
			viewRoute="parent.students.view"
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
				text: "Name",
				align: "left",
				// sortable: false,
				value: "name"
			},
			{ text: "Matriculation Number", value: "matric_number" },
			{ text: "Registration Number", value: "reg_number" },
			{ text: "Program", value: "program.name" },
			{ text: "Grade/Level", value: "level" },
			// { text: "Residence", value: "residence" },
			{ text: "Actions", value: "action", sortable: false }
		],
		students: [],
		editedIndex: -1,
		editedItem: {
			name: "",
			calories: 0,
			fat: 0,
			carbs: 0,
			protein: 0
		},
		defaultItem: {
			name: "",
			calories: 0,
			fat: 0,
			carbs: 0,
			protein: 0
		}
	}),

	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		}
	},

	watch: {
		dialog(val) {
			val || this.close();
		}
	},

	async mounted() {
		try {
			await this.$store.dispatch("getStudents");
		} catch (error) {
			console.log(error);
		}
	},

	created() {
		this.initialize();
	},

	methods: {
		initialize() {
			this.students = this.$store.state.students;
		},

		editItem(item) {
			this.editedIndex = this.students.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) {
			const index = this.students.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.students.splice(index, 1);
		},

		goToPage(v) {
			// console.log(v);
			this.$router.push({
				name: "parent.students.view",
				params: { id: v.matric_number }
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
				Object.assign(this.students[this.editedIndex], this.editedItem);
			} else {
				this.students.push(this.editedItem);
			}
			this.close();
		}
	}
};
</script>