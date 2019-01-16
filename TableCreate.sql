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

CREATE TABLE `User` (
	Email VARCHAR(45),
	SchoolID INT,
	AbonnementID INT,
	Wachtwoord VARCHAR(255) NOT NULL,
	DocentPerms TINYINT(1),
	CONSTRAINT pk_user
		PRIMARY KEY(Email),
	CONSTRAINT fk_school_user
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID)
		ON DELETE CASCADE,
	CONSTRAINT fk_abonnement_user
		FOREIGN KEY(AbonnementID)
		REFERENCES Abonnement(AbonnementID)
);

CREATE TABLE `Video` (
	VideoID INT AUTO_INCREMENT,
	SchoolID INT,
	Titel VARCHAR(50) NOT NULL UNIQUE,
	Locatie VARCHAR(100) NOT NULL,
	Vak VARCHAR(13) NOT NULL,
	CONSTRAINT pk_video
		PRIMARY KEY(VideoID),
	CONSTRAINT fk_school_video
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID)
);

CREATE TABLE `DocentKanaal` (
	KanaalNaam VARCHAR(20),
	SchoolID INT,
	VideoID INT,
	Vak VARCHAR(13) NOT NULL,
	Opleiding VARCHAR(15) NOT NULL,
	CONSTRAINT pk_docentkanaal
		PRIMARY KEY(KanaalNaam),
	CONSTRAINT fk_school_docentkanaal
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID),
	CONSTRAINT fk_video_docentkanaal
		FOREIGN KEY(VideoID)
		REFERENCES Video(VideoID)
);

CREATE TABLE `VideoLijst` (
	KanaalNaam VARCHAR(20),
	SchoolID INT,
	VideoID INT,
	AbonnementID INT,
	Email VARCHAR(45),
	Vak VARCHAR(13) NOT NULL,
	Opleiding VARCHAR(15) NOT NULL,
	CONSTRAINT fk_docentkanaal_videolijst
		FOREIGN KEY(KanaalNaam)
		REFERENCES DocentKanaal(KanaalNaam),
	CONSTRAINT fk_school_videolijst
		FOREIGN KEY(SchoolID)
		REFERENCES School(SchoolID),
	CONSTRAINT fk_video_videolijst
		FOREIGN KEY(VideoID)
		REFERENCES Video(VideoID),
	CONSTRAINT fk_abonnement_videolijst
		FOREIGN KEY(AbonnementID)
		REFERENCES Abonnement(AbonnementID),
	CONSTRAINT fk_user_videolijst
		FOREIGN KEY(Email)
		REFERENCES User(Email)
);
