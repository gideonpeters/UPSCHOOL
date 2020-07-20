<template>
  <v-app>
    <v-container>
      <!-- <v-card class="pa-3"> -->
      <v-skeleton-loader :loading="isLoading" ref="skeleton" :type="'date-picker'" class="mx-auto">
        <v-card class="pa-3">
          <v-subheader v-if="!isAdmin">{{ typeToShow[typee] }}</v-subheader>
          <v-row>
            <v-col>
              <v-sheet height="64">
                <v-toolbar flat color="white">
                  <v-btn outlined class="mr-4" color="grey darken-2" @click="setToday">Today</v-btn>
                  <v-btn fab text small color="grey darken-2" @click="prev">
                    <v-icon small>mdi-chevron-left</v-icon>
                  </v-btn>
                  <v-btn fab text small color="grey darken-2" @click="next">
                    <v-icon small>mdi-chevron-right</v-icon>
                  </v-btn>
                  <v-toolbar-title>{{ title }}</v-toolbar-title>
                  <v-spacer />
                  <v-menu bottom right v-if="!isAdmin">
                    <template v-slot:activator="{ on }">
                      <v-btn outlined color="grey darken-2" v-on="on">
                        <span>{{ typeToShow[typee] }}</span>
                        <v-icon right>mdi-menu-down</v-icon>
                      </v-btn>
                    </template>
                    <v-list>
                      <v-list-item @click="typee = 'all'">
                        <v-list-item-title>All</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="typee = 'school'">
                        <v-list-item-title>School Events</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="typee = 'course'">
                        <v-list-item-title>Course</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="typee = 'personal'">
                        <v-list-item-title>Personal</v-list-item-title>
                      </v-list-item>
                    </v-list>
                  </v-menu>
                  <div class="px-3"></div>
                  <v-menu bottom right>
                    <template v-slot:activator="{ on }">
                      <v-btn outlined color="grey darken-2" v-on="on">
                        <span>{{ typeToLabel[type] }}</span>
                        <v-icon right>mdi-menu-down</v-icon>
                      </v-btn>
                    </template>
                    <v-list>
                      <v-list-item @click="type = 'day'">
                        <v-list-item-title>Day</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="type = 'week'">
                        <v-list-item-title>Week</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="type = 'month'">
                        <v-list-item-title>Month</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="type = '4day'">
                        <v-list-item-title>4 days</v-list-item-title>
                      </v-list-item>
                    </v-list>
                  </v-menu>
                </v-toolbar>
              </v-sheet>
              <v-sheet height="600">
                <v-calendar
                  ref="calendar"
                  v-model="focus"
                  color="primary"
                  :events="events"
                  :event-color="getEventColor"
                  :now="today"
                  :type="type"
                  event-start="start_time"
                  event-end="end_time"
                  @click:event="showEvent"
                  @click:more="viewDay"
                  @click:date="viewDay"
                  @change="updateRange"
                />
                <v-menu
                  v-model="selectedOpen"
                  :close-on-content-click="false"
                  :activator="selectedElement"
                  offset-x
                >
                  <v-card color="grey lighten-4" min-width="350px" flat v-if="selectedEvent">
                    <v-toolbar :color="selectedEvent.color" dark>
                      <!-- <v-btn icon>
									<v-icon>mdi-pencil</v-icon>
                      </v-btn>-->
                      <v-toolbar-title v-html="selectedEvent.name" />
                      <v-spacer />
                      <!-- <v-btn icon>
									<v-icon>mdi-heart</v-icon>
                      </v-btn>-->
                      <!-- <v-btn icon>
									<v-icon>mdi-dots-vertical</v-icon>
                      </v-btn>-->
                    </v-toolbar>
                    <v-card-text>
                      <span
                        v-if="selectedEvent.eventable"
                        v-html="selectedEvent.eventable.description"
                      />
                    </v-card-text>
                    <v-card-actions>
                      <v-btn text color="secondary" @click="selectedOpen = false">Cancel</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-menu>
              </v-sheet>
            </v-col>
          </v-row>
        </v-card>
      </v-skeleton-loader>
      <!-- </v-card> -->
    </v-container>
  </v-app>
</template>

<script>
import Axios from "axios";
export default {
  // name: "calendar",
  props: {
    isAdmin: {
      type: Boolean,
      default: false
    },
    isStaff: {
      type: Boolean,
      default: false
    },
    isStudent: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    focus: new Date().toISOString().substr(0, 10),
    type: "month",
    isLoading: false,
    typeToLabel: {
      month: "Month",
      week: "Week",
      day: "Day",
      "4day": "4 Days"
    },
    typeToShow: {
      all: "All Events",
      school: "School Events",
      course: "Course Events",
      personal: "Personal Events"
    },
    typee: "all",
    start: null,
    end: null,
    today: new Date().toISOString().substr(0, 10),
    selectedEvent: {},
    selectedElement: null,
    selectedOpen: false,
    events: [],
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
  computed: {
    title() {
      const { start, end } = this;
      if (!start || !end) {
        return "";
      }

      const startMonth = this.monthFormatter(start);
      const endMonth = this.monthFormatter(end);
      const suffixMonth = startMonth === endMonth ? "" : endMonth;

      const startYear = start.year;
      const endYear = end.year;
      const suffixYear = startYear === endYear ? "" : endYear;

      const startDay = start.day + this.nth(start.day);
      const endDay = end.day + this.nth(end.day);

      switch (this.type) {
        case "month":
          return `${startMonth} ${startYear}`;
        case "week":
        case "4day":
          return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`;
        case "day":
          return `${startMonth} ${startDay} ${startYear}`;
      }
      return "";
    },
    monthFormatter() {
      return this.$refs.calendar.getFormatter({
        timeZone: "UTC",
        month: "long"
      });
    }
  },
  async mounted() {
    try {
      this.isLoading = true;
      await Axios.get("event").then(res => {
        this.events = res.data.data;
        // console.log(res.data);
        this.isLoading = false;
      });
      this.$refs.calendar.checkChange();
      // console.log(res.data.data);
    } catch (error) {
      throw error;
    }
  },
  methods: {
    viewDay({ date }) {
      this.focus = date;
      this.type = "day";
    },
    getEventColor(event) {
      let res;
      switch (event.recurrence) {
        case "daily":
          res = this.colors[2];
          break;
        case "weekly":
          res = this.colors[3];
          break;
        case "monthly":
          res = this.colors[4];
          break;

        default:
          res = this.colors[this.colors.length - 1];
          break;
      }
      return res;
    },
    setToday() {
      this.focus = this.today;
    },
    prev() {
      this.$refs.calendar.prev();
    },
    next() {
      this.$refs.calendar.next();
    },
    showEvent({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event;
        this.selectedElement = nativeEvent.target;
        setTimeout(() => (this.selectedOpen = true), 10);
      };

      if (this.selectedOpen) {
        this.selectedOpen = false;
        setTimeout(open, 10);
      } else {
        open();
      }

      nativeEvent.stopPropagation();
    },
    updateRange({ start, end }) {
      this.start = start;
      this.end = end;
    },
    nth(d) {
      return d > 3 && d < 21
        ? "th"
        : /* eslint-disable no-mixed-spaces-and-tabs */
          ["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th"][d % 10];
      /* eslint-enable no-mixed-spaces-and-tabs */
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
