<template>
	<v-card flat class="ma-3 pa-3 metric-item primary-box-shadow">
		<div class="d-flex align-items-center justify-space-between">
			<div class="d-flex flex-column">
				<div class="metric-title">
					{{ metricData.title }}
				</div>
				<div class="metric-value">
					{{ number }}
				</div>
			</div>
			<div class="d-flex my-auto">
				<div
					v-if="status == 0"
					style="display:flex; justify-content:center;background-color: #2DCE98; height: 50px; width: 50px; border-radius: 50% "
				>
					<v-icon size="50">
						$vuetify.icons.result-passed
					</v-icon>
				</div>
				<div
					v-if="status == 1"
					style="display:flex; justify-content:center;background-color: #F53C56; height: 50px; width: 50px; border-radius: 50% "
				>
					<v-icon size="50">
						$vuetify.icons.result-failed
					</v-icon>
				</div>
				<div
					v-if="status == 2"
					style="display:flex; justify-content:center;background-color: #54E800; height: 50px; width: 50px; border-radius: 50% "
				>
					<v-icon size="50">
						$vuetify.icons.result-cgpa
					</v-icon>
				</div>
				<div
					v-if="status == 3"
					style="display:flex; justify-content:center;background-color: #11CDEF; height: 50px; width: 50px; border-radius: 50% "
				>
					<v-icon size="50">
						$vuetify.icons.result-cgpa
					</v-icon>
				</div>
			</div>
		</div>
		<div class="d-flex mt-4">
			<div
				class="metric-rate mr-3"
				:class="rate[0] == '-' ? 'red--text' : 'green--text'"
			>
				{{ rate }}%
			</div>
			<div class="metric-timeline">
				since previous {{ status == 3 ? "session" : "semester" }}
			</div>
		</div>
	</v-card>
</template>

<script>
export default {
	props: {
		status: {
			type: Number,
			default: 0
		},
		number: {
			type: String
		},
		rate: {
			type: String,
			default: "0"
		}
	},
	computed: {
		metricData() {
			let res = {};
			switch (this.status) {
				case 0:
					res = { title: "PASSED COURSES" };
					break;
				case 1:
					res = { title: "FAILED COURSES" };
					break;
				case 2:
					res = { title: "CURRENT GPA" };
					break;
				case 3:
					res = { title: "CURRENT CGPA" };
					break;
				default:
					break;
			}
			return res;
		}
	}
};
</script>

<style lang="scss" scoped>
.metric-item {
	width: 250px;
	border-radius: 5px;

	.metric-title {
		font-size: 0.8rem;
		font-weight: 400;
	}

	.metric-value {
		font-size: 1.3rem;
		font-weight: bolder;
	}

	.metric-rate {
		font-size: 0.7rem;
	}

	.metric-timeline {
		font-size: 0.7rem;
	}
}
</style>
