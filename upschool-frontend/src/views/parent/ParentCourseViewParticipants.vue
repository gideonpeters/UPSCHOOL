<template>
	<div>
		<course-view-participants isStaff isAdmin />
	</div>
</template>

<script>
import CourseViewParticipants from "@/components/general/course-view/Participants";
export default {
	components: {
		CourseViewParticipants
	}
};
</script>
