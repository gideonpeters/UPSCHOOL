<template>
	<v-app>
		<v-container fluid class="pa-0">
			<v-row>
				<v-col>
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">C.A. SCORES</v-subheader>
						<v-data-table
							:headers="asgnHeaders"
							:items="asgn"
							hide-default-footer
						>
							<template v-slot:item.check="{ item }">
								<v-icon
									size="15"
									:color="
										item.id == 1 ? 'blue accent-2 ' : 'grey'
									"
									>mdi-circle</v-icon
								>
								<!-- <v-simple-checkbox v-model="item.check" disabled> -->
								<!-- </v-simple-checkbox> -->
							</template>
							<template v-slot:item.total="{ item }">
								<div v-for="i in 3" :key="i">
									<div>{{ item.ca1 + item.ca2 }}</div>
								</div>
							</template>
							<!-- <template v-slot:item.action="{  }">
								<v-icon small class="mr-2 pointer">mdi-eye</v-icon>
								<v-icon small class="pointer">mdi-pencil</v-icon>
							</template>-->
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
			{ text: "CA 1 ", value: "ca1", sortable: false },
			{ text: "CA 2 ", value: "ca2", sortable: false },
			{ text: "TOTAL", value: "total", sortable: false }
			// { text: "WEIGHT", value: "weight", sortable: false },
			// { text: "ACTIONS", value: "action", sortable: false }
		],
		asgn: [
			{
				id: 1,
				course_code: "GST411",
				name: "GST111: Communications in English Language",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 2,
				course_code: "EIE411",
				name: "EIE517: applied Electronics",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 3,
				course_code: "CEN411",
				name: "Report on the 8051 micro controller",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 6,
				course_code: "GST411",
				name: "GST111: Communications in English Language",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 4,
				course_code: "EIE411",
				name: "EIE517: applied Electronics",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 5,
				course_code: "CEN411",
				name: "Report on the 8051 micro controller",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 7,
				course_code: "GST411",
				name: "GST111: Communications in English Language",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 8,
				course_code: "EIE411",
				name: "EIE517: applied Electronics",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 9,
				course_code: "CEN411",
				name: "Report on the 8051 micro controller",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 10,
				course_code: "GST411",
				name: "GST111: Communications in English Language",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 11,
				course_code: "EIE411",
				name: "EIE517: applied Electronics",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			},
			{
				id: 12,
				course_code: "CEN411",
				name: "Report on the 8051 micro controller",
				ca1: 12,
				ca2: 13,
				weight: "30%"
			}
		]
	}),
	async mounted() {
		// let res = [
		// 	{ id: 1, name: "CA1", score: 13 },
		// 	{ id: 1, name: "CA2", score: 10 }
		// ];
		// res;
		// this.asgnHeaders.push();
	}
};
</script>
