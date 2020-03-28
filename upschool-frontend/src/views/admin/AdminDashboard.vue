<template>
	<v-app>
		<v-layout justify-space-between wrap>
			<v-flex xs12 md3 v-for="i in 4" :key="i">
				<v-card class="primary-box-shadow pa-4 pointer mx-2">
					<div class="d-flex justify-space-between">
						<div class="d-flex flex-column">
							<div>Total Students</div>
						</div>
						<div class="fs-1">560</div>
					</div>
				</v-card>
			</v-flex>
			<v-flex xs12>
				<div class="my-5">
					<h2 class="mb-3 mt-5">Monthly overview of expenses</h2>
					<vue-apex-charts type="area" height="350" :options="chartOptions" :series="series" />
				</div>
			</v-flex>
			<v-flex xs12>
				<v-layout>
					<v-flex xs9>
						<h2>Fees collection report</h2>
					</v-flex>
					<v-flex>
						<div>
							<v-card flat class="pa-3 mb-4">
								<div class="d-flex flex-column">
									<div class="d-flex align-center">
										<i class="mdi mdi-calendar mr-4"></i>
										<div>News feed</div>
									</div>
									<div class="d-flex align-center mt-1 mb-2" v-for="i in 3" :key="i">
										<i class="mdi mdi-information mr-4 fs-5 grey--text"></i>
										<div class="fs-5 grey--text">Resumption clearance has begun {{i}}</div>
									</div>
								</div>
							</v-card>
							<v-card flat class="pa-3 mb-4">
								<div class="d-flex flex-column">
									<div class="d-flex align-center">
										<i class="mdi mdi-cake mr-4"></i>
										<div>Birthdays</div>
									</div>
									<div class="d-flex align-center mt-1 mb-2" v-for="i in 2" :key="i">
										<i class="mdi mdi-information mr-4 fs-5 grey--text"></i>
										<div class="fs-5 grey--text">Today is {{i}}'s birthday</div>
									</div>
								</div>
							</v-card>
							<dashboard-calendar />
						</div>
					</v-flex>
				</v-layout>
			</v-flex>
		</v-layout>
	</v-app>
</template>

<script>
import DashboardCalendar from "@/components/student/dashboard/Calendar";
import VueApexCharts from "vue-apexcharts";

export default {
	components: {
		DashboardCalendar,
		VueApexCharts
	},
	data() {
		return {
			series: [
				{
					name: "Expenses",
					data: [31, 40, 28, 51, 42, 109, 100]
				},
				{
					name: "Revenue",
					data: [11, 32, 45, 32, 34, 52, 41]
				}
			],
			chartOptions: {
				chart: {
					height: 350,
					type: "area"
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: "smooth"
				},
				xaxis: {
					type: "datetime",
					categories: [
						"2018-09-19T00:00:00.000Z",
						"2018-09-19T01:30:00.000Z",
						"2018-09-19T02:30:00.000Z",
						"2018-09-19T03:30:00.000Z",
						"2018-09-19T04:30:00.000Z",
						"2018-09-19T05:30:00.000Z",
						"2018-09-19T06:30:00.000Z"
					]
				},
				tooltip: {
					x: {
						format: "dd/MM/yy HH:mm"
					}
				}
			}
		};
	}
};
</script>

<style lang="scss" scoped>
</style>
