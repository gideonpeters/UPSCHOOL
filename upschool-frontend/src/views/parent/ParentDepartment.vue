<template>
  <v-app>
    <resource-view
      noView
      type="Departments"
      :headers="headers"
      :items="departments"
      viewRoute="parent.departments.details"
    />
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
    dialog: false,
    headers: [
      {
        text: "NAME",
        align: "left",
        sortable: false,
        value: "name"
      },
      { text: "COLLEGE", value: "college_name" },
      { text: "CREDENTIAL", value: "college_short_name" },
      // { text: "DEPARTMENT", value: "carbs" },
      // { text: "PHONE NUMBER", value: "protein" },
      // { text: "Residence", value: "residence" },
      { text: "ACTIONS", value: "action", sortable: false }
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),

  computed: {
    departments() {
      return this.$store.state.departments;
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  async mounted() {
    try {
      await this.$store.dispatch("getDepartments");
    } catch (error) {
      console.log(error);
    }
  },

  methods: {
    initialize() {
      this.desserts = [
        {
          id: 1,
          name: "Uzoatuegwu Petrina Chidera",
          calories: "11CU02889",
          fat: "Senior Lecturer",
          carbs: "EIE",
          residence: "Dorcas Hall",
          protein: "080947373728"
        },
        {
          id: 2,
          name: "Shobande Josephine",
          calories: "12CU02873",
          fat: "Lecturer II",
          carbs: "EIE",
          residence: "Dorcas Hall",
          protein: "080947373728"
        },
        {
          id: 3,
          name: "Owolabi Ifeoluwa Anuoluwa",
          calories: "15CU02880",
          fat: "Professor",
          carbs: "CST",
          residence: "Deborah Hall",
          protein: "080947373728"
        },
        {
          id: 4,
          name: "Udochi Dikamsiyochi Young",
          calories: "15CU02885",
          fat: "Associate Professor",
          carbs: "CBSS",
          residence: "Daniel Hall",
          protein: "080947373728"
        },
        {
          id: 5,
          name: "Williams Adedayo Adewale, a.",
          calories: "15CU02890",
          fat: "Professor",
          carbs: "CDLS",
          residence: "Peter Hall",
          protein: "080947373728"
        },
        {
          id: 6,
          name: "Paul Chukwuebuka Chimezie",
          calories: "15CU02875",
          fat: "Lecturer I",
          carbs: "CEDS",
          protein: "080947373728",
          residence: "Joseph Hall"
        },
        {
          id: 7,
          name: "Okoye Emeka Elvis",
          calories: "15CU02857",
          fat: "Lecturer II",
          carbs: "COE",
          protein: "080947373728",
          residence: "John Hall"
        },
        {
          id: 8,
          name: "Olomo Rachael Ayobami",
          calories: "14CU016805",
          fat: "Graduate Assistant",
          carbs: "COE",
          protein: "080947373728",
          residence: "Dorcas Hall"
        },
        {
          id: 9,
          name: "Olashore Oluwatoyosi ",
          calories: "15CU02861",
          fat: "Graduate Assistant",
          carbs: "COE",
          protein: "080947373728",
          residence: "Dorcas Hall"
        },
        {
          id: 10,
          name: "Oguntolu Shalom Folayan",
          calories: "15CU02852",
          fat: "Senior Lecturer",
          carbs: "CEDS",
          protein: "080947373728",
          residence: "Paul Hall"
        }
      ];
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.desserts.splice(index, 1);
    },

    goToPage(v) {
      // console.log(v);
      this.$router.push({
        name: "parent.students.view",
        params: { id: v.id }
      });
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>