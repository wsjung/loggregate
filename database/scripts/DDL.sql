.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;

drop table if exists Courses;

create table Courses (
	courseID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
	subject TEXT NOT NULL CHECK(length(subject) <= 4),
	courseNum INTEGER NOT NULL CHECK(courseNum > 0),
	name TEXT NOT NULL,
);

create table Subscribed (
	userID INTEGER,
	courseID INTEGER,
	PRIMARY KEY (userID, courseID),
	FOREIGN KEY (userID) references Courses(courseID)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (userID) references Users(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);