<template>
	<v-app>
		<div class="my-5">Courses</div>

		<div>
			<course-ui />
		</div>
	</v-app>
</template>

<script>
import CourseUi from "./../../components/general/CourseUi";
export default {
	components: {
		CourseUi
	},
	data() {
		return {
			page: 1
		};
	},
	methods: {
		goToPage(v) {
			this.$router.push({
				name: "parent.courses-view",
				params: { id: v }
			});
		}
	}
};
</script>