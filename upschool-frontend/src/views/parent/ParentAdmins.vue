<template>
	<v-app>
		<resource-view type="Admins" :headers="headers" :items="admins" viewRoute="parent.admins.view" />
	</v-app>
</template>

<script>
import ResourceView from "@/components/general/ResourceView";
import Axios from "axios";

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
		admins: []
	}),

	async mounted() {
		try {
			let res = await Axios.get("admin");
			this.admins = res.data.data;
		} catch (error) {
			throw error;
		}
	},
	methods: {
		goToPage(v) {
			this.$router.push({
				name: "parent.admins.view",
				params: { id: v.id }
			});
		}
	}
};
</script>