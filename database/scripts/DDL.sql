.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;

drop table if exists Courses;

create table Courses (
	subject TEXT NOT NULL CHECK(length(subject) <= 4),
	courseNum INTEGER NOT NULL CHECK(courseNum > 0),
	name TEXT NOT NULL,
	PRIMARY KEY (subject, courseNum)
);