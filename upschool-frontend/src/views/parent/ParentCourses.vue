<template>
	<v-app>
		<div class="my-5">Courses</div>

		<div>
			<course-ui isAdmin />
		</div>
	</v-app>
</template>

<script>
import CourseUi from "./../../components/general/CourseUi";
export default {
	components: {
		CourseUi
	}
};
</script>