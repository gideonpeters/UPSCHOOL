<template>
  <v-app>
    <v-container>
      <v-card class="pa-4" flat v-if="roomGroups.length == 0">
        <div class="my-5">No allocation history</div>
        <v-btn
          color="success"
          @click="$router.push({name: 'student.residence'})"
        >Visit Residence Allocation</v-btn>
      </v-card>
      <v-card class="pa-3 mb-5" v-for="group in roomGroups" :key="group.id">
        <v-subheader>{{ group[0].session.title }}</v-subheader>
        <div class="mb-5" v-for="room in group" :key="room.id">
          <v-subheader>{{ room.semester.name }}</v-subheader>
          <v-data-table :headers="headers" :items="allRoom(room)" hide-default-footer>
            <template v-slot:item.actions="{}">
              <div class="d-flex align-center justify-center">
                <v-btn color="grey" icon>
                  <v-icon small>mdi-eye</v-icon>
                </v-btn>
              </div>
            </template>
          </v-data-table>
        </div>
      </v-card>
    </v-container>
  </v-app>
</template>

<script>
import Axios from "axios";
export default {
  data() {
    return {
      roomGroups: [],
      headers: [
        { text: "ROOM ID", value: "room.room_id", sortable: true },
        { text: "WING/BLOCK", value: "room.wing", sortable: true },
        { text: "HALL", value: "room.hall.name", sortable: true },
        {
          text: "CAPACITY",
          value: "room.capacity",
          sortable: true,
          align: "center"
        },
        {
          text: "ACTIONS",
          value: "actions",
          sortable: true,
          align: "center"
        }
      ]
    };
  },
  methods: {
    allRoom(item) {
      let res = [];
      return [...res, item];
    }
  },
  async mounted() {
    try {
      let id = this.$store.state.loggedInUser.id;
      let res = await Axios.get(`room-allocation?student_id=${id}`);
      // console.log(res.data);
      this.roomGroups = res.data.data;
    } catch (error) {
      throw error;
    }
  }
};
</script>
