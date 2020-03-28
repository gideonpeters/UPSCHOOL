<template>
	<v-app>
		<v-row>
			<v-col>
				<v-card class="mx-auto" max-width="600">
					<v-toolbar flat dense>
						<v-toolbar-title>
							<span class="subheading">CGPA TARGET</span>
						</v-toolbar-title>
						<v-spacer></v-spacer>
						<v-btn icon v-if="canEdit" @click="canEdit = false">
							<v-icon>mdi-pencil</v-icon>
						</v-btn>
					</v-toolbar>

					<v-card-text>
						<v-row class="mb-4" justify="space-between" align="center">
							<v-col class="text-left">
								<span class="display-3 font-weight-light">{{ (bpm).toFixed(2) }}</span>
								<span class="subheading font-weight-light mr-1">CURRENT: 4.32</span>
								<v-fade-transition></v-fade-transition>
							</v-col>
							<v-col class="text-right" v-if="!canEdit" @click="canEdit = true">
								<v-btn color="success" text outlined>LET'S DO THIS!</v-btn>
								<!-- <v-btn :color="color" dark depressed fab @click="toggle">
									<v-icon large>{{ isPlaying ? 'mdi-pause' : 'mdi-play' }}</v-icon>
								</v-btn>-->
							</v-col>
						</v-row>

						<v-slider
							:disabled="canEdit"
							v-model="bpm"
							thumb-label="always"
							:color="color"
							step="0.01"
							track-color="grey"
							min="0.00"
							max="5.00"
						>
							<!-- <template v-slot:prepend>
								<v-icon :color="color" @click="decrement">mdi-minus</v-icon>
							</template>

							<template v-slot:append>
								<v-icon :color="color" @click="increment">mdi-plus</v-icon>
							</template>-->
						</v-slider>
					</v-card-text>
				</v-card>
			</v-col>
		</v-row>
	</v-app>
</template>

<script>
export default {
	data: () => ({
		bpm: 4.5,
		interval: null,
		isPlaying: false,
		canEdit: true
	}),

	computed: {
		color() {
			if (this.bpm < 100) return "indigo";
			if (this.bpm < 125) return "teal";
			if (this.bpm < 140) return "green";
			if (this.bpm < 175) return "orange";
			return "red";
		},
		animationDuration() {
			return `${60 / this.bpm}s`;
		}
	},

	methods: {
		decrement() {
			this.bpm--;
		},
		increment() {
			this.bpm++;
		},
		toggle() {
			this.isPlaying = !this.isPlaying;
		}
	}
};
</script>

<style>
@keyframes metronome-example {
	from {
		transform: scale(0.5);
	}

	to {
		transform: scale(1);
	}
}

.v-avatar--metronome {
	animation-name: metronome-example;
	animation-iteration-count: infinite;
	animation-direction: alternate;
}
</style>