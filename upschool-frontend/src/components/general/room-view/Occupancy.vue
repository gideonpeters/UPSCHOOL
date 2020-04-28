<template>
	<v-card class="pa-3" flat min-height="600px">
		<v-card class="pa-3 mt-4 mb-5" v-for="i in 3" :key="i">
			<v-row no-gutters>
				<v-col cols="12">
					<v-subheader>Alpha Semester 59</v-subheader>
				</v-col>
				<v-col>
					<v-data-table
						:headers="[{text: 'NAME', value: 'name'}, {text: 'ROOM ID', value: 'room_id'},{text: 'Hall', value: 'hall'}]"
						:items="[{name: 'Anesi Igebu', room_id: 'A101', hall: 'Dorcas Hall'}]"
					></v-data-table>
				</v-col>
			</v-row>
		</v-card>
	</v-card>
</template>
