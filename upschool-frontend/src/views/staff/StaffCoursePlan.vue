<template>
	<v-app>
		<div>MY COURSES</div>
		<course-ui isStaff personal />
	</v-app>
</template>

<script>
import CourseUi from "@/components/general/CourseUi";

export default {
	components: {
		CourseUi
	},
	async mounted() {
		try {
			// this.$store.dispatch("getFacilitatedCourses");
		} catch (error) {
			console.log(error);
		}
	}
};
</script>