CREATE TABLE `School` (
	SchoolID INT AUTO_INCREMENT,
	SchoolNaam	VARCHAR(50) NOT NULL,
	CONSTRAINT pk_school 
		PRIMARY KEY(SchoolID)
);

CREATE TABLE `Abonnement` (
	AbonnementID INT AUTO_INCREMENT,
	BetaalDatum DateTime,
	CONSTRAINT pk_abonnement
		PRIMARY KEY(AbonnementID)
);

CREATE TABLE `HboStudent` (
	StudentEmail VARCHAR(45),
	SchoolID INT,
	AbonnementID INT,
	School VARCHAR(25) NOT NULL,
	Opleiding VARCHAR(15) NOT NULL,
	Wachtwoord VARCHAR(255) NOT NULL,
	CONSTRAINT pk_hbostudent
		PRIMARY KEY(StudentEmail),
	CONSTRAINT fk_school_hbostudent
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID)
		ON DELETE CASCADE,
	CONSTRAINT fk_abonnement_hbostudent
		FOREIGN KEY(AbonnementID)
		REFERENCES Abonnement(AbonnementID)
);

CREATE TABLE `Docent` (
	DocentID INT AUTO_INCREMENT,
	SchoolID INT,
	Vak VARCHAR(13) NOT NULL,
	DocentEmail VARCHAR(45) NOT NULL UNIQUE,
	CONSTRAINT pk_docent
		PRIMARY KEY(DocentID),
	CONSTRAINT fk_school_docent
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID)
);

CREATE TABLE `Video` (
	VideoID INT AUTO_INCREMENT,
	DocentID INT,
	SchoolID INT,
	Titel VARCHAR(50) NOT NULL UNIQUE,
	Vak VARCHAR(13) NOT NULL,
	CONSTRAINT pk_video
		PRIMARY KEY(VideoID),
	CONSTRAINT fk_docent_video
		FOREIGN KEY(DocentID)
		REFERENCES Docent(DocentID)
		ON DELETE CASCADE,
	CONSTRAINT fk_school_video
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID)
);

