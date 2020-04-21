<template>
	<div>
		<course-view-submissions isStaff isAdmin />
	</div>
</template>

<script>
import CourseViewSubmissions from "@/components/general/course-view/Submissions";
export default {
	components: {
		CourseViewSubmissions
	}
};
</script>
