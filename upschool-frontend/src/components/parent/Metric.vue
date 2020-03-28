<template>
	<v-card
		class="metric-card pa-4 elevation-1 pointer"
		@click="routeName && goToPage(routeName)"
	>
		<div class="d-flex flex-column">
			<div class="fs-4 mb-4">{{ title }}</div>
			<div class="d-flex align-bottom justify-space-between">
				<div class>
					<div class="fs-3 font-weight-bold">{{ value }}</div>
					<div class="fs-6 green--text">
						+{{ percentageChange }}% <br />
						since last semester
					</div>
				</div>
				<div>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink"
						width="112"
						height="40"
						viewBox="0 0 112 40"
					>
						<defs>
							<linearGradient
								id="linear-gradient"
								x1="0.5"
								x2="0.5"
								y2="1"
								gradientUnits="objectBoundingBox"
							>
								<stop offset="0" stop-color="#55d8fe" />
								<stop
									offset="1"
									stop-color="#54d8ff"
									stop-opacity="0.502"
								/>
							</linearGradient>
						</defs>
						<path
							id="Bar_Chart"
							data-name="Bar Chart"
							d="M98,119V101h6v18Zm-9,0V89h8v30Zm-9,0V99h8v20Zm-9,0V106h8v13Zm-9,0V94h8v25Zm-9,0V84h8v35Zm-9,0V94h8v25Zm-9,0V99h8v20Zm-9,0V79h8v40Zm-9,0V89h8v30Zm-7,0V101h6v18Zm-9,0V89H9v30Zm-9,0V99H0v20Z"
							transform="translate(8 -79)"
							fill="url(#linear-gradient)"
						/>
					</svg>
				</div>
			</div>
		</div>
	</v-card>
</template>

<script>
export default {
	props: {
		title: {
			type: String
		},
		value: {
			type: Number
		},
		percentageChange: {
			type: Number,
			default: 0
		},
		routeName: {
			type: String
		}
	},
	methods: {
		goToPage(name) {
			this.$router.push({ name });
		}
	}
};
</script>

<style lang="scss" scoped>
.metric-card {
	width: 250px;
}
</style>
