<template>
	<v-app>
		<div class="my-5">
			<v-icon size="20" class="mr-2" @click="$router.go(-1)">mdi-arrow-left</v-icon>Courses / Details
		</div>

		<course-view />
	</v-app>
</template>

<script>
import CourseView from "@/components/general/CourseView";
export default {
	components: {
		CourseView
	}
};
</script>