<template>
	<v-app>
		<enrollment-ui isStaff />
	</v-app>
</template>

<script>
import EnrollmentUi from "@/components/general/EnrollmentUi";

export default {
	components: { EnrollmentUi }
};
</script>
