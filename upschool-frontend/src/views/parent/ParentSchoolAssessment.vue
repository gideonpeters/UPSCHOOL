<template>
	<v-app>
		<div>
			<resource-view
				type="School Assessments"
				:headers="headers"
				:items="schoolAssessments"
				viewRoute="parent.school-assessments.view"
			/>
		</div>
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
		headers: [
			{
				text: "NAME",
				align: "left",
				sortable: false,
				value: "name"
			},
			{ text: "TOTAL SCORE", value: "total_score" },
			{ text: "ACTIVE", value: "visible" },

			{ text: "ACTIONS", value: "action", sortable: false }
		]
	}),

	computed: {
		schoolAssessments() {
			return this.$store.state.schoolAssessments;
		}
	},
	async mounted() {
		try {
			await this.$store.dispatch("getAllSchoolAssessments");
		} catch (error) {
			console.log(error);
		}
	}
};
</script>