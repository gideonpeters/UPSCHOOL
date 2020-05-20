<template>
	<v-row>
		<v-col cols="4" md="4">
			<div class="d-flex align-center mr-3">
				<v-icon small>mdi-dots-vertical</v-icon>

				<div>{{property}}</div>
			</div>
		</v-col>
		<v-col cols="6" md="6">
			<!-- <div class="d-flex align-center my-auto"> -->
			<input :placeholder="property" class="pa-3" style="height: 100%; border: 0.5px solid grey;" />
			<!-- </div> -->
		</v-col>
		<v-col cols="2" md="2">
			<v-icon small color="grey">mdi-minus-circle</v-icon>
		</v-col>
	</v-row>
</template>

<script>
export default {
	props: ["property"]
};
</script>