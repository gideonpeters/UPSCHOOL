<template>
	<v-app>
		<v-container>
			<school-calendar isStudent />
		</v-container>
	</v-app>
</template>

<script>
import SchoolCalendar from "./../../components/general/SchoolCalendar";
export default {
	components: {
		SchoolCalendar
	}
};
</script>