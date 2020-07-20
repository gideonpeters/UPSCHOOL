<template>
  <v-app>
    <div>
      <div class="my-5">
        <v-btn icon size="10" class="mr-1" @click="$router.go(-1)">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        Staff
        Information / {{staff.name}}
      </div>

      <staff-profile isStaff :staff="staff" />
    </div>
  </v-app>
</template>

<script>
import StaffProfile from "@/components/general/StaffProfile";
export default {
  components: {
    StaffProfile
  },
  data() {
    return {
      // staff: null
    };
  },
  computed: {
    staff() {
      let id = this.$route.params.id;
      let res;
      if (id) {
        res = this.$store.getters.getStaffById(id);
      } else {
        res = this.$store.state.loggedInStaff;
      }
      return res;
    }
  },
  async mounted() {
    try {
      await this.$store.dispatch("getStaff");
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
