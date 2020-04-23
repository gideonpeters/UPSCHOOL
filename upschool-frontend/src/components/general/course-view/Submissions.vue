<template>
	<v-card flat class="pa-3" min-height="500">
		<!-- <div class="fs-3">Currently under construction</div> -->
		<metric-card title="Number of Submissions" :value="3" />
	</v-card>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
	components: {
		MetricCard
	}
};
</script>