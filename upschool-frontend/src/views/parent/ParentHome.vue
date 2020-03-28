<template>
	<v-app>
		<v-row>
			<v-col cols="12">
				<div class="d-flex align-baseline">
					<h1 class="font-weight-light">
						Hi, Covenant University, <br />
						Welcome to Upschool!
					</h1>
					<v-spacer></v-spacer>
					<div>{{ new Date(Date.now()).toDateString() }}</div>
				</div>
				<v-divider></v-divider>
				<v-card flat class="pa-3 mt-5">
					<v-row>
						<v-col cols="6">
							<v-img
								:src="require('@/assets/svg/home_image.svg')"
								height="500"
								contain
							></v-img>
						</v-col>
						<v-col>
							<v-chip color="primary" small class="ma-5"
								>UNIVERSITY EDITION</v-chip
							>
							<v-card-text class=" subtitle-1 pa-5">
								We're equipped to give you the best school
								management experience ever ranging from
								management of courses, fees, students, grades &
								results
							</v-card-text>
							<v-btn
								color="success"
								class="ma-5"
								@click="$router.push({ name: 'parent.setup' })"
							>
								<v-icon class="mr-2">mdi-settings</v-icon>
								Let's get you all set up
							</v-btn>
						</v-col>
					</v-row>
				</v-card>
			</v-col>
		</v-row>
	</v-app>
</template>
