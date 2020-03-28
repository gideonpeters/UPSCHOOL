<template>
	<v-sheet height="300">
		<v-calendar
			ref="calendar"
			v-model="value"
			:weekdays="weekday"
			type="month"
			:events="[]"
			:event-overlap-mode="mode"
			:event-overlap-threshold="30"
			:event-color="getEventColor"
			@change="getEvents"
		/>
	</v-sheet>
</template>

<script>
export default {
	data: () => ({
		events: [
			{
				name: "Vacation",
				start: "2018-12-30",
				end: "2019-01-02"
			},
			{
				name: "Meeting",
				start: "2019-01-07"
			},
			{
				name: "30th Birthday",
				start: "2019-01-03"
			},
			{
				name: "New Year",
				start: "2019-01-01"
			},
			{
				name: "Conference",
				start: "2019-01-21"
			},
			{
				name: "Hackathon",
				start: "2019-01-30",
				end: "2019-02-01"
			}
		],
		type: "month",
		types: ["month", "week", "day", "4day"],
		mode: "stack",
		modes: ["stack", "column"],
		weekday: [0, 1, 2, 3, 4, 5, 6],
		weekdays: [
			{ text: "Sun - Sat", value: [0, 1, 2, 3, 4, 5, 6] },
			{ text: "Mon - Sun", value: [1, 2, 3, 4, 5, 6, 0] },
			{ text: "Mon - Fri", value: [1, 2, 3, 4, 5] },
			{ text: "Mon, Wed, Fri", value: [1, 3, 5] }
		],
		value: "",
		now: Date.now(),
		colors: [
			"blue",
			"indigo",
			"deep-purple",
			"cyan",
			"green",
			"orange",
			"grey darken-1"
		],
		names: [
			"Meeting",
			"Holiday",
			"PTO",
			"Travel",
			"Event",
			"Birthday",
			"Conference",
			"Party"
		]
	}),
	methods: {
		getEvents({ start, end }) {
			const events = [];

			const min = new Date(`${start.date}T00:00:00`);
			const max = new Date(`${end.date}T23:59:59`);
			const days = (max.getTime() - min.getTime()) / 86400000;
			const eventCount = this.rnd(days, days + 20);

			for (let i = 0; i < eventCount; i++) {
				const allDay = this.rnd(0, 3) === 0;
				const firstTimestamp = this.rnd(min.getTime(), max.getTime());
				const first = new Date(
					firstTimestamp - (firstTimestamp % 900000)
				);
				const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000;
				const second = new Date(first.getTime() + secondTimestamp);

				events.push({
					name: this.names[this.rnd(0, this.names.length - 1)],
					start: this.formatDate(first, !allDay),
					end: this.formatDate(second, !allDay),
					color: this.colors[this.rnd(0, this.colors.length - 1)]
				});
			}

			this.events = events;
		},
		getEventColor(event) {
			return event.color;
		},
		rnd(a, b) {
			return Math.floor((b - a + 1) * Math.random()) + a;
		},
		formatDate(a, withTime) {
			return withTime
				? `${a.getFullYear()}-${a.getMonth() +
						1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
				: `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`;
		}
	}
};
</script>