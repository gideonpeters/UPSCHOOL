<template>
  <v-row justify="center">
    <v-col cols="12" sm="6" class="my-2 px-1">
      <v-date-picker ref="picker" v-model="date" :picker-date.sync="pickerDate" full-width></v-date-picker>
    </v-col>
    <v-col cols="12" sm="6" class="my-2 px-1">
      <div class="title">Month news ({{ pickerDate || 'change month...' }})</div>
      <div class="subheading">Change month to see other news</div>
      <ul class="ma-4">
        <li
          v-for="note in notes"
          :key="note.id"
          class="text-capitalize"
        >{{ note.title }} ({{note.event.recurrence}})</li>
      </ul>
    </v-col>
  </v-row>
</template>

<script>
// import Axios from "axios";
export default {
  props: {
    isStudent: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    pickerDate: null,
    events: []
  }),
  computed: {
    notes() {
      let ans = [];
      if (this.events.length > 0) {
        let val = this.events.filter(item => {
          return (
            this.moment(
              this.moment(item.start_time).format("YYYY-MM-DD")
            ).month() ||
            this.moment(
              this.moment(item.end_time).format("YYYY-MM-DD")
            ).month() == this.moment(`${this.pickerDate}-01`).month()
          );
        });

        return val.filter(item => {
          return (
            this.moment(
              this.moment(item.start_time).format("YYYY-MM-DD")
            ).year() == this.moment(`${this.pickerDate}-01`).year()
          );
        });
      }
      return ans;
    }
  },
  watch: {
    pickerDate(val, v) {
      // console.log(val, this.date);
      // this.date = `${val}-01`;
    }
  },
  async mounted() {
    try {
      let res = await this.$store.dispatch("getSchoolEvents");

      this.events = res.data;
    } catch (error) {
      throw error;
      // console.log(error);
    }
  }
};
</script>