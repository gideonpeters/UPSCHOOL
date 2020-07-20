<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col cols="12" md="12">
          <div>Events & Attendance</div>
        </v-col>
        <v-col cols="12" md="3" sm="6">
          <metric title="Number of Events" :value="events.length" />
        </v-col>
        <v-col cols="8"></v-col>
        <v-col cols="12" sm="6" md="4">
          <v-text-field
            v-model="search"
            single-line
            hide-details
            flat
            label="Search events by name"
            solo
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="9">
          <v-card flat class="pa-3">
            <div class="d-flex justify-space-between align-center">
              <v-subheader class="pa-0">EVENTS</v-subheader>
              <v-dialog v-model="dialog" persistent max-width="600px">
                <template v-slot:activator="{ on }">
                  <v-btn color="primary" small dark depressed v-on="on">ADD EVENT</v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">Create Event</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="6" md="12">
                          <v-text-field label="Title of Event" outlined required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                          <v-select
                            outlined
                            v-model="
																		selectFrequency
																	"
                            :items="
																		frequency
																	"
                            tile
                            label="Frequency"
                            chips
                            required
                          ></v-select>
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                          <v-textarea
                            v-model="
																		editorContent
																	"
                            label="Description"
                            outlined
                          />
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                          <v-select
                            :items="
																		priority
																	"
                            label="Priority"
                            hint="Voluntary or Mandatory"
                            persistent-hint
                            required
                            tile
                            outlined
                          ></v-select>
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                          <v-combobox
                            v-model="
																		selectAttendableApply
																	"
                            :items="
																		attendableGroups
																	"
                            tile
                            outlined
                            label="Apply To"
                            multiple
                            chips
                            required
                          ></v-combobox>
                        </v-col>
                      </v-row>
                    </v-container>
                    <small>
                      *indicates required
                      field
                    </small>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
                    <v-btn
                      class="white--text"
                      color="primary"
                      depressed
                      @click="dialog = false"
                    >Activate & Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </div>

            <div class="fs-5 font-italic d-flex align-center">
              <v-icon small color="blue">mdi-information</v-icon>Click event title to view attendance report
            </div>

            <v-data-table
              :headers="headers"
              :items="events"
              :search="search"
              sort-by="calories"
              :items-per-page="5"
            >
              <template v-slot:item.title="{ item }">
                <div class="text-capitalize pointer" @click="goToPage(item)">
                  <u>{{item.title}}</u>
                </div>
              </template>
              <template v-slot:item.status="{ item }">
                <v-chip :color="getColor(item.event.status)" dark small>
                  {{
                  item.status
                  ? "ACTIVE"
                  : "INACTIVE"
                  }}
                </v-chip>
              </template>
              <template v-slot:item.priority="{ item }">
                <div class>
                  <v-icon
                    small
                    :color="
													!item.event.priority
														? 'info lighten-3'
														: 'red lighten-3'
												"
                  >mdi-circle-slice-8</v-icon>
                </div>
              </template>
              <template v-slot:item.frequency="{ item }">
                <div class="text-uppercase">{{item.event.recurrence}}</div>
              </template>
              <template v-slot:item.time="{ item }">
                <div class>
                  {{
                  moment(
                  item.event.start_time
                  ).format(
                  "dddd, MMMM Do YYYY, h:mm a"
                  )
                  }}
                </div>
              </template>
              <template v-slot:item.end_time="{ item }">
                <div class>
                  {{
                  moment(
                  item.event.end_time
                  ).format(
                  "dddd, MMMM Do YYYY, h:mm a"
                  )
                  }}
                </div>
              </template>
              <template v-slot:item.action="{ item }">
                <v-btn icon @click="viewItem(item)" color="grey">
                  <v-icon small>mdi-eye</v-icon>
                </v-btn>
                <v-btn
                  icon
                  @click="(dialogEdit = true, selectedItem = item, selectFrequency = item.event.recurrence, selectedPriority = item.event.priority, editorContent = item.description, dateStart = moment(item.event.start_time).format('YYYY-MM-DD'), timeStart = moment(item.event.start_time).format('HH:mm'), timeEnd = moment(item.event.end_time).format('HH:mm'))"
                  color="grey"
                >
                  <v-icon small>mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon @click="deleteItem(item)" color="grey">
                  <v-icon small>mdi-delete</v-icon>
                </v-btn>
              </template>
            </v-data-table>
            <v-dialog v-model="dialogEdit" persistent max-width="600px">
              <v-card>
                <v-card-title>
                  <span class="headline">Edit Event</span>
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="12">
                        <v-text-field
                          label="Title of Event"
                          :value="selectedItem.title"
                          outlined
                          required
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="6" md="12">
                        <v-textarea
                          v-model="
																		editorContent
																	"
                          label="Description"
                          outlined
                        />
                      </v-col>
                      <v-col cols="12" sm="6" md="12">
                        <v-select
                          :items="
																		priority
																	"
                          label="Priority"
                          v-model="selectedPriority"
                          item-text="text"
                          item-value="value"
                          hint="Voluntary or Mandatory"
                          persistent-hint
                          required
                          tile
                          outlined
                        ></v-select>
                      </v-col>
                      <v-col cols="12" sm="6" md="6">
                        <v-select
                          outlined
                          v-model="selectFrequency"
                          :items="
																		frequency
																	"
                          tile
                          label="Frequency"
                          chips
                          required
                        ></v-select>
                      </v-col>
                      <v-col cols="12" sm="6" md="6">
                        <v-dialog
                          ref="dialogDateStart"
                          v-model="modalDateStart"
                          :return-value.sync="dateStart"
                          persistent
                          width="290px"
                        >
                          <template v-slot:activator="{ on }">
                            <v-text-field
                              outlined
                              v-model="dateStart"
                              label="Select Initial Date"
                              prepend-inner-icon="mdi-calendar"
                              readonly
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker v-model="dateStart" scrollable>
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="modalDateStart = false">Cancel</v-btn>
                            <v-btn
                              text
                              color="primary"
                              @click="$refs.dialogDateStart.save(dateStart)"
                            >OK</v-btn>
                          </v-date-picker>
                        </v-dialog>
                      </v-col>
                      <v-col cols="11" sm="6">
                        <v-menu
                          ref="menuTimeStart"
                          v-model="menuTimeStart"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          :return-value.sync="timeStart"
                          transition="scale-transition"
                          offset-y
                          max-width="290px"
                          min-width="290px"
                        >
                          <template v-slot:activator="{ on }">
                            <v-text-field
                              outlined
                              v-model="timeStart"
                              label="From"
                              prepend-inner-icon="mdi-clock"
                              readonly
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-time-picker
                            v-if="menuTimeStart"
                            v-model="timeStart"
                            full-width
                            @click:minute="$refs.menuTimeStart.save(timeStart)"
                          ></v-time-picker>
                        </v-menu>
                      </v-col>
                      <v-col cols="11" sm="6">
                        <v-menu
                          ref="menuTimeEnd"
                          v-model="menuTimeEnd"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          :return-value.sync="timeEnd"
                          transition="scale-transition"
                          offset-y
                          max-width="290px"
                          min-width="290px"
                        >
                          <template v-slot:activator="{ on }">
                            <v-text-field
                              outlined
                              v-model="timeEnd"
                              label="To"
                              hint="the start time and end time can not be the same"
                              prepend-inner-icon="mdi-clock"
                              readonly
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-time-picker
                            v-if="menuTimeEnd"
                            v-model="timeEnd"
                            full-width
                            @click:minute="$refs.menuTimeEnd.save(timeEnd)"
                          ></v-time-picker>
                        </v-menu>
                      </v-col>
                      <v-col cols="12" sm="6" md="12">
                        <v-combobox
                          v-model="
																		selectAttendableApply
																	"
                          :items="
																		attendableGroups
																	"
                          tile
                          outlined
                          label="Apply To"
                          multiple
                          chips
                          required
                        ></v-combobox>
                      </v-col>
                    </v-row>
                  </v-container>
                  <small>
                    *indicates required
                    field
                  </small>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="dialogEdit = false">Close</v-btn>
                  <v-btn color="blue darken-1" text @click="dialogEdit = false">Save</v-btn>
                  <v-btn
                    class="white--text"
                    color="primary"
                    depressed
                    @click="dialogEdit = false"
                  >Activate & Save</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-card>
        </v-col>
        <v-col>
          <v-card flat class="pa-3 mt-4">
            <v-subheader class="pa-0">PRIORITY LEVELS</v-subheader>

            <div class="d-flex fs-4 mb-3">
              <div class="pr-4">
                <v-icon small color="info lighten-3">mdi-circle-slice-8</v-icon>
              </div>
              <div>Voluntary</div>
            </div>
            <div class="d-flex fs-4 mb-3">
              <div class="pr-4">
                <v-icon small color="red lighten-3">mdi-alert-circle</v-icon>
              </div>
              <div>Mandatory</div>
            </div>
          </v-card>
        </v-col>
        <!-- <v-col cols="12" md="3">
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">ATTENDABLE GROUPS</v-subheader>

						<div
							class="d-flex fs-4 mb-3"
							v-for="(attendableGroup,
									idx) in attendableGroups"
							:key="idx"
						>
							<div class="pr-4">
								<v-icon small>mdi-circle-slice-8</v-icon>
							</div>
							<div>{{ attendableGroup }}</div>
						</div>

						<div class="mt-4">
							<v-dialog v-model="dialogFull" fullscreen hide-overlay transition="dialog-bottom-transition">
								<template v-slot:activator="{ on }">
									<v-btn color="success" block depressed dark v-on="on" small>Create Attendable Group</v-btn>
								</template>
								<v-card flat>
									<v-toolbar dark color="primary">
										<v-btn icon dark @click="dialogFull = false">
											<v-icon>mdi-close</v-icon>
										</v-btn>
										<v-toolbar-title>
											Manage Attendable
											Group
										</v-toolbar-title>
										<v-spacer></v-spacer>
										<v-toolbar-items>
											<v-btn dark text @click="
															dialogFull = false
														">Save</v-btn>
										</v-toolbar-items>
									</v-toolbar>
									<v-container>
										<v-list>
											<v-list-item>
												<v-list-item-content>
													<v-list-item-title>
														Manage Attendable
														Group
													</v-list-item-title>
													<v-row align="center">
														<v-col>
															<v-card flat class="pa-3">
																<v-data-table
																	v-model="
																	selected
																"
																	:headers="
																	studentHeaders
																"
																	:items="
																	students
																"
																	:single-select="
																	singleSelect
																"
																	item-key="name"
																	show-select
																>
																	<template v-slot:top>
																		<div class="d-flex justify-space-between align-center">
																			<div>
																				<v-select
																					v-model="
																					selectAttendableGroup
																				"
																					:items="
																					attendableGroups
																				"
																					outlined
																					clearable
																					label="Select Group to Edit"
																					class="pa-3"
																				/>
																			</div>
																			<v-spacer></v-spacer>
																		
																			<div class="d-flex align-center justify-end">
																				<v-menu
																					v-model="filterMenu"
																					absolute
																					left
																					:close-on-content-click="false"
																					:close-on-click="selectedProperties.length > 0 ? false : true"
																					persistent
																					allow-overflow
																				>
																					<template v-slot:activator="{ on }">
																						<v-btn :ripple="false" v-on="on" color="grey" text>
																							<v-icon color="grey" small>mdi-filter</v-icon>
																							<div>Filter</div>
																						</v-btn>
																					</template>
																					<v-card class="pa-3 d-flex flex-column" min-width="350px">
																						<v-row>
																							<v-col cols="12">
																								<div class="d-flex">
																									<v-subheader class="fs-4 pa-0">PROPERTY</v-subheader>
																									<v-spacer></v-spacer>
																									<div class="d-flex align-center ml-3">
																										<v-menu offset-y>
																											<template v-slot:activator="{ on }">
																												<v-btn v-on="on" icon color="grey">
																													<v-icon small>mdi-plus-circle</v-icon>
																												</v-btn>
																											</template>
																											<v-list>
																												<v-list-item
																													v-for="(property, i) in properties"
																													:key="i"
																													@click="addFilter(property)"
																												>
																													<v-list-item-title>
																														<div class="fs-5 pointer">{{property}}</div>
																													</v-list-item-title>
																												</v-list-item>
																											</v-list>
																										</v-menu>
																									</div>
																								</div>
																								<v-card flat class="d-flex flex-column fs-4">
																									<v-row
																										align="baseline"
																										v-for="(selectedProperty, idx) in selectedProperties"
																										:key="idx"
																										wrap
																									>
																										<v-col cols="4" md="4">
																											<div class="d-flex align-center mr-3">
																												<v-icon small>mdi-dots-vertical</v-icon>

																												<div>{{selectedProperty}}</div>
																											</div>
																										</v-col>
																										<v-col cols="6" md="6">
																											<v-text-field
																												outlined
																												dense
																												v-model="propertyValues[idx]"
																												:placeholder="selectedProperty"
																											/>
																										</v-col>
																										<v-col cols="2" md="2">
																											<v-btn icon color="grey" @click="removeFilter(selectedProperty)">
																												<v-icon small color="grey">mdi-minus-circle</v-icon>
																											</v-btn>
																										</v-col>
																									</v-row>
																								</v-card>
																								<div></div>
																							</v-col>
																						</v-row>
																						<v-card-actions v-if="selectedProperties.length > 0">
																							<v-spacer></v-spacer>

																							<v-btn x-small color="error" text>Cancel</v-btn>
																							<v-btn x-small color="success" depressed @click="applyFilter">Apply</v-btn>
																						</v-card-actions>
																					</v-card>
																				</v-menu>

																				<v-menu offset-y :close-on-content-click="false">
																					<template v-slot:activator="{ on }">
																						<v-btn color="grey" icon v-on="on">
																							<v-icon color="grey" small>mdi-dots-vertical</v-icon>
																						</v-btn>
																					</template>
																					<v-list>
																						<v-list-item>
																							<v-list-item-title>Create New</v-list-item-title>
																						</v-list-item>
																					</v-list>
																				</v-menu>
																			</div>
																		</div>
																	</template>
																	<template v-slot:item.actions="{
																		item,
																	}">
																		<v-icon
																			small
																			@click="
																			deleteItem(
																				item
																			)
																		"
																		>mdi-delete</v-icon>
																	</template>
																</v-data-table>
															</v-card>
														</v-col>
													</v-row>
												</v-list-item-content>
											</v-list-item>
										</v-list>
									</v-container>
								</v-card>
							</v-dialog>
						</div>
					</v-card>

					
        </v-col>-->
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import Metric from "./../../components/parent/Metric";
// import VueTrix from "vue-trix";

// import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    Metric
    // VueTrix,
    // apexchart: VueApexCharts
  },
  // name: "attendance",
  data: () => ({
    search: "",
    dialog: false,
    dialogFull: true,
    dialogEdit: null,
    menuTimeStart: null,
    timeStart: null,
    menuDateStart: null,
    dateStart: null,
    menuTimeEnd: null,
    timeEnd: null,
    menuDateEnd: null,
    modalDateEnd: null,
    modalDateStart: null,
    dateEnd: null,
    filterMenu: null,
    selectFrequency: null,
    selectedPriority: null,
    selectAttendableGroup: null,
    selectAttendableApply: null,
    notifications: false,
    sound: true,
    editorContent: null,
    widgets: false,
    singleSelect: false,
    selected: [],
    selectedItem: {},
    attendableGroups: [
      "All 100 level Students",
      "All 300 level students",
      "All CST Students",
      "All SIWES Students",
      "All Final year students"
    ],
    frequency: ["once", "daily", "weekly", "monthly"],
    priority: [
      { text: "Voluntary", value: false },
      { text: "Mandatory", value: true }
    ],
    propertyValues: [],
    properties: [
      "department",
      "level",
      "program",
      "hall",
      "room_number",
      "final-year",
      "course"
    ],
    headers: [
      {
        text: "NAME",
        align: "start",
        sortable: false,
        value: "title"
      },
      { text: "START TIME", value: "time" },
      { text: "END TIME", value: "end_time" },
      {
        text: "FREQUENCY",
        value: "frequency"
      },
      { text: "STATUS", value: "status", align: "center" },
      { text: "PRIORITY", value: "priority", align: "center" },
      { text: "ACTIONS", value: "action" }
      // { text: "WEIGHTED SCORE", value: "protein" }
    ],
    studentHeaders: [
      { text: "Name", value: "name" },
      { text: "Matriculation Number", value: "matric_number" },
      { text: "Program", value: "program" },
      { text: "Level", value: "level" },
      { text: "Residence Hall", value: "residence" }
    ],
    selectedProperties: []
  }),
  computed: {
    students() {
      return this.$store.state.students;
    },

    events() {
      return this.$store.state.schoolEvents;
    },
    itemFrequency() {
      let ans = "";
      if (this.selectedItem.event) {
        ans = this.selectedItem.event.recurrence;
      }
      return ans;
    }
  },
  methods: {
    goToPage(v) {
      // console.log(v);
      this.$router.push({
        name: "parent.attendance.details",
        params: { id: v.id }
      });
    },
    getColor(val) {
      return val ? "green accent-3" : "red accent-2";
    },
    editItem() {},
    deleteItem() {},
    viewItem() {},
    addFilter(item) {
      this.selectedProperties.push(item);
      this.properties.splice(this.properties.indexOf(item), 1);
    },
    removeFilter(item) {
      this.selectedProperties.splice(this.selectedProperties.indexOf(item), 1);
      this.properties = [...this.properties, item];
    },
    applyFilter() {
      // console.table(this.propertyValues);
    },
    async createEvent() {}
  },
  async mounted() {
    try {
      this.$store.dispatch("getSchoolEvents");
    } catch (error) {
      throw error;
    }
  },
  watch: {
    timeEnd(v) {
      if (this.timeStart == v) this.timeEnd = null;
    },
    timeStart(v) {
      if (this.timeEnd == v) this.timeStart = null;
    }
  }
};
</script>

<style lang="scss" scoped>
.text-capitalize.pointer {
  &:hover {
    color: grey;
  }
}
</style>