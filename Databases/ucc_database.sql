CREATE SCHEMA UCC_database DEFAULT CHAR SET UTF8MB4;
USE UCC_database;

SET AUTOCOMMIT= 0;

CREATE TABLE students(
	student_id INT UNSIGNED NOT NULL,
	first_name VARCHAR (50),
    middle_name VARCHAR (50),
	last_name VARCHAR (50),
    personal_email VARCHAR (50),
    student_email VARCHAR (50),
	home_address VARCHAR (100),
	home_contact VARCHAR (12),
	work_contact VARCHAR (12),
    mobile_contact VARCHAR (12),
	next_of_kin VARCHAR (80),
    nok_contact VARCHAR (12),
    program VARCHAR (50),
    gpa FLOAT (3),
    PRIMARY KEY (student_id)
);

INSERT INTO students VALUES
(2023001, 'John', 'James', 'Doe', 'jdoe2024@hotmail.com', 'jdoe32@stu.ucc.edu.jm', '23 Duke Street, Kingston 5', '876-221-3321', '876-972-2244', '876-567-0081', 'Mary Lamb', '876-345-6789', 'Business Administration', 3.2),
(2023002, 'Helen', 'Nicole', 'Smith', 'helensmith1980@gmail.com', 'hsmith12@stu.ucc.edu.jm', 'Exchange, Ocho Rios', '876-456-0987', '876-975-3801', '876-623-0067', 'Oniqua Bailey', '876-290-1122', 'Information Technology', 2.9);

CREATE TABLE courses(
	course_code VARCHAR (6) NOT NULL,
    course_title VARCHAR (100),
    course_credits INT,
    degree_level VARCHAR (50),
    prerequisites VARCHAR (100),
    PRIMARY KEY (course_code)
);

INSERT INTO courses VALUES
('PSY123','Introduction to Psychology',3,'Undergraduate','None'),
('ITT419','Internet Authoring II',3,'Undergraduate','Internet Authoring 1');

CREATE TABLE course_enrolment(
	course_code VARCHAR (6) NOT NULL PRIMARY KEY,
    student_id INT UNSIGNED,
    semesteryear YEAR,
    course_work_grade FLOAT (3),
    final_exam_grade FLOAT (3),
    project_grade FLOAT (3),
    FOREIGN KEY (student_id) REFERENCES students (student_id),
    FOREIGN KEY (course_code) REFERENCES courses (course_code)
);

INSERT INTO course_enrolment VALUES
('MKT201', 2023001, 2024, 50.00, 0.00, 30.00),
('ITT419', 2023002, 2024, 20.00, 0.00, 19.00);


CREATE TABLE login_stu_cred(

student_id INT UNSIGNED,
pass_word VARCHAR (14),
FOREIGN KEY (student_id) REFERENCES students (student_id)

);

CREATE TABLE lecturer_database(
	lecturer_ID INT UNSIGNED NOT NULL,
	lecturer_title VARCHAR(45),
	lecturer_firstname VARCHAR(45),
	lecturer_lastname VARCHAR(45),
	lecturer_department VARCHAR(45),
	lecturer_position VARCHAR(45),
    PRIMARY KEY (lecturer_ID)
);

INSERT INTO lecturer_database VALUES
(2010158,'Miss','Sophia','Brown','Information Technology','Staff Lecturer'),
(2014587,'Miss','Ryah','Lynn','Business Administration','Adjunct Lecturer'),
(2020654,'Mr','Otis','Osbourne','Information Technology','Head of Department');

CREATE TABLE course_schedule(
	course_code VARCHAR (6) NOT NULL,
    lecturer_ID INT UNSIGNED,
    semesteryear YEAR,
	semester VARCHAR (20) DEFAULT NULL,
	section VARCHAR (100) DEFAULT NULL,
	course_day VARCHAR (9),
    course_time VARCHAR (4),
	location VARCHAR (100) DEFAULT NULL,
    FOREIGN KEY (lecturer_ID) REFERENCES lecturer_database (lecturer_ID),
    FOREIGN KEY (course_code) REFERENCES courses (course_code)
);

INSERT INTO course_schedule VALUES
( 'HUM101', '2014587', '2024','Summer', 'Human Resources', 'Thursday', '11am', 'ONLINE'),
( 'BIS203', '2014587','2024','Summer', 'Business Administration', 'Monday', '08pm', 'ONLINE');

CREATE TABLE login_lec_cred(

	lecturer_ID INT UNSIGNED DEFAULT NULL,
	pass_word varchar(14) DEFAULT NULL,
	FOREIGN KEY (lecturer_id) REFERENCES lecturer_database (lecturer_id)
    
);