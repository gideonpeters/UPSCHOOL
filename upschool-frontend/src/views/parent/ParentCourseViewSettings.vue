<template>
	<div>
		<course-view-settings isStaff isAdmin />
	</div>
</template>

<script>
import CourseViewSettings from "@/components/general/course-view/Settings";
export default {
	components: {
		CourseViewSettings
	}
};
</script>