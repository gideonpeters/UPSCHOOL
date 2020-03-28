<template>
	<div class="d-flex flex-column">
		<div class="fs-3 text-uppercase">{{event.name}}</div>
		<v-card
			flat
			class="fs-4 d-flex text-wrap"
			max-height="100"
			min-height="100"
			v-line-clamp:20="4"
		>{{event.description}}</v-card>
		<div class="d-flex align-center justify-space-between mt-3">
			<div class="fs-4 font-italic">
				<v-icon size="15" color="grey">mdi-map-marker</v-icon>
				{{event.venue}}
			</div>
			<div class="fs-4">
				<v-icon size="15" color="grey">mdi-clock</v-icon>
				{{event.time}}
			</div>
		</div>
		<!-- <div class="d-flex">
			<v-spacer></v-spacer>
			<v-btn color="primary" text small>View</v-btn>
		</div>-->
		<!-- <div class="primary--text fs-4 mt-4 pointer">Read more</div> -->
	</div>
</template>

<script>
export default {
	name: "event-item",
	props: {
		event: {
			type: Object
		}
	}
};
</script>