<template>
	<div>
		<v-card flat>
			<v-subheader>ALPHA SEMESTER</v-subheader>
			<v-card-text>
				<v-data-table :headers="headers" :items="desserts" :items-per-page="10" hide-default-footer>
					<template slot="footer">
						<div class="d-flex mt-4 justify-end">
							<div class="fs-3 mr-4 font-weight-bold">GPA: 4.94</div>
							<div class="fs-3 font-weight-bold">CGPA: 4.96</div>
						</div>
					</template>
				</v-data-table>
			</v-card-text>

			<div>
				<v-subheader>OMEGA SEMESTER</v-subheader>
				<v-card-text>
					<v-data-table :headers="headers" :items="desserts" :items-per-page="10" hide-default-footer>
						<template slot="footer">
							<div class="d-flex mt-4 justify-end">
								<div class="fs-3 mr-4 font-weight-bold">GPA: 4.94</div>
								<div class="fs-3 font-weight-bold">CGPA: 4.96</div>
							</div>
						</template>
					</v-data-table>
				</v-card-text>
			</div>
		</v-card>
	</div>
</template>

<script>
export default {
	data: () => ({
		text:
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
		headers: [
			{
				text: "COURSE CODE",
				align: "start",
				sortable: false,
				value: "name"
			},
			{ text: "COURSE TITLE", value: "calories" },
			{ text: "CREDIT UNIT", value: "fat" },
			{ text: "GRADE SCORE", value: "carbs" },
			{ text: "WEIGHTED SCORE", value: "protein" }
		],
		desserts: [
			{
				name: "CST111",
				calories:
					"Use of Library, Study Skills and Information Communication Technology I",
				fat: 2.0,
				carbs: "A",
				protein: 4.0,
				iron: "1%"
			},
			{
				name: "GEC117",
				calories: "Technical Drawing",
				fat: 2.0,
				carbs: "A",
				protein: 4.3,
				iron: "1%"
			},
			{
				name: "MAT111",
				calories: "Mathematics I: Algebra",
				fat: 3.0,
				carbs: "A",
				protein: 6.0,
				iron: "7%"
			},
			{
				name: "MAT112",
				calories: "Mathematics II: Trigonometry and Geometry",
				fat: 2.0,
				carbs: "A",
				protein: 4.3,
				iron: "8%"
			},
			{
				name: "PHY111",
				calories: "Mechanics and Properties of Matter",
				fat: 2.0,
				carbs: "A",
				protein: 3.9,
				iron: "16%"
			},
			{
				name: "PHY112",
				calories: "Heat, Sound and Optics",
				fat: 2.0,
				carbs: "A",
				protein: 0.0,
				iron: "0%"
			},
			{
				name: "PHY119",
				calories: "Physics Practicals IA",
				fat: 1.0,
				carbs: "B",
				protein: 0,
				iron: "2%"
			},
			{
				name: "CHM111",
				calories: "General Physical Chemistry",
				fat: 3.0,
				carbs: "A",
				protein: 6.5,
				iron: "45%"
			},
			{
				name: "CHM119",
				calories: "General Chemistry Practical I",
				fat: 1.0,
				carbs: "A",
				protein: 4.9,
				iron: "22%"
			},
			{
				name: "EDS111",
				calories: "Entrepreneurial DevelopmentStudies I",
				fat: 1.0,
				carbs: "A",
				protein: 7,
				iron: "6%"
			},
			{
				name: "TMC111",
				calories: "Total Man Concept I",
				fat: 1.0,
				carbs: "A",
				protein: 7,
				iron: "6%"
			},
			{
				name: "TMC112",
				calories: "Total Man Concept - Sports",
				fat: 0.0,
				carbs: "A",
				protein: 7,
				iron: "6%"
			},
			{
				name: "GST111",
				calories: "Communication in English",
				fat: 2.0,
				carbs: "A",
				protein: 7,
				iron: "6%"
			}
		]
	})
};
</script>