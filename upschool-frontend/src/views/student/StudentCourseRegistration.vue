/* eslint-disable */
<template>
	<v-app>
		<course-ui isStudent />
	</v-app>
</template>

<script>
import CourseUi from "@/components/general/CourseUi";

export default {
	components: {
		CourseUi
	},
	data() {
		return {};
	}
};
</script>
