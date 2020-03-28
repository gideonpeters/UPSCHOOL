<template>
	<div>
		<v-hover>
			<template v-slot:default="{ hover }">
				<v-card class="pa-4 mx-4 shadow__sm pointer mb-3" flat width="180" height="220" tile>
					<div>
						<div class="border-dashed">
							<div class="d-flex flex-column align-center">
								<div class="d-flex fs-5">
									<div>DEC</div>
									<v-icon size="5" class="px-2">mdi-circle</v-icon>
									<div>Mon</div>
								</div>
								<div>
									<div class="fs-1 font-weight-bold">03</div>
								</div>
							</div>
						</div>
						<div class="fs-3 text-center mt-3 primary--text font-weight-medium">CEN511</div>
						<div class="fs-4 text-center mt-1">TIME: 5: 00AM</div>
						<div class="d-flex flex-lg-row flex-column text-center mt-1 fs-4">
							<div class>LOCATION:</div>
							<div class="text-truncate">EIE building, 500 level class</div>
						</div>
					</div>
					<v-fade-transition>
						<v-overlay absolute v-if="hover">
							<v-btn class="fs-4 px-4" color="primary" rounded depressed @click="overlay = false">
								<div class="fs-4 px-4">VIEW</div>
							</v-btn>
						</v-overlay>
					</v-fade-transition>
				</v-card>
			</template>
		</v-hover>
	</div>
</template>

<script>
export default {
	data() {
		return {
			overlay: false
		};
	}
};
</script>