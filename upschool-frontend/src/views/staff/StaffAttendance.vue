<template>
	<v-app>
		<attendance-view isStaff />
	</v-app>
</template>

<script>
import AttendanceView from "@/components/general/AttendanceView";

export default {
	components: {
		AttendanceView
	},
	computed: {
		studentCourses() {
			return this.$store.state.student_courses;
		}
	}
};
</script>
