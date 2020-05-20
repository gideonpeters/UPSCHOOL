<template>
	<v-app>
		<v-card flat min-height="600px">
			<h1>yooo</h1>
		</v-card>
	</v-app>
</template>

<script>
export default {
	props: {
		isStudent: { type: Boolean, default: false },
		isStaff: { type: Boolean, default: false },
		isAdmin: { type: Boolean, default: false }
	}
};
</script>