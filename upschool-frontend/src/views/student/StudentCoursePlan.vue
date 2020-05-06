<template>
	<v-app>
		<div>MY COURSES</div>
		<course-ui isStudent personal />
	</v-app>
</template>

<script>
import CourseUi from "@/components/general/CourseUi";

export default {
	components: {
		CourseUi
	}
};
</script>