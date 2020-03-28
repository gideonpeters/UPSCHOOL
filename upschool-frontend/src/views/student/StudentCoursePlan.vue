<template>
	<v-app>
		<div>MY COURSES</div>
		<course-ui student />
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