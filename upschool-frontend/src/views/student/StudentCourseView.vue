<template>
	<v-app>
		<course-view isStudent />
	</v-app>
</template>

<script>
import CourseView from "@/components/general/CourseView";

export default {
	components: { CourseView }
};
</script>
