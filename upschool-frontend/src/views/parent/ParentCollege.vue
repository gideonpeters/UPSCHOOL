<template>
  <v-app>
    <div>
      <resource-view
        noView
        type="Colleges"
        :headers="headers"
        :items="colleges"
        viewRoute="parent.colleges.details"
      />
    </div>
  </v-app>
</template>

<script>
import ResourceView from "@/components/general/ResourceView";

export default {
  components: {
    ResourceView
  },
  data: () => ({
    search: "",
    headers: [
      {
        text: "NAME",
        align: "left",
        sortable: false,
        value: "name"
      },
      { text: "CREDENTIALS", value: "short_name" },
      { text: "ACTIONS", value: "action", sortable: false }
    ]
  }),

  computed: {
    colleges() {
      return this.$store.state.colleges;
    }
  },
  async mounted() {
    try {
      await this.$store.dispatch("getColleges");
    } catch (error) {
      console.log(error);
    }
  }
};
</script>