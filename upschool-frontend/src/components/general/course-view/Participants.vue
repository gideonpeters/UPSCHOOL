<template>
	<v-card flat class="pa-3" min-height="500">
		<v-data-table :headers="headers" :items="participants" hide-default-footer>
			<template v-slot:item.action="{}">
				<v-btn depressed tile>Action</v-btn>
			</template>
		</v-data-table>
	</v-card>
</template>

<script>
export default {
	data() {
		return {
			headers: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "name"
				},
				{ text: "Matriculation Number", value: "matric_number" },
				{ text: "Registration Number", value: "reg_number" },
				{ text: "Program", value: "program.name" },
				{ text: "Grade/Level", value: "level" },
				// { text: "Residence", value: "residence" },
				{ text: "Actions", value: "action", sortable: false }
			],
			participants: []
		};
	},
	methods: {
		async getCourseParticipants() {
			try {
				let id = this.$route.params.id;
				let res = await this.$store.dispatch(
					"getCourseParticipants",
					id
				);

				this.participants = [...res.data];
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			this.getCourseParticipants();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>