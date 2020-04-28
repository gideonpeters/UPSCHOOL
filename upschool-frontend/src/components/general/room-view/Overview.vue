<template>
	<v-card class="pa-3" flat min-height="600px">
		<v-row no-gutters>
			<v-col cols="12">
				<v-card-title>Description:</v-card-title>
				<v-card-text v-html="'<p>This is the description</p>'"></v-card-text>
			</v-col>
			<v-col cols="12">
				<v-card-title>Room Type:</v-card-title>
				<v-card-text>Standard Room</v-card-text>
			</v-col>
			<v-col cols="12">
				<v-card-title>Hall:</v-card-title>
				<v-card-text>Daniel Hall</v-card-text>
			</v-col>
		</v-row>
	</v-card>
</template>
