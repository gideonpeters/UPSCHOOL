import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		token: localStorage.getItem("upschool-token") || "tre",
		selectedCourses: [],
		courseCategories: [
			{
				id: 1,
				title: "Departmental Courses",
				subCategories: [
					{ id: 1, title: "EIE Courses" },
					{ id: 2, title: "Mech Courses" }
				]
			},
			{
				id: 2,
				title: "College Wide Courses Course",
				subCategories: [
					{ id: 1, title: "CST Courses" },
					{ id: 2, title: "COE Courses" }
				]
			}
		],
		courses: [
			{
				id: 1,
				title: "Real Analysis",
				course_code: "GEC411",
				credit_unit: 2,
				status: "registered",
				semester: { id: 1, name: "Alpha Semester" },
				prerequisites: [
					{ id: 1, course_id: 5 },
					{ id: 2, course_id: 2 }
				],
				facilitators: [
					{ id: 1, staff_id: 1 },
					{ id: 2, staff_id: 2 }
				],
				categories: [
					{
						id: 1,
						title: "Departmental Courses",
						subCategories: [{ id: 1, title: "EIE Courses" }]
					},
					{
						id: 1,
						title: "College Wide Courses Course",
						subCategories: [{ id: 2, title: "COE Courses" }]
					}
				],
				sections: [
					{
						id: 1,
						title: "Module 1",
						subsection: [
							{ id: 1, name: "i8086.pdf", type: "file" },
							{
								id: 2,
								name: "Mobility of electrons.docx",
								type: "file"
							},
							{
								id: 3,
								name: "Term Paper",
								type: "assignment",
								submissions: []
							}
						]
					},
					{
						id: 2,
						title: "Module 2: Mobility of electrons",
						subsection: [
							{
								id: 1,
								name:
									"Electron stability by Professor Wiley & PJ Morton.pdf",
								type: "file"
							},
							{
								id: 2,
								name: "Mobility of electrons 2.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper 2", type: "assignment" }
						]
					}
				],
				participants: [
					{
						id: 1,
						name: "Uzoatuegwu Petrina Chidera",
						matric_number: "15CJ02889",
						reg_number: 1500448,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/27.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 15 }
					},
					{
						id: 2,
						name: "Shobande Josephine",
						matric_number: "15CJ02873",
						reg_number: 1503445,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/65.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 9 }
					},
					{
						id: 3,
						name: "Owolabi Ifeoluwa Anuoluwa",
						matric_number: "15CJ02880",
						reg_number: 1400445,
						department: "CST",
						residence: "Deborah Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/88.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 10 }
					},
					{
						id: 4,
						name: "Udochi Dikamsiyochi Young",
						matric_number: "15CJ02885",
						reg_number: 1501445,
						department: "CBSS",
						residence: "Daniel Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/25.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 400,
						attendance: { scored_attendance: 8 }
					},
					{
						id: 5,
						name: "Williams Adedayo Adewale, a.",
						matric_number: "15CJ02890",
						reg_number: 1500425,
						department: "CDLS",
						residence: "Peter Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/82.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 300,
						attendance: { scored_attendance: 18 }
					}
				]
			},
			{
				id: 2,
				title: "Real Analysis II",
				course_code: "MAT412",
				credit_unit: 2,
				status: "registered",
				semester: { id: 1, name: "Alpha Semester" },
				prerequisites: [{ id: 1, course_id: 3 }],
				facilitators: [
					{ id: 1, staff_id: 1 },
					{ id: 2, staff_id: 3 }
				],
				categories: [
					{
						id: 1,
						title: "Departmental Courses",
						subCategories: [{ id: 1, title: "EIE Courses" }]
					},
					{
						id: 1,
						title: "College Wide Courses Course",
						subCategories: [{ id: 2, title: "COE Courses" }]
					}
				],

				sections: [
					{
						id: 1,
						title: "Module 1",
						subsection: [
							{ id: 1, name: "i8086.pdf", type: "file" },
							{
								id: 2,
								name: "Mobility of electrons.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper", type: "assignment" }
						]
					},
					{
						id: 2,
						title: "Module 2: Mobility of electrons",
						subsection: [
							{
								id: 1,
								name:
									"Electron stability by Professor Wiley & PJ Morton.pdf",
								type: "file"
							},
							{
								id: 2,
								name: "Mobility of electrons 2.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper 2", type: "assignment" }
						]
					}
				],
				participants: [
					{
						id: 1,
						name: "Uzoatuegwu Petrina Chidera",
						matric_number: "15CJ02889",
						reg_number: 1500448,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/27.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 15 }
					},
					{
						id: 2,
						name: "Shobande Josephine",
						matric_number: "15CJ02873",
						reg_number: 1503445,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/65.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 9 }
					},
					{
						id: 3,
						name: "Owolabi Ifeoluwa Anuoluwa",
						matric_number: "15CJ02880",
						reg_number: 1400445,
						department: "CST",
						residence: "Deborah Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/88.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 10 }
					},
					{
						id: 4,
						name: "Udochi Dikamsiyochi Young",
						matric_number: "15CJ02885",
						reg_number: 1501445,
						department: "CBSS",
						residence: "Daniel Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/25.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 400,
						attendance: { scored_attendance: 8 }
					},
					{
						id: 5,
						name: "Williams Adedayo Adewale, a.",
						matric_number: "15CJ02890",
						reg_number: 1500425,
						department: "CDLS",
						residence: "Peter Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/82.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 300,
						attendance: { scored_attendance: 18 }
					}
				]
			},
			{
				id: 3,
				title: "Logisitics & Statistics",
				course_code: "MAT411",
				credit_unit: 2,
				status: "registered",
				semester: { id: 1, name: "Alpha Semester" },
				prerequisites: [{ id: 1, course_id: 4 }],
				facilitators: [
					{ id: 1, staff_id: 3 },
					{ id: 2, staff_id: 4 }
				],
				categories: [
					{
						id: 1,
						title: "Departmental Courses",
						subCategories: [{ id: 2, title: "Mech Courses" }]
					},
					{
						id: 1,
						title: "College Wide Courses Course",
						subCategories: [{ id: 2, title: "COE Courses" }]
					}
				],
				sections: [
					{
						id: 1,
						title: "Module 1",
						subsection: [
							{ id: 1, name: "i8086.pdf", type: "file" },
							{
								id: 2,
								name: "Mobility of electrons.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper", type: "assignment" }
						]
					},
					{
						id: 2,
						title: "Module 2: Mobility of electrons",
						subsection: [
							{
								id: 1,
								name:
									"Electron stability by Professor Wiley & PJ Morton.pdf",
								type: "file"
							},
							{
								id: 2,
								name: "Mobility of electrons 2.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper 2", type: "assignment" }
						]
					}
				],
				participants: [
					{
						id: 1,
						name: "Uzoatuegwu Petrina Chidera",
						matric_number: "15CJ02889",
						reg_number: 1500448,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/27.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 15 }
					},
					{
						id: 2,
						name: "Shobande Josephine",
						matric_number: "15CJ02873",
						reg_number: 1503445,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/65.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 9 }
					},
					{
						id: 3,
						name: "Owolabi Ifeoluwa Anuoluwa",
						matric_number: "15CJ02880",
						reg_number: 1400445,
						department: "CST",
						residence: "Deborah Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/88.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 10 }
					},
					{
						id: 4,
						name: "Udochi Dikamsiyochi Young",
						matric_number: "15CJ02885",
						reg_number: 1501445,
						department: "CBSS",
						residence: "Daniel Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/25.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 400,
						attendance: { scored_attendance: 8 }
					},
					{
						id: 5,
						name: "Williams Adedayo Adewale, a.",
						matric_number: "15CJ02890",
						reg_number: 1500425,
						department: "CDLS",
						residence: "Peter Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/82.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 300,
						attendance: { scored_attendance: 18 }
					}
				]
			},
			{
				id: 4,
				title: "Numerical Analysis",
				course_code: "MAT411",
				credit_unit: 2,
				status: "Pending",
				semester: { id: 1, name: "Alpha Semester" },
				prerequisites: [{ id: 1, course_id: 2 }],
				facilitators: [
					{ id: 1, staff_id: 4 },
					{ id: 2, staff_id: 2 }
				],
				categories: [
					{
						id: 1,
						title: "Departmental Courses",
						subCategories: [{ id: 1, title: "EIE Courses" }]
					},
					{
						id: 1,
						title: "College Wide Courses Course",
						subCategories: [{ id: 2, title: "COE Courses" }]
					}
				],

				sections: [
					{
						id: 1,
						title: "Module 1",
						subsection: [
							{ id: 1, name: "i8086.pdf", type: "file" },
							{
								id: 2,
								name: "Mobility of electrons.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper", type: "assignment" }
						]
					},
					{
						id: 2,
						title: "Module 2: Mobility of electrons",
						subsection: [
							{
								id: 1,
								name:
									"Electron stability by Professor Wiley & PJ Morton.pdf",
								type: "file"
							},
							{
								id: 2,
								name: "Mobility of electrons 2.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper 2", type: "assignment" }
						]
					}
				],
				participants: [
					{
						id: 1,
						name: "Uzoatuegwu Petrina Chidera",
						matric_number: "15CJ02889",
						reg_number: 1500448,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/27.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 15 }
					},
					{
						id: 2,
						name: "Shobande Josephine",
						matric_number: "15CJ02873",
						reg_number: 1503445,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/65.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 9 }
					},
					{
						id: 3,
						name: "Owolabi Ifeoluwa Anuoluwa",
						matric_number: "15CJ02880",
						reg_number: 1400445,
						department: "CST",
						residence: "Deborah Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/88.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 10 }
					},
					{
						id: 4,
						name: "Udochi Dikamsiyochi Young",
						matric_number: "15CJ02885",
						reg_number: 1501445,
						department: "CBSS",
						residence: "Daniel Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/25.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 400,
						attendance: { scored_attendance: 8 }
					},
					{
						id: 5,
						name: "Williams Adedayo Adewale, a.",
						matric_number: "15CJ02890",
						reg_number: 1500425,
						department: "CDLS",
						residence: "Peter Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/82.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 300,
						attendance: { scored_attendance: 18 }
					}
				]
			},
			{
				id: 5,
				title:
					"Introduction to Embedded Systems and VHDL design patterns",
				course_code: "MAT411",
				credit_unit: 2,
				status: "Pending",
				semester: { id: 1, name: "Alpha Semester" },
				prerequisites: [{ id: 1, course_id: 1 }],
				facilitators: [
					{ id: 1, staff_id: 3 },
					{ id: 2, staff_id: 1 }
				],
				categories: [
					{
						id: 1,
						title: "Departmental Courses",
						subCategories: [{ id: 2, title: "Mech Courses" }]
					},
					{
						id: 1,
						title: "College Wide Courses Course",
						subCategories: [{ id: 1, title: "CST Courses" }]
					}
				],
				sections: [
					{
						id: 1,
						title: "Module 1",
						subsection: [
							{ id: 1, name: "i8086.pdf", type: "file" },
							{
								id: 2,
								name: "Mobility of electrons.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper", type: "assignment" }
						]
					},
					{
						id: 2,
						title: "Module 2: Mobility of electrons",
						subsection: [
							{
								id: 1,
								name:
									"Electron stability by Professor Wiley & PJ Morton.pdf",
								type: "file"
							},
							{
								id: 2,
								name: "Mobility of electrons 2.docx",
								type: "file"
							},
							{ id: 3, name: "Term Paper 2", type: "assignment" }
						]
					}
				],
				participants: [
					{
						id: 1,
						name: "Uzoatuegwu Petrina Chidera",
						matric_number: "15CJ02889",
						reg_number: 1500448,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/27.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 15 }
					},
					{
						id: 2,
						name: "Shobande Josephine",
						matric_number: "15CJ02873",
						reg_number: 1503445,
						department: "EIE",
						residence: "Dorcas Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/65.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 9 }
					},
					{
						id: 3,
						name: "Owolabi Ifeoluwa Anuoluwa",
						matric_number: "15CJ02880",
						reg_number: 1400445,
						department: "CST",
						residence: "Deborah Hall",
						sex: "female",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/women/88.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 500,
						attendance: { scored_attendance: 10 }
					},
					{
						id: 4,
						name: "Udochi Dikamsiyochi Young",
						matric_number: "15CJ02885",
						reg_number: 1501445,
						department: "CBSS",
						residence: "Daniel Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/25.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 400,
						attendance: { scored_attendance: 8 }
					},
					{
						id: 5,
						name: "Williams Adedayo Adewale, a.",
						matric_number: "15CJ02890",
						reg_number: 1500425,
						department: "CDLS",
						residence: "Peter Hall",
						sex: "male",
						dob: "03/12/1998",
						marital_status: "single",
						profile_picture:
							"https://randomuser.me/api/portraits/men/82.jpg",
						student_type: "Undergraduate",
						program: "Computer Engineering",
						program_id: 1,
						room_number: "D402",
						level: 300,
						attendance: { scored_attendance: 18 }
					}
				]
			}
		],
		course_statuses: [],
		student_courses: [
			{
				id: 1,
				title: "Real Analysis",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.75
			},
			{
				id: 2,
				title: "Real Analysis II",
				course_code: "MAT412",
				status: "registered",
				attendance: 1
			},
			{
				id: 3,
				title: "Logisitics & Statistics",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.5
			},
			{
				id: 4,
				title: "Numerical Analysis",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.2
			},
			{
				id: 5,
				title:
					"Introduction to Embedded Systems and VHDL design patterns",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.9
			},
			{
				id: 6,
				title: "Real Analysis",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.75
			},
			{
				id: 7,
				title: "Real Analysis II",
				course_code: "MAT412",
				status: "registered",
				attendance: 1
			},
			{
				id: 8,
				title: "Logisitics & Statistics",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.5
			},
			{
				id: 9,
				title: "Numerical Analysis",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.2
			},
			{
				id: 10,
				title:
					"Introduction to Embedded Systems and VHDL design patterns Introduction to Embedded Systems and VHDL design patterns",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.9
			}
		],
		studentHeaders: [
			{
				text: "Name",
				align: "left",
				sortable: false,
				value: "name"
			},
			{ text: "Matriculation Number", value: "matric_number" },
			{ text: "Registration Number", value: "reg_number" },
			{ text: "Department", value: "department" },
			{ text: "Grade/Level", value: "level" },
			{ text: "Residence", value: "residence" },
			{ text: "Actions", value: "actions", sortable: false }
		],
		students: [
			{
				id: 1,
				name: "Uzoatuegwu Petrina Chidera",
				matric_number: "15CJ02889",
				reg_number: 1500448,
				department: "EIE",
				residence: "Dorcas Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "female",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/women/27.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				level: 500,
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 4,
						name: "Thursday Service",
						frequency: "Every Thursday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "8:00AM"
					}
				]
			},
			{
				id: 2,
				name: "Shobande Josephine",
				matric_number: "15CJ02873",
				reg_number: 1503445,
				department: "EIE",
				residence: "Dorcas Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "female",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/women/65.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				level: 500,
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 4,
						name: "Thursday Service",
						frequency: "Every Thursday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "8:00AM"
					}
				]
			},
			{
				id: 3,
				name: "Owolabi Ifeoluwa Anuoluwa",
				matric_number: "15CJ02880",
				reg_number: 1400445,
				department: "CST",
				residence: "Deborah Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "female",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/women/88.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				level: 500,
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 4,
						name: "Thursday Service",
						frequency: "Every Thursday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "8:00AM"
					}
				]
			},
			{
				id: 4,
				name: "Udochi Dikamsiyochi Young",
				matric_number: "15CJ02885",
				reg_number: 1501445,
				department: "CBSS",
				residence: "Daniel Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "male",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/men/25.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				level: 400,
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 4,
						name: "Thursday Service",
						frequency: "Every Thursday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "8:00AM"
					},
					{
						id: 5,
						name: "Inaugural Lecture",
						frequency: "22nd February, 2020",
						status: "Inactive",
						priority: "Voluntary",
						total_attendance: 18,
						venue: "CUCRID Auditorium",
						time: "12:00PM"
					}
				]
			},
			{
				id: 5,
				name: "Williams Adedayo Adewale, a.",
				matric_number: "15CJ02890",
				reg_number: 1500425,
				department: "CDLS",
				residence: "Peter Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "male",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/men/82.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				level: 300,
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 3,
						name: "Tuesday Service",
						frequency: "Every Tuesday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "08:00AM"
					}
				]
			},
			{
				id: 6,
				name: "Paul Chukwuebuka Chimezie",
				matric_number: "15CJ02875",
				reg_number: 1500145,
				department: "CEDS",
				level: 500,
				residence: "Joseph Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "male",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/men/15.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 3,
						name: "Tuesday Service",
						frequency: "Every Tuesday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "08:00AM"
					}
				]
			},
			{
				id: 7,
				name: "Okoye Emeka Elvis",
				matric_number: "15CJ02857",
				reg_number: 1500245,
				department: "COE",
				level: 200,
				residence: "John Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "male",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/men/90.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 5,
						name: "Inaugural Lecture",
						frequency: "22nd February, 2020",
						status: "Inactive",
						priority: "Voluntary",
						total_attendance: 18,
						venue: "CUCRID Auditorium",
						time: "12:00PM"
					},
					{
						id: 3,
						name: "Tuesday Service",
						frequency: "Every Tuesday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "08:00AM"
					}
				]
			},
			{
				id: 8,
				name: "Olomo Rachael Ayobami",
				matric_number: "14CJ016805",
				reg_number: 1500545,
				department: "CBSS",
				level: 500,
				residence: "Dorcas Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "female",
				dob: "11/08/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/women/45.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 3,
						name: "Tuesday Service",
						frequency: "Every Tuesday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "08:00AM"
					}
				]
			},
			{
				id: 9,
				name: "Olashore Oluwatoyosi ",
				matric_number: "15CJ02861",
				reg_number: 1500345,
				department: "COE",
				level: 400,
				residence: "Dorcas Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "female",
				dob: "08/13/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/women/85.jpg",
				student_type: "Undergraduate",
				program: "Computer Engineering",
				program_id: 1,
				room_number: "D402",
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 3,
						name: "Tuesday Service",
						frequency: "Every Tuesday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "08:00AM"
					},
					{
						id: 5,
						name: "Inaugural Lecture",
						frequency: "22nd February, 2020",
						status: "Inactive",
						priority: "Voluntary",
						total_attendance: 18,
						venue: "CUCRID Auditorium",
						time: "12:00PM"
					}
				]
			},
			{
				id: 10,
				name: "Oguntolu Shalom Folayan",
				matric_number: "15CJ02852",
				reg_number: 1500445,
				department: "CEDS",
				level: 300,
				residence: "Paul Hall",
				phone_number: "+2348097684322",
				state_of_origin: "Kogi State",
				home_address: "No 7, Marshall Heights, Shonibare Estate, Ikeja",
				city: "Lagos",
				nationality: "Nigerian",
				guardians: [
					{
						id: 1,
						name: "Justice Engworo",
						phone_number1: "+2348035050175",
						relationship: "Father"
					},
					{
						id: 2,
						name: "Maya Angelou",
						phone_number: "+2347089324817",
						relationship: "Mother"
					}
				],
				sex: "male",
				dob: "03/12/1998",
				marital_status: "single",
				profile_picture:
					"https://randomuser.me/api/portraits/men/85.jpg",
				student_type: "Undergraduate",
				program_id: 1,
				program: "Computer Engineering",
				room_number: "D402",
				events: [
					{
						id: 1,
						name: "Friday CHOP",
						frequency: "Every Friday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "5:30AM"
					},
					{
						id: 2,
						name: "Sunday Service",
						frequency: "Every Sunday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "6:00AM"
					},
					{
						id: 3,
						name: "Tuesday Service",
						frequency: "Every Tuesday",
						status: "Active",
						priority: "Compulsory",
						total_attendance: 18,
						venue: "Covenant University Chapel",
						time: "08:00AM"
					}
				]
			}
		],
		studentEvents: [
			{
				id: 1,
				student: {
					//student_id
					id: 1,
					name: "Uzoatuegwu Petrina Chidera",
					matric_number: "15CJ02889",
					reg_number: 1500448,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					//event_id
					id: 1,
					name: "Friday CHOP",
					frequency: "Every Friday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,
					venue: "Covenant University Chapel",
					time: "5:30AM"
				},
				date: new Date("03/07/2020")
			},
			{
				id: 2,
				student: {
					id: 1,
					name: "Uzoatuegwu Petrina Chidera",
					matric_number: "15CJ02889",
					reg_number: 1500448,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					id: 1,
					name: "Friday CHOP",
					frequency: "Every Friday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,
					venue: "Covenant University Chapel",
					time: "5:30AM"
				},
				date: new Date("02/22/2020")
			},
			{
				id: 3,
				student: {
					//student_id
					id: 1,
					name: "Uzoatuegwu Petrina Chidera",
					matric_number: "15CJ02889",
					reg_number: 1500448,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					id: 4,
					name: "Thursday Service",
					frequency: "Every Thursday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,
					venue: "Covenant University Chapel",
					time: "8:00AM"
				},
				date: new Date("03/12/2020")
			},
			{
				id: 4,
				student: {
					//student_id
					id: 1,
					name: "Uzoatuegwu Petrina Chidera",
					matric_number: "15CJ02889",
					reg_number: 1500448,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					id: 2,
					name: "Sunday Service",
					frequency: "Every Sunday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,
					venue: "Covenant University Chapel",
					time: "6:00AM"
				},
				date: new Date("03/14/2020")
			},
			{
				id: 5,
				student: {
					id: 2,
					name: "Shobande Josephine",
					matric_number: "15CJ02873",
					reg_number: 1503445,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					//event_id
					id: 1,
					name: "Friday CHOP",
					frequency: "Every Friday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,

					venue: "Covenant University Chapel",
					time: "5:30AM"
				},
				date: new Date("03/06/2020")
			},
			{
				id: 6,
				student: {
					id: 2,
					name: "Shobande Josephine",
					matric_number: "15CJ02873",
					reg_number: 1503445,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					id: 4,
					name: "Thursday Service",
					frequency: "Every Thursday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,

					venue: "Covenant University Chapel",
					time: "8:00AM"
				},
				date: new Date("03/12/2020")
			},
			{
				id: 7,
				student: {
					id: 2,
					name: "Shobande Josephine",
					matric_number: "15CJ02873",
					reg_number: 1503445,
					department: "EIE",
					residence: "Dorcas Hall",
					level: 500
				},
				event: {
					id: 2,
					name: "Sunday Service",
					frequency: "Every Sunday",
					status: "Active",
					priority: "Compulsory",
					total_attendance: 18,
					venue: "Covenant University Chapel",
					time: "6:00AM"
				},
				date: new Date("03/14/2020")
			}
			// { id: 8, student: {}, event: {}, date: [] },
			// { id: 9, student: {}, event: {}, date: null },
			// { id: 10, student: {}, event: {}, date: null },
			// { id: 11, student: {}, event: {}, date: null },
			// { id: 12, student: {}, event: {}, date: null },
			// { id: 13, student: {}, event: {}, date: null },
			// { id: 14, student: {}, event: {}, date: null },
			// { id: 15, student: {}, event: {}, date: null }
		],
		staff: [
			{
				id: 1,
				name: "Uzoatuegwu Petrina Chidera",
				staff_number: "11CU02889",
				rank: "Senior Lecturer",
				title: "Mrs.",
				sex: "Female",
				// department: "EIE",
				residence: "Dorcas Hall",
				phone_number: "080947373728",
				department: {
					id: 1,
					name:
						"Department of Electrical And Information Engineering",
					short_name: "EIE",
					college_id: 1,
					college: {
						id: 1,
						name: "College of Engineering",
						short_name: "COE"
					}
				}
			},
			{
				id: 2,
				name: "Shobande Josephine",
				staff_number: "12CU02873",
				rank: "Lecturer II",
				title: "Miss.",
				sex: "Female",
				// department: "EIE",
				residence: "Dorcas Hall",
				phone_number: "080947373728",
				department: {
					id: 1,
					name:
						"Department of Electrical And Information Engineering",
					short_name: "EIE",
					college_id: 1,
					college: {
						id: 1,
						name: "College of Engineering",
						short_name: "COE"
					}
				}
			},
			{
				id: 3,
				name: "Owolabi Ifeoluwa Anuoluwa",
				staff_number: "15CU02880",
				rank: "Professor",
				title: "Professor",
				sex: "Female",
				// department: "CST",
				residence: "Deborah Hall",
				phone_number: "080947373728",
				department: {
					id: 1,
					name:
						"Department of Electrical And Information Engineering",
					short_name: "EIE",
					college_id: 1,
					college: {
						id: 1,
						name: "College of Engineering",
						short_name: "COE"
					}
				}
			},
			{
				id: 4,
				name: "Udochi Dikamsiyochi Young",
				staff_number: "15CU02885",
				rank: "Associate Professor",
				title: "Professor",
				sex: "Male",
				department: {
					id: 1,
					name:
						"Department of Electrical And Information Engineering",
					short_name: "EIE",
					college_id: 1,
					college: {
						id: 1,
						name: "College of Engineering",
						short_name: "COE"
					}
				},
				// department: "CBSS",
				residence: "Daniel Hall",
				phone_number: "080947373728"
			}
		],
		events: [
			{
				id: 1,
				name: "Friday CHOP",
				frequency: "Every Friday",
				status: "Active",
				priority: "Compulsory",
				total_attendance: 18,
				description:
					"A time of corporate daily prayer lasting one (1) hour when each student, as they have opportunity to attend, is left alone to pray for the University, their families, academics etc.",
				venue: "Covenant University Chapel",
				time: "5:30AM",
				students: [
					{
						id: 1,
						name: "Uzoatuegwu Petrina Chidera",
						matric_number: "15CJ02889",
						reg_number: 1500448,
						department: "EIE",
						residence: "Dorcas Hall",
						level: 500,
						weighted_attendance: 14
					},
					{
						id: 2,
						name: "Shobande Josephine",
						matric_number: "15CJ02873",
						reg_number: 1503445,
						department: "EIE",
						residence: "Dorcas Hall",
						level: 500,
						weighted_attendance: 14
					},
					{
						id: 3,
						name: "Owolabi Ifeoluwa Anuoluwa",
						matric_number: "15CJ02880",
						reg_number: 1400445,
						department: "CST",
						residence: "Deborah Hall",
						level: 500,
						weighted_attendance: 14
					}
				]
				// protein: 4.+
			},
			{
				id: 2,
				name: "Sunday Service",
				frequency: "Every Sunday",
				status: "Active",
				priority: "Compulsory",
				total_attendance: 18,
				description:
					"There were two services for all the students which they attend on Hall basis. Five Halls attend the first service (7:00–9:30am) while the remaining five Halls attend the second service (10:00am– 12:30pm). Attendance is mandatory.",
				venue: "Covenant University Chapel",
				time: "6:00AM",
				students: [
					{
						id: 4,
						name: "Udochi Dikamsiyochi Young",
						matric_number: "15CJ02885",
						reg_number: 1501445,
						department: "CBSS",
						residence: "Daniel Hall",
						weighted_attendance: 12,
						level: 400
					},
					{
						id: 5,
						name: "Williams Adedayo Adewale, a.",
						matric_number: "15CJ02890",
						reg_number: 1500425,
						department: "CDLS",
						residence: "Peter Hall",
						weighted_attendance: 12,
						level: 300
					},
					{
						id: 6,
						name: "Paul Chukwuebuka Chimezie",
						matric_number: "15CJ02875",
						reg_number: 1500145,
						department: "CEDS",
						level: 500,
						residence: "Joseph Hall",
						weighted_attendance: 12
					}
				]
				// protein: 4.+
			},
			{
				id: 3,
				name: "Tuesday Service",
				frequency: "Every Tuesday",
				status: "Active",
				priority: "Compulsory",
				total_attendance: 18,
				description:
					"The Mid-week Chapel program is to ensure that staff and students alike stay on fire during the week. The Tuesday Chapel service at 8:00am is for staff and 300 – 500 level students while the Thursday Chapel service at 8:00am is for staff and 100 & 200 level students.",
				venue: "Covenant University Chapel",
				time: "08:00AM",
				students: [
					{
						id: 7,
						name: "Okoye Emeka Elvis",
						matric_number: "15CJ02857",
						reg_number: 1500245,
						department: "COE",
						level: 200,
						residence: "John Hall",
						weighted_attendance: 12
					},
					{
						id: 8,
						name: "Olomo Rachael Ayobami",
						matric_number: "14CJ016805",
						reg_number: 1500545,
						department: "CBSS",
						level: 500,
						residence: "Dorcas Hall",
						weighted_attendance: 12
					},
					{
						id: 9,
						name: "Olashore Oluwatoyosi ",
						matric_number: "15CJ02861",
						reg_number: 1500345,
						department: "COE",
						level: 400,
						residence: "Dorcas Hall",
						weighted_attendance: 12
					}
				]
				// protein: 4.+
			},
			{
				id: 4,
				name: "Thursday Service",
				frequency: "Every Thursday",
				status: "Active",
				priority: "Compulsory",
				total_attendance: 18,
				description:
					"The Mid-week Chapel program is to ensure that staff and students alike stay on fire during the week. The Tuesday Chapel service at 8:00am is for staff and 300 – 500 level students while the Thursday Chapel service at 8:00am is for staff and 100 & 200 level students.",
				venue: "Covenant University Chapel",
				time: "8:00AM",
				students: [
					{
						id: 7,
						name: "Okoye Emeka Elvis",
						matric_number: "15CJ02857",
						reg_number: 1500245,
						department: "COE",
						level: 200,
						residence: "John Hall",
						weighted_attendance: 14
					},
					{
						id: 8,
						name: "Olomo Rachael Ayobami",
						matric_number: "14CJ016805",
						reg_number: 1500545,
						department: "CBSS",
						level: 500,
						residence: "Dorcas Hall",
						weighted_attendance: 14
					},
					{
						id: 9,
						name: "Olashore Oluwatoyosi ",
						matric_number: "15CJ02861",
						reg_number: 1500345,
						department: "COE",
						level: 400,
						residence: "Dorcas Hall",
						weighted_attendance: 14
					}
				]
				// protein: 4.+
			},
			{
				id: 5,
				name: "Inaugural Lecture",
				frequency: "22nd February, 2020",
				status: "Inactive",
				priority: "Voluntary",
				total_attendance: 18,
				description:
					"The 4th in the series of Covenant University’s Inaugural Lecture comes up on Friday, February 14, 2014 at the University Chapel. The lecture entitled: Microbial Life in The Presence of Carbon and Oxygen: Consequences for Man, will be delivered by an astute scholar and Professor of Medical Microbiology, Professor Louis Osayenum Egwari. Read more at: https://www.vanguardngr.com/2014/02/covenant-varsity-holds-4th-inaugural-lecture/",
				venue: "CUCRID Auditorium",
				time: "12:00PM",
				students: [
					{
						id: 10,
						name: "Oguntolu Shalom Folayan",
						matric_number: "15CJ02852",
						reg_number: 1500445,
						department: "CEDS",
						level: 300,
						residence: "Paul Hall"
					}
				]
				// protein: 4.+
			}
		],
		snackbar: {
			timeout: 3000,
			text: "Welcome to Upschool!",
			isActive: false
		},
		loggedInUser: {
			id: 1,
			type: "",
			matric_number: "15CJ02873",
			program_id: 1,
			messageList: [
				{
					id: 1,
					icon: true,
					title: "Prof. Jerry Amiah",
					avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
					isFavourite: false,
					messages: [
						{
							id: 1,
							sender_id: 1,
							text: "Hi! It's Prof, what are you up to?",
							time: "12:00AM"
						},
						{
							id: 2,
							sender_id: 2,
							text: "Just working on the final assignment, you?",
							time: "12:05AM"
						},
						{
							id: 3,
							sender_id: 2,
							text: "so far so good",
							time: "12:07AM"
						},
						{
							id: 4,
							sender_id: 1,
							text: "LMAO. I haven't even started it",
							time: "12:08AM"
						}
					]
				},
				{
					id: 2,
					title: "Chika Dim Cyril",
					avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
					isFavourite: false,
					messages: [
						{
							id: 1,
							sender_id: 1,
							text: "Hi! It's Chika, what are you up to?",
							time: "12:00AM"
						},
						{
							id: 2,
							sender_id: 3,
							text: "Just working on the final assignment, you?",
							time: "12:05AM"
						},
						{
							id: 3,
							sender_id: 3,
							text: "so far so good",
							time: "12:07AM"
						},
						{
							id: 4,
							sender_id: 1,
							text:
								"Hmmm. I ran into a bit of a hurdle myself, I think I just need to change my approach",
							time: "12:08AM"
						}
					]
				},
				{
					id: 3,
					title: "Peters Gideon",
					avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
					isFavourite: false,
					messages: [
						{
							id: 1,
							sender_id: 1,
							text: "Gideon here! what are you up to?",
							time: "12:00AM"
						},
						{
							id: 2,
							sender_id: 4,
							text: "Just working on the final assignment, you?",
							time: "12:05AM"
						},
						{
							id: 3,
							sender_id: 4,
							text: "so far so good",
							time: "12:07AM"
						},
						{
							id: 4,
							sender_id: 1,
							text: "I still have a long way to go :(",
							time: "12:08AM"
						}
					]
				},
				{
					id: 4,
					title: "Ebube Donald",
					avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
					isFavourite: false,
					messages: [
						{
							id: 1,
							sender_id: 1,
							text: "Hi! what are you up to?",
							time: "12:00AM"
						},
						{
							id: 2,
							sender_id: 5,
							text: "Just working on the final assignment, you?",
							time: "12:05AM"
						},
						{
							id: 3,
							sender_id: 5,
							text: "so far so good",
							time: "12:07AM"
						},
						{
							id: 4,
							sender_id: 1,
							text:
								"LMAO. Can't believe it's due next week, where do I begin?",
							time: "12:08AM"
						}
					]
				}
			],
			// schedule: [{ id: 1, name: "EIE517 class", semester_id: 1 }],
			courseList: [
				{
					id: 1,
					semester_id: 1,
					courses: [
						{
							id: 1,
							title: "Real Analysis",
							course_code: "GEC411",
							credit_unit: 2,
							status: "registered",
							semester: { id: 1, name: "Alpha Semester" },
							prerequisites: [
								{ id: 1, course_id: 5 },
								{ id: 2, course_id: 2 }
							],
							categories: [
								{
									id: 1,
									title: "Departmental Courses",
									subCategories: [
										{ id: 1, title: "EIE Courses" }
									]
								},
								{
									id: 1,
									title: "College Wide Courses Course",
									subCategories: [
										{ id: 2, title: "COE Courses" }
									]
								}
							]
						},
						{
							id: 2,
							title: "Real Analysis II",
							course_code: "MAT412",
							credit_unit: 2,
							status: "registered",
							semester: { id: 1, name: "Alpha Semester" },
							prerequisites: [{ id: 1, course_id: 3 }],
							categories: [
								{
									id: 1,
									title: "Departmental Courses",
									subCategories: [
										{ id: 1, title: "EIE Courses" }
									]
								},
								{
									id: 1,
									title: "College Wide Courses Course",
									subCategories: [
										{ id: 2, title: "COE Courses" }
									]
								}
							]
						},
						{
							id: 3,
							title: "Logisitics & Statistics",
							course_code: "MAT411",
							credit_unit: 2,
							status: "registered",
							semester: { id: 1, name: "Alpha Semester" },
							prerequisites: [{ id: 1, course_id: 4 }],
							categories: [
								{
									id: 1,
									title: "Departmental Courses",
									subCategories: [
										{ id: 2, title: "Mech Courses" }
									]
								},
								{
									id: 1,
									title: "College Wide Courses Course",
									subCategories: [
										{ id: 2, title: "COE Courses" }
									]
								}
							]
						},
						{
							id: 4,
							title: "Numerical Analysis",
							course_code: "MAT411",
							credit_unit: 2,
							status: "Pending",
							semester: { id: 1, name: "Alpha Semester" },
							prerequisites: [{ id: 1, course_id: 2 }],
							categories: [
								{
									id: 1,
									title: "Departmental Courses",
									subCategories: [
										{ id: 1, title: "EIE Courses" }
									]
								},
								{
									id: 1,
									title: "College Wide Courses Course",
									subCategories: [
										{ id: 2, title: "COE Courses" }
									]
								}
							]
						},
						{
							id: 5,
							title:
								"Introduction to Embedded Systems and VHDL design patterns",
							course_code: "MAT411",
							credit_unit: 2,
							status: "Pending",
							semester: { id: 1, name: "Alpha Semester" },
							prerequisites: [{ id: 1, course_id: 1 }],
							categories: [
								{
									id: 1,
									title: "Departmental Courses",
									subCategories: [
										{ id: 2, title: "Mech Courses" }
									]
								},
								{
									id: 1,
									title: "College Wide Courses Course",
									subCategories: [
										{ id: 1, title: "CST Courses" }
									]
								}
							]
						}
					]
				}
			],
			schedule: [
				{
					id: 1,
					name: "Return to Japan",
					description: "Get keys to Japan",
					time: "1:00PM - 3:00PM",
					course_id: "",
					venue: "Daniel Hall",
					semester_id: 1
				},
				{
					id: 2,
					name: "...",
					description: "Pst psst",
					time: "4:00PM - 5:00PM",
					course_id: 1,
					venue: "Daniel Hall",
					semester_id: 1
				}
			]
		},
		loggedInStaff: {
			id: 1,
			first_name: "Buba",
			middle_name: "Machido",
			last_name: "Solomon",
			staff_number: "12CU04568",
			year_of_entry: 2012,
			department_id: 1,
			rank: "Senior Lecturer",
			phone_number: "07035050175",
			home_number: "09069439661",
			address: "no 9 css street kaduna",
			nationality: "Nigerian",
			state_of_origin: "Kogi State",
			created_at: "2020-03-28T00:51:56.000000Z",
			updated_at: "2020-03-28T00:51:56.000000Z",
			user: {
				id: 1,
				name: "Buba M. Solomon",
				email: "buba@test.com",
				created_at: "2020-03-28T00:51:57.000000Z",
				updated_at: "2020-03-28T00:51:57.000000Z"
			},
			department: {
				id: 1,
				name: "Department of Electrical and Information Engineering",
				short_name: "EIE",
				college_id: 2,
				school_id: null,
				created_at: "2020-03-26T22:48:12.000000Z",
				updated_at: "2020-03-26T22:48:12.000000Z",
				college: {
					id: 2,
					name: "College of Engineering",
					short_name: "COE",
					created_at: "2020-03-26T22:33:42.000000Z",
					updated_at: "2020-03-26T22:33:42.000000Z"
				}
			}
		},
		curriculum_types: [
			{ id: 1, name: "Core/Compulsory Courses", short_form: "C" },
			{ id: 2, name: "Electives", short_form: "E" },
			{ id: 3, name: "University Courses", short_form: "U" },
			{ id: 4, name: "SWEP Courses", short_form: "SW" },
			{ id: 5, name: "SIWES Courses", short_form: "SI" },
			{ id: 6, name: "NUC Courses", short_form: "N" }
		],
		colleges: [
			{ id: 1, name: "College of Engineering", short_name: "COE" },
			{
				id: 2,
				name: "College of Science & Technology",
				short_name: "CST"
			}
		],
		departments: [
			{
				id: 1,
				name: "Department of Electrical And Information Engineering",
				short_name: "EIE",
				college_id: 1,
				college: {
					id: 1,
					name: "College of Engineering",
					short_name: "COE"
				}
			},
			{
				id: 2,
				name: "Department of Chemical Engineering",
				short_name: "CHE",
				college_id: 1,
				college: {
					id: 1,
					name: "College of Engineering",
					short_name: "COE"
				}
			}
		],
		programs: [
			{
				id: 1,
				degree: "B.Eng",
				name: "Computer Engineering",
				department_id: 1,
				department: {
					id: 1,
					name:
						"Department of Electrical And Information Engineering",
					short_name: "EIE",
					college_id: 1,
					college: {
						id: 1,
						name: "College of Engineering",
						short_name: "COE"
					}
				},
				no_of_years: 5,
				graduation_requirements: [
					{
						id: 1,
						level: 100,
						core: 31,
						electives: null,
						swep: null,
						siwes: null,
						college_courses: null,
						university_courses: 4,
						nuc: 10
					},
					{
						id: 2,
						level: 200,
						core: 38,
						electives: null,
						swep: 0,
						siwes: null,
						college_courses: null,
						university_courses: 4,
						nuc: 6
					},
					{
						id: 3,
						level: 300,
						core: 43,
						electives: null,
						swep: null,
						siwes: null,
						college_courses: null,
						university_courses: 4,
						nuc: 2
					},
					{
						id: 4,
						level: 400,
						core: 21,
						electives: null,
						swep: null,
						siwes: 6,
						college_courses: null,
						university_courses: 2,
						nuc: null
					},
					{
						id: 5,
						level: 500,
						core: 36,
						electives: 4,
						swep: null,
						siwes: null,
						college_courses: null,
						university_courses: 4,
						nuc: null
					}
				],
				curriculum: [
					{
						id: 1,
						level: 100,
						groupings: [
							{
								id: 1,
								type_id: 1,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 2,
								type_id: 3,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 3,
								type_id: 4,
								courses: []
							},
							{
								id: 4,
								type_id: 5,
								courses: []
							},
							{
								id: 5,
								type_id: 2,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 6,
								type_id: 6,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							}
						]
					},
					{
						id: 2,
						level: 200,
						groupings: [
							{
								id: 1,
								type_id: 1,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 2,
								type_id: 3,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 3,
								type_id: 4,
								courses: []
							},
							{
								id: 4,
								type_id: 5,
								courses: []
							},
							{
								id: 5,
								type_id: 2,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 6,
								type_id: 6,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							}
						]
					},
					{
						id: 3,
						level: 300,
						groupings: [
							{
								id: 1,
								type_id: 1,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 2,
								type_id: 3,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 3,
								type_id: 4,
								courses: []
							},
							{
								id: 4,
								type_id: 5,
								courses: []
							},
							{
								id: 5,
								type_id: 2,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 6,
								type_id: 6,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							}
						]
					},
					{
						id: 4,
						level: 400,
						groupings: [
							{
								id: 1,
								type_id: 1,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 2,
								type_id: 3,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 3,
								type_id: 4,
								courses: []
							},
							{
								id: 4,
								type_id: 5,
								courses: []
							},
							{
								id: 5,
								type_id: 2,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 6,
								type_id: 6,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							}
						]
					},
					{
						id: 5,
						level: 500,
						groupings: [
							{
								id: 1,
								type_id: 1,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 2,
								type_id: 3,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 3,
								type_id: 4,
								courses: []
							},
							{
								id: 4,
								type_id: 5,
								courses: []
							},
							{
								id: 5,
								type_id: 2,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							},
							{
								id: 6,
								type_id: 6,
								courses: [
									{
										id: 1,
										title: "Real Analysis",
										course_code: "GEC411",
										credit_unit: 2,
										status: "registered",
										semester: {
											id: 1,
											name: "Alpha Semester"
										},
										prerequisites: [
											{ id: 1, course_id: 5 },
											{ id: 2, course_id: 2 }
										],
										categories: [
											{
												id: 1,
												title: "Departmental Courses",
												subCategories: [
													{
														id: 1,
														title: "EIE Courses"
													}
												]
											},
											{
												id: 1,
												title:
													"College Wide Courses Course",
												subCategories: [
													{
														id: 2,
														title: "COE Courses"
													}
												]
											}
										]
									}
								]
							}
						]
					}
				]
			}
		],
		semesterTypes: [
			{ id: 1, title: "Alpha Semester", short_name: "Alpha" },
			{ id: 2, title: "Omega Semester", short_name: "Omega" }
		],
		semesters: [{ id: 1, type: "Alpha Semester", session_id: 1 }],
		sessions: [
			{
				id: 1,
				name: "2019/2020 Academic session",
				start_date: "",
				close_date: ""
			}
		],
		news: [
			{
				id: 1,
				title: "DOF Foundation Scholarships 2019/2020",
				body:
					"The David Oyedepo Foundation scholarship program is our major platform for promoting our vision and goals. The scholarship program awards scholarships to qualified individuals who are indigenes and residents of African countries, and have been offered admission to Covenant University or Landmark University, Nigeria.					The DOF scholars program grants individuals the opportunity to acquire a first degree at the prestigious Covenant University and Landmark University in Nigeria.  It grants individuals the opportunity to build up the leadership potentials that are so evidently lacking in the leaders of our society, through the yearly programs and community development initiatives integrated in the 5-year duration of the scholarship. The scholarship program covers the full academic fees for a 5-year duration of study and in some categories, travels and living expenses for the duration of the course of study.	Each awarded candidate becomes a David Oyedepo Foundation Scholar (DOF Scholar) and is expected to meet up with the requirements in order to remain a DOF Scholar.",
				time: "02/11/2020",
				featured: false,
				image:
					"https://www.opportunitiesforafricans.com/wp-content/uploads/2016/01/davido-oyedepo-foundation-scholarships.png"
			},

			{
				id: 2,
				title: "COVID'19: Preventive measures and procedures",
				body:
					"According to Nature, the spread of coronavirus disease 2019 (COVID-19) is becoming unstoppable and has already reached the necessary epidemiological criteria for it to be declared a pandemic, having infected more than 100 000 people in 100 countries.1 Therefore, a coordinated global response is desperately needed to prepare health systems to meet this unprecedented challenge. Countries that have been unfortunate enough to have been exposed to this disease already have, paradoxically, very valuable lessons to pass on. Although the containment measures implemented in China have—at least for the moment—reduced new cases by more than 90%, this reduction is not the case in other countries, including Italy and Iran.2 Italy has had 12 462 confirmed cases according to the Istituto Superiore di Sanità as of March 11, and 827 deaths. Only China has recorded more deaths due to this COVID-19 outbreak. The mean age of those who died in Italy was 81 years and more than two-thirds of these patients had diabetes, cardiovascular diseases, or cancer, or were former smokers. It is therefore true that these patients had underlying health conditions, but it is also worth noting that they had acute respiratory distress syndrome (ARDS) caused by severe acute respiratory syndrome coronavirus 2 (SARS-CoV-2) pneumonia, needed respiratory support, and would not have died otherwise. Of the patients who died, 42·2% were aged 80–89 years, 32·4% were aged 70–79 years, 8·4% were aged 60–69 years, and 2·8% were aged 50–59 years (those aged >90 years made up 14·1%). The male to female ratio is 80% to 20% with an older median age for women (83·4 years for women vs 79·9 years for men). On March 8, 2020, the Italian Government implemented extraordinary measures to limit viral transmission—including restricting movement in the region of Lombardy—that intended to minimise the likelihood that people who are not infected come into contact with people who are infected. This decision is certainly courageous and important, but it is not enough. At present, our national health system's capacity to effectively respond to the needs of those who are already infected and require admission to an intensive care unit for ARDS, largely due to SARS-CoV-2 pneumonia, is a matter of grave concern. Specifically, the percentage of patients admitted to intensive care units reported daily in Italy, from March 1, up until March 11, was consistently between 9% and 11% of patients who were actively infected. In Italy, we have approximately 5200 beds in intensive care units. Of those, as of March 11, 1028 are already devoted to patients with SARS-CoV-2 infection, and in the near future this number will progressively increase to the point that thousands of beds will soon be occupied by patients with COVID-19. Given that the mortality of patients who are critically ill with SARS-CoV-2 pneumonia is high and that the survival time of non-survivors is 1–2 weeks, the number of people infected in Italy will probably impose a major strain on critical care facilities in our hospitals, some of which do not have adequate resources or staff to deal with this emergency. In the Lombardy region, despite extraordinary efforts to restrict the movement of people at the expense of the Italian economy, we are dealing with an even greater fear—that the number of patients who present to the emergency room will become much greater than the system can cope with. The number of intensive care beds necessary to give the maximum number of patients the chance to be treated will reach several thousand, but the exact number is still a matter of discussion among experts. Health-care professionals have been working day and night since Feb 20, and in doing so around 20% (n=350) of them have become infected, and some have died. Lombardy is responding to the lack of beds for patients with COVID-19 by sending patients who need intensive care but are not infected with COVID-19 to hospitals outside of the region to contain the virus.",
				time: "02/11/2020",
				featured: false,
				image:
					"https://whatsupnewp.com/wp-content/uploads/2020/03/banner.png"
			},
			{
				id: 3,
				title: "COVID'19: Preventive measures and procedures",
				body:
					"According to Nature, the spread of coronavirus disease 2019 (COVID-19) is becoming unstoppable and has already reached the necessary epidemiological criteria for it to be declared a pandemic, having infected more than 100 000 people in 100 countries.1 Therefore, a coordinated global response is desperately needed to prepare health systems to meet this unprecedented challenge. Countries that have been unfortunate enough to have been exposed to this disease already have, paradoxically, very valuable lessons to pass on. Although the containment measures implemented in China have—at least for the moment—reduced new cases by more than 90%, this reduction is not the case in other countries, including Italy and Iran.2 Italy has had 12 462 confirmed cases according to the Istituto Superiore di Sanità as of March 11, and 827 deaths. Only China has recorded more deaths due to this COVID-19 outbreak. The mean age of those who died in Italy was 81 years and more than two-thirds of these patients had diabetes, cardiovascular diseases, or cancer, or were former smokers. It is therefore true that these patients had underlying health conditions, but it is also worth noting that they had acute respiratory distress syndrome (ARDS) caused by severe acute respiratory syndrome coronavirus 2 (SARS-CoV-2) pneumonia, needed respiratory support, and would not have died otherwise. Of the patients who died, 42·2% were aged 80–89 years, 32·4% were aged 70–79 years, 8·4% were aged 60–69 years, and 2·8% were aged 50–59 years (those aged >90 years made up 14·1%). The male to female ratio is 80% to 20% with an older median age for women (83·4 years for women vs 79·9 years for men). On March 8, 2020, the Italian Government implemented extraordinary measures to limit viral transmission—including restricting movement in the region of Lombardy—that intended to minimise the likelihood that people who are not infected come into contact with people who are infected. This decision is certainly courageous and important, but it is not enough. At present, our national health system's capacity to effectively respond to the needs of those who are already infected and require admission to an intensive care unit for ARDS, largely due to SARS-CoV-2 pneumonia, is a matter of grave concern. Specifically, the percentage of patients admitted to intensive care units reported daily in Italy, from March 1, up until March 11, was consistently between 9% and 11% of patients who were actively infected. In Italy, we have approximately 5200 beds in intensive care units. Of those, as of March 11, 1028 are already devoted to patients with SARS-CoV-2 infection, and in the near future this number will progressively increase to the point that thousands of beds will soon be occupied by patients with COVID-19. Given that the mortality of patients who are critically ill with SARS-CoV-2 pneumonia is high and that the survival time of non-survivors is 1–2 weeks, the number of people infected in Italy will probably impose a major strain on critical care facilities in our hospitals, some of which do not have adequate resources or staff to deal with this emergency. In the Lombardy region, despite extraordinary efforts to restrict the movement of people at the expense of the Italian economy, we are dealing with an even greater fear—that the number of patients who present to the emergency room will become much greater than the system can cope with. The number of intensive care beds necessary to give the maximum number of patients the chance to be treated will reach several thousand, but the exact number is still a matter of discussion among experts. Health-care professionals have been working day and night since Feb 20, and in doing so around 20% (n=350) of them have become infected, and some have died. Lombardy is responding to the lack of beds for patients with COVID-19 by sending patients who need intensive care but are not infected with COVID-19 to hospitals outside of the region to contain the virus.",
				time: "02/11/2020",
				featured: true,
				image:
					"https://whatsupnewp.com/wp-content/uploads/2020/03/banner.png"
			}
		],
		schoolEvents: [],
		enrollments: [],
		messageList: [
			{
				id: 1,
				icon: true,
				title: "Prof. Jerry Amiah",
				avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
				isFavourite: false,
				messages: [
					{
						id: 1,
						sender_id: 1,
						text: "Hi! It's Prof, what are you up to?",
						time: "12:00AM"
					},
					{
						id: 2,
						sender_id: 2,
						text: "Just working on the final assignment, you?",
						time: "12:05AM"
					},
					{
						id: 3,
						sender_id: 2,
						text: "so far so good",
						time: "12:07AM"
					},
					{
						id: 4,
						sender_id: 1,
						text: "LMAO. I haven't even started it",
						time: "12:08AM"
					}
				]
			},
			{
				id: 2,
				title: "Chika Dim Cyril",
				avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
				isFavourite: false,
				messages: [
					{
						id: 1,
						sender_id: 1,
						text: "Hi! It's Chika, what are you up to?",
						time: "12:00AM"
					},
					{
						id: 2,
						sender_id: 3,
						text: "Just working on the final assignment, you?",
						time: "12:05AM"
					},
					{
						id: 3,
						sender_id: 3,
						text: "so far so good",
						time: "12:07AM"
					},
					{
						id: 4,
						sender_id: 1,
						text:
							"Hmmm. I ran into a bit of a hurdle myself, I think I just need to change my approach",
						time: "12:08AM"
					}
				]
			},
			{
				id: 3,
				title: "Peters Gideon",
				avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
				isFavourite: false,
				messages: [
					{
						id: 1,
						sender_id: 1,
						text: "Gideon here! what are you up to?",
						time: "12:00AM"
					},
					{
						id: 2,
						sender_id: 4,
						text: "Just working on the final assignment, you?",
						time: "12:05AM"
					},
					{
						id: 3,
						sender_id: 4,
						text: "so far so good",
						time: "12:07AM"
					},
					{
						id: 4,
						sender_id: 1,
						text: "I still have a long way to go :(",
						time: "12:08AM"
					}
				]
			},
			{
				id: 4,
				title: "Ebube Donald",
				avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
				isFavourite: false,
				messages: [
					{
						id: 1,
						sender_id: 1,
						text: "Hi! what are you up to?",
						time: "12:00AM"
					},
					{
						id: 2,
						sender_id: 5,
						text: "Just working on the final assignment, you?",
						time: "12:05AM"
					},
					{
						id: 3,
						sender_id: 5,
						text: "so far so good",
						time: "12:07AM"
					},
					{
						id: 4,
						sender_id: 1,
						text:
							"LMAO. Can't believe it's due next week, where do I begin?",
						time: "12:08AM"
					}
				]
			}
		],
		settings: {
			canEnroll: true,
			canAddAndDrop: true,
			enrollBySemester: false,
			enrollBySession: true
		},
		currentAcademicSession: {},
		selectedPendingCourses: []
	},
	getters: {
		getCourses({ courses }) {
			return courses;
		},
		getCoursesFromEnrollments({ enrollments }) {
			if (enrollments.length > 0) {
				let enrolled = enrollments[0].curriculum_items;
				let ans = enrolled.map(item => item.curriculumable);
				// console.log(ans);
				return ans;
			}
			return [];
		},
		isAuthenticated: ({ token }) => !!token,
		getEvent: ({ events }) => id => {
			return events.find(event => event.id == id);
		},
		getStudent: ({ students }) => id => {
			return students.find(student => student.matric_number == id);
		},
		getStaffById: ({ staff }) => id => {
			return staff.find(staf => staf.staff_number == id);
		},
		getStudentEvent: ({ studentEvents }) => id => {
			return studentEvents.filter(
				studentEvent => studentEvent.student.matric_number == id
			);
		},
		getCourseById: ({ courses }) => id => {
			return courses.find(course => course.id == id);
		},
		getSemesterById: ({ semesters }) => id => {
			return semesters.find(semester => semester.id == id);
		},
		getNewsById: ({ news }) => id => {
			return news.find(item => item.id == id);
		},
		snackbar({ snackbar }) {
			return snackbar;
		}
	},
	mutations: {
		openSnackbar({ snackbar }, payload) {
			snackbar.text = payload;
			return (snackbar.isActive = true);
		},
		closeSnackbar({ snackbar }) {
			return (snackbar.isActive = false);
		}
	},
	actions: {
		async login({ commit }, user) {
			try {
				// commit("auth_request");
				let res = await axios.post("login", user);

				const token = res.data.token;
				const userInfo = res.data.user;

				localStorage.setItem("upschool-token", token);
				axios.defaults.headers.common["Authorization"] = token;

				// commit("auth_success", token, userInfo);
			} catch (error) {
				// commit("auth_eror");
				localStorage.removeItem("upschool-token");
			}
		},
		async getUser({ state }) {
			let res = await axios.post("auth/me");
			console.log(res.data);

			res.status ? (state.loggedInUser = res.data.user) : null;
		},
		async getUserEvents({}, id) {
			let body = { user_id: id };
			let res = await axios.post("user-event", body);
			console.log(res.data);
			return res.data.data;
		},
		async getColleges({ state }) {
			let res = await axios.get("college");
			console.log(res.data);
			state.colleges = res.data.data;
		},
		async getDepartments({ state }) {
			let res = await axios.get("department");
			console.log(res.data);
			state.departments = res.data.data;
		},
		async getPrograms({ state }) {
			let res = await axios.get("program");
			console.log(res.data);
			state.programs = res.data.data;
		},
		async getStudents({ state }) {
			let res = await axios.get("student");
			console.log(res.data);
			state.students = res.data.data;
			return res.data;
		},
		async getStaff({ state }) {
			let res = await axios.get("staff");
			console.log(res.data);
			state.staff = res.data.data;
		},
		async getNews({ state }) {
			let res = await axios.get("news");
			console.log(res.data);
			state.news = res.data.data;
		},
		async getSchoolEvents({ state }) {
			let res = await axios.get("school-event");
			console.log(res.data);
			state.schoolEvents = res.data.data;
		},
		async getCourseStatus({ state }) {
			let res = await axios.get("course-status");

			state.course_statuses = res.data.data;
		},
		async getEnrolledCourses({ state }) {
			let body = {
				student_id: state.loggedInUser.id
			};

			let res = await axios.post(`enroll/courses`, body);
			console.log(res.data);
			state.enrollments = res.data.data;
		},
		async getCurrentEnrollment({ state }) {
			let body = {
				student_id: state.loggedInUser.id,
				semester_id: state.currentAcademicSession.semester.id
			};
			let res = await axios.post("enroll/student-latest", body);
			console.log(res.data);
			return res.data.data;
		},
		async getEnrollableItems({ state }) {
			let id = state.loggedInUser.id;
			let res = await axios.get(`curriculum-block-student/${id}`);
			console.log(res.data);
			return res.data;
		},
		async getStudentEnrollments({ state }) {
			let body = { student_id: state.loggedInUser.id };
			let res = await axios.post("enroll/student", body);

			console.log(res.data);

			return res.data.data;
		},
		async enrollCourses({ state }) {
			let arr = [];

			state.selectedCourses.forEach(item => {
				arr.push(item.id);
			});

			let body = {
				ids: JSON.stringify(arr),
				student_id: state.loggedInUser.id
			};

			let res = await axios.post("enroll", body);

			console.log(res.data);

			return res.data;
		},
		async getStudentResults({ state }, student_id) {
			let id = state.loggedInUser ? state.loggedInUser.id : student_id;
			let res = await axios.get(`result/${id}`);

			console.log(res.data);

			return res.data.data;
		},
		async getCourseSection({}, id) {
			let res = await axios.get(`course-section/${id}`);

			console.log(res.data);

			return res.data.data;
		},
		async getAllCourses({ state }) {
			let res = await axios.get("courses");
			console.log(res.data);
			state.courses = res.data.data;
		},
		async getCourseById({}, id) {
			let res = await axios.get(`courses/${id}`);
			return res.data.data;
		},
		async getCurricula({}, id) {
			let res = await axios.get(`curriculum-block/${id}`);
			console.log(res.data);
			return res.data.data;
		},
		async saveBulkCourses({ dispatch }, payload) {
			let body = { data: JSON.stringify(payload) };
			let res = await axios.post("bulk/courses", body);
			if (res.data.status) {
				dispatch("getAllCourses");
			}
			console.log(res.data);
			return res.data;
		},
		async getCourseGradelist({}, id) {
			let res = await axios.get(`course-assessment/${id}`);
			console.log(res.data);
			return res.data;
		},
		async saveCourseGradelist({}, body) {
			let res = await axios.post(`course-assessment`, body);
			console.log(res.data);
			return res.data;
		},
		async addCourseToCurriculum({}, payload) {
			let res = await axios.post(
				`curriculum-item/${payload.blockId}`,
				payload.body
			);
			console.log(res.data);
			return res.data;
		},
		async getCurrentAcademicSession({ state }) {
			let res = await axios.get("academic-session-current");
			console.log(res.data);
			state.currentAcademicSession = res.data.data;
		},
		setupDashboard({ dispatch }) {
			dispatch("getStudents");
			dispatch("getStaff");
			dispatch("getDepartments");
			dispatch("getColleges");
			dispatch("getNews");
		}
	}
});
