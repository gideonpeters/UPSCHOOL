<template>
  <div>
    <v-card
      flat
      :class="flat ? '' : 'elevation-1'"
      class="px-3 pa-3 pb-5 mb-3 text-center"
      v-if="staff"
    >
      <div class="d-flex flex-column align-center pb-5">
        <div class="my-3">
          <v-avatar height="130" width="130">
            <v-img :src="staff.profile_picture"></v-img>
          </v-avatar>
        </div>
        <div
          class="text-uppercase"
        >{{`${staff.first_name} ${staff.middle_name ? staff.middle_name :''} ${staff.last_name}`}}</div>
        <div class="pt-3 grey--text">#{{ staff.staff_number }}</div>
        <div class="py-3">{{staff.department.name}}</div>
        <!-- <div class="pb-5 fs-4" v-if="!staff">{{staff.residence}}/{{staff.room_number}}</div> -->

        <div class="py-5" v-if="isSuspended">
          <v-chip color="red lighten-2" class="white--text" small>Account Suspended</v-chip>
        </div>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
  props: {
    staff: {
      type: Object
    },
    isStaff: {
      type: Boolean,
      default: false
    },
    isSuspended: {
      type: Boolean,
      default: false
    },
    flat: {
      type: Boolean,
      default: false
    }
  }
};
</script>