<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'complain_types' => [
        'name' => 'Complain Types',
        'index_title' => 'ComplainTypes List',
        'new_title' => 'New Complain type',
        'create_title' => 'Create ComplainType',
        'edit_title' => 'Edit ComplainType',
        'show_title' => 'Show ComplainType',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'complaints' => [
        'name' => 'Complaints',
        'index_title' => 'Complaints List',
        'new_title' => 'New Complaint',
        'create_title' => 'Create Complaint',
        'edit_title' => 'Edit Complaint',
        'show_title' => 'Show Complaint',
        'inputs' => [
            'complain_type_id' => 'Complain Type',
            'student_id' => 'Student',
            'department_id' => 'Department',
            'program_id' => 'Program',
            'course_id' => 'Course',
            'lecture_id' => 'Lecture',
            'semester_id' => 'Semester',
            'academic_year_id' => 'Academic Year',
            'description' => 'Description',
            'solution' => 'Solution',
            'date' => 'Date',
            'status' => 'Status',
        ],
    ],

    'students' => [
        'name' => 'Students',
        'index_title' => 'Students List',
        'new_title' => 'New Student',
        'create_title' => 'Create Student',
        'edit_title' => 'Edit Student',
        'show_title' => 'Show Student',
        'inputs' => [
            'user_id' => 'User',
            'department_id' => 'Department',
            'program_id' => 'Program',
            'country_id' => 'Country',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'admission_id' => 'Admission Id',
            'maritial_status' => 'Maritial Status',
            'photo' => 'Photo',
            'status' => 'Status',
        ],
    ],

    'lectures' => [
        'name' => 'Lectures',
        'index_title' => 'Lectures List',
        'new_title' => 'New Lecture',
        'create_title' => 'Create Lecture',
        'edit_title' => 'Edit Lecture',
        'show_title' => 'Show Lecture',
        'inputs' => [
            'user_id' => 'User',
            'department_id' => 'Department',
            'image' => 'Image',
            'status' => 'Status',
        ],
    ],

    'departments' => [
        'name' => 'Departments',
        'index_title' => 'Departments List',
        'new_title' => 'New Department',
        'create_title' => 'Create Department',
        'edit_title' => 'Edit Department',
        'show_title' => 'Show Department',
        'inputs' => [
            'name' => 'Name',
            'code' => 'Code',
        ],
    ],

    'department_heads' => [
        'name' => 'Department Heads',
        'index_title' => 'DepartmentHeads List',
        'new_title' => 'New Department head',
        'create_title' => 'Create DepartmentHead',
        'edit_title' => 'Edit DepartmentHead',
        'show_title' => 'Show DepartmentHead',
        'inputs' => [
            'user_id' => 'User',
            'department_id' => 'Department',
        ],
    ],

    'programs' => [
        'name' => 'Programs',
        'index_title' => 'Programs List',
        'new_title' => 'New Program',
        'create_title' => 'Create Program',
        'edit_title' => 'Edit Program',
        'show_title' => 'Show Program',
        'inputs' => [
            'code' => 'Code',
            'name' => 'Name',
            'capacity' => 'Capacity',
            'nta_level_id' => 'Nta Level',
            'department_id' => 'Department',
        ],
    ],

    'courses' => [
        'name' => 'Courses',
        'index_title' => 'Courses List',
        'new_title' => 'New Course',
        'create_title' => 'Create Course',
        'edit_title' => 'Edit Course',
        'show_title' => 'Show Course',
        'inputs' => [
            'code' => 'Code',
            'name' => 'Name',
            'credit' => 'Credit',
            'elective' => 'Elective',
            'semester_id' => 'Semester',
            'department_id' => 'Department',
            'nta_level_id' => 'Nta Level',
            'program_id' => 'Program',
        ],
    ],

    'semesters' => [
        'name' => 'Semesters',
        'index_title' => 'Semesters List',
        'new_title' => 'New Semester',
        'create_title' => 'Create Semester',
        'edit_title' => 'Edit Semester',
        'show_title' => 'Show Semester',
        'inputs' => [
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ],
    ],

    'enrollments' => [
        'name' => 'Enrollments',
        'index_title' => 'Enrollments List',
        'new_title' => 'New Enrollment',
        'create_title' => 'Create Enrollment',
        'edit_title' => 'Edit Enrollment',
        'show_title' => 'Show Enrollment',
        'inputs' => [
            'student_id' => 'Student',
            'course_id' => 'Course',
            'semester_id' => 'Semester',
            'academic_year_id' => 'Academic Year',
        ],
    ],

    'nta_levels' => [
        'name' => 'Nta Levels',
        'index_title' => 'NtaLevels List',
        'new_title' => 'New Nta level',
        'create_title' => 'Create NtaLevel',
        'edit_title' => 'Edit NtaLevel',
        'show_title' => 'Show NtaLevel',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'academic_years' => [
        'name' => 'Academic Years',
        'index_title' => 'AcademicYears List',
        'new_title' => 'New Academic year',
        'create_title' => 'Create AcademicYear',
        'edit_title' => 'Edit AcademicYear',
        'show_title' => 'Show AcademicYear',
        'inputs' => [
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ],
    ],

    'countries' => [
        'name' => 'Countries',
        'index_title' => 'Countries List',
        'new_title' => 'New Country',
        'create_title' => 'Create Country',
        'edit_title' => 'Edit Country',
        'show_title' => 'Show Country',
        'inputs' => [
            'name' => 'Name',
            'nicename' => 'Nicename',
            'iso3' => 'Iso3',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'designation' => 'Designation',
            'password' => 'Password',
        ],
    ],

    'messages' => [
        'name' => 'Messages',
        'index_title' => 'Messages List',
        'new_title' => 'New Message',
        'create_title' => 'Create Message',
        'edit_title' => 'Edit Message',
        'show_title' => 'Show Message',
        'inputs' => [
            'body' => 'Body',
            'user_id' => 'User',
            'phone' => 'Phone',
            'send_status' => 'Send Status',
            'type' => 'Type',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
