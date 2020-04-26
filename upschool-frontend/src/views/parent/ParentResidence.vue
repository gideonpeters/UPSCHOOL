<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="3">
					<metric-card title="Number of Halls" :value="10" />
				</v-col>
				<v-col cols="3">
					<metric-card title="Total Capacity" :value="1500" />
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
	components: {
		MetricCard
	}
};
</script>
