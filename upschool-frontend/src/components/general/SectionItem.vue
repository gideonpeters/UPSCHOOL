<template>
	<div class="pl-5">
		<div
			:class="isHovered ? 'blue--text text-underline' : ''"
			@mouseenter="isHovered = true"
			@mouseleave="isHovered = false"
			@click="subsection.file ? goTo(subsection.file.url) : ''"
		>
			<v-icon
				:color="isHovered ? 'blue' : ''"
				size="18"
				class="mr-1"
			>{{ subsection.type == 'file' ? 'mdi-file' : 'mdi-poll-box'}}</v-icon>
			{{subsection.name}}
		</div>
		<div class="pl-5 mt-1" v-html="subsection.body"></div>
	</div>
</template>

<script>
export default {
	props: {
		subsection: {
			type: Object
		}
	},
	data: () => ({
		isHovered: false
	}),
	methods: {
		goTo(url) {
			if (url) {
				window.open(`http://127.0.0.1:8000${url}`, "_blank");
				console.log(url);
			} else {
				this.$store.commit(
					"openSnackbar",
					"File not available, contact facilitator"
				);
			}
		}
	}
};
</script>