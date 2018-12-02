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

create table StudyGroup (
	courseid INTEGER NOT NULL,
	groupid INTEGER NOT NULL,
	name TEXT NOT NULL,
	meetTime TEXT NOT NULL,
	meetDay TEXT NOT NULL,
	meetLoc TEXT NOT NULL,
	PRIMARY KEY (groupid),
	FOREIGN KEY (courseid) REFERENCES Courses (courseid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

create table Membership (
	id INTEGER NOT NULL,
	groupid INTEGER NOT NULL,
	PRIMARY KEY (id, groupid),
	FOREIGN KEY (groupid) REFERENCES StudyGroup (groupid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id) REFERENCES Users (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

create table Subscribed (
	id INTEGER NOT NULL,
	courseid INTEGER NOT NULL,
	PRIMARY KEY (id, courseid),
	FOREIGN KEY (id) REFERENCES Users (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (courseid) REFERENCES Courses (courseid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

create table Comments (
	groupid INTEGER NOT NULL,
	id INTEGER NOT NULL,
	content TEXT NOT NULL,
	timestamp DATE NOT NULL,
	PRIMARY KEY (timestamp),
	FOREIGN KEY (groupid) REFERENCES StudyGroup (groupid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id) REFERENCES Users (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

