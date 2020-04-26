<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12">
					<v-btn text tile color="grey" @click="goBack">
						<v-icon>mdi-arrow-left</v-icon>Go BACK
					</v-btn>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
export default {
	methods: {
		goBack() {
			this.$router.push({ name: "parent.halls" });
		}
	}
};
</script>