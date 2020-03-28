<template>
	<div>
		<div
			:class="isHovered ? 'blue--text text-underline' : ''"
			@mouseenter="isHovered = true"
			@mouseleave="isHovered = false"
		>
			<v-icon
				:color="isHovered ? 'blue' : ''"
				size="18"
				class="mr-1"
			>{{ subsection.type == 'file' ? 'mdi-file' : 'mdi-poll-box'}}</v-icon>
			{{subsection.name}}
		</div>
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
	})
};
</script>