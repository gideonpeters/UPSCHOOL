<template>
	<v-app>
		<v-container fluid class="pa-0">
			<v-row>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">PENDING ASSIGNMENTS</v-subheader>
						<v-data-table :headers="asgnHeaders" :items="asgn" hide-default-footer>
							<template v-slot:item.check="{ item }">
								<v-icon size="15" :color="item.id == 1 ? 'blue accent-2 ' : 'grey'">mdi-circle</v-icon>
								<!-- <v-simple-checkbox v-model="item.check" disabled> -->
								<!-- </v-simple-checkbox> -->
							</template>
							<template v-slot:item.action="{  }">
								<v-icon small class="mr-2 pointer">mdi-eye</v-icon>
								<v-icon small class="pointer">mdi-pencil</v-icon>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
				<v-col>
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">SUBMITTED ASSIGNMENTS</v-subheader>
						<v-data-table :headers="asgnHeaders" :items="asgn" hide-default-footer>
							<template v-slot:item.check="{ item }">
								<v-icon size="15" :color="item.id == 1 ? 'blue accent-2 ' : 'grey'">mdi-circle</v-icon>
								<!-- <v-simple-checkbox v-model="item.check" disabled> -->
								<!-- </v-simple-checkbox> -->
							</template>
							<template v-slot:item.action="{  }">
								<v-icon small class="mr-2 pointer">mdi-eye</v-icon>
								<v-icon small class="pointer">mdi-pencil</v-icon>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
export default {
	data: () => ({
		asgnHeaders: [
			{ text: "COURSE CODE ", value: "course_code", sortable: false },
			{
				text: "TOPIC",
				align: "start",
				sortable: false,
				value: "name"
			},
			{ text: "WEIGHT", value: "weight", sortable: false },
			{ text: "DUE DATE", value: "time", sortable: false },
			{ text: "ACTIONS", value: "action", sortable: false }
		],
		asgn: [
			{
				id: 1,
				course_code: "GST411",
				name: "GST111: Communications in English Language",
				time: "Nov 26, 2020",
				weight: "10%"
			},
			{
				id: 2,
				course_code: "EIE411",
				name: "EIE517: applied Electronics",
				time: "June 26, 2020",
				weight: "20%"
			},
			{
				id: 3,
				course_code: "CEN411",
				name: "Report on the 8051 micro controller",
				time: "Mar 31, 2020",
				weight: "20%"
			}
		]
	})
};
</script>